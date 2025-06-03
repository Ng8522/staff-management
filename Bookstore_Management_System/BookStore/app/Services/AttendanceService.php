<?php

/**
 * File Name: AttendanceService.php
 * Description: manages attendance records using XML, providing functionality for storing, filtering, and paginating attendance data while also transforming XML content into HTML format for display
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Services
 */

namespace App\Services;

use Illuminate\Support\Facades\Facade;
use SimpleXMLElement;
use DOMDocument;
use XSLTProcessor;
use Illuminate\Pagination\LengthAwarePaginator;

class AttendanceService extends Facade
{
    protected $xmlFilePath;
    protected $xslFilePath;

    public function __construct()
    {
        $this->xmlFilePath = storage_path('app/xml/staff_attendance.xml');
        $this->xslFilePath = storage_path('app/xml/attendance_table.xsl');
    }

    protected function loadOrCreateXML()
    {
        if (file_exists($this->xmlFilePath)) {
            return simplexml_load_file($this->xmlFilePath);
        } else {
            return new SimpleXMLElement('<attendance></attendance>');
        }
    }

    public function storeAttendance($staffId, $name, $status, $checkInTime)
    {
        $xml = $this->loadOrCreateXML();

        $newRecord = $xml->addChild('record');
        $newRecord->addChild('staff_id', $staffId);
        $newRecord->addChild('name', $name);
        $newRecord->addChild('date', date('Y-m-d'));
        $newRecord->addChild('check_in_time', $checkInTime ?? now()->format('H:i:s'));
        $newRecord->addChild('status', $status);

        $xml->asXML($this->xmlFilePath);
    }

    public function getFilteredAttendanceByDate($date)
    {
        $xml = $this->loadOrCreateXML();
        $filteredRecords = $xml->xpath("//record[date='$date']");

        $filteredRecordsArray = $this->convertXmlRecordsToArray($filteredRecords);

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($filteredRecordsArray, ($currentPage - 1) * $perPage, $perPage);

        $paginator = new LengthAwarePaginator(
            $currentItems,
            count($filteredRecordsArray),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return [
            'xml' => $this->convertToXml($currentItems),
            'paginator' => $paginator
        ];
    }

    public function getPaginatedAttendanceRecords()
    {
        $xml = $this->loadOrCreateXML();
        $allRecords = $xml->record;

        $allRecordsArray = $this->convertXmlRecordsToArray($allRecords);

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($allRecordsArray, ($currentPage - 1) * $perPage, $perPage);

        $paginator = new LengthAwarePaginator(
            $currentItems,
            count($allRecordsArray),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return [
            'xml' => $this->convertToXml($currentItems),
            'paginator' => $paginator
        ];
    }

    protected function convertXmlRecordsToArray($records)
    {
        $array = [];
        foreach ($records as $record) {
            $array[] = [
                'staff_id' => (string) $record->staff_id,
                'name' => (string) $record->name,
                'date' => (string) $record->date,
                'check_in_time' => (string) $record->check_in_time,
                'status' => (string) $record->status,
            ];
        }
        return $array;
    }

    protected function convertToXml($items)
    {
        $xml = new SimpleXMLElement('<attendance/>');

        foreach ($items as $item) {
            $recordXml = $xml->addChild('record');
            foreach ($item as $key => $value) {
                $recordXml->addChild($key, (string) $value);
            }
        }

        return $xml->asXML();
    }

    public function transformToHtml($xmlContent)
    {
        $xml = new DOMDocument;
        $xml->loadXML($xmlContent);

        $xsl = new DOMDocument;
        $xsl->load($this->xslFilePath);

        $proc = new XSLTProcessor;
        $proc->importStyleSheet($xsl);

        return $proc->transformToXML($xml);
    }

    public function getRecentAttendanceRecords($staffId, $limit = 10)
    {
        $xml = $this->loadOrCreateXML();
        $allRecords = $xml->record;

        $allRecordsArray = $this->convertXmlRecordsToArray($allRecords);
        $filteredRecords = array_filter($allRecordsArray, function($record) use ($staffId) {
            return $record['staff_id'] == $staffId;
        });

        return array_slice(array_reverse($filteredRecords), 0, $limit);
    }
}