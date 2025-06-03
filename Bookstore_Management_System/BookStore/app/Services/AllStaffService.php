<?php

/**
 * File Name: AllStaffSService.php
 * Description: a central service for managing various functionalities related to staff, positions, user accounts, attendance, and email services
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Services
 */

namespace App\Services;

use App\Services\Staff_Service;
use App\Services\Position_Service;
use App\Services\User_Account_Service;
use App\Services\AttendanceService;
use App\Services\EmailService;

class AllStaffService
{
    protected $staffService;
    protected $positionService;
    protected $userAccountService;
    protected $attendanceService;
    protected $emailService;

    public function __construct(
        Staff_Service $staffService,
        Position_Service $positionService,
        User_Account_Service $userService,
        AttendanceService $attendanceService,
        EmailService $emailService
    ) {
        $this->staffService = $staffService;
        $this->positionService = $positionService;
        $this->userAccountService = $userService;
        $this->attendanceService = $attendanceService;
        $this->emailService = $emailService;
    }

    public function insertStaff($data)
    {
        return $this->staffService->createStaff($data);
    }

    public function StaffList()
    {
        return $this->staffService->listStaff();
    }

    public function PositionList()
    {
        return $this->positionService->listPosition();
    }

    public function insertPosition($data)
    {
        return $this->positionService->addPosition($data);
    }

    public function deletePosition($id)
    {
        return $this->positionService->deletePosition($id);
    }

    public function editPosition($id, $data)
    {
        return $this->positionService->updatePosition($id, $data);
    }

    public function getPosition($id)
    {
        return $this->positionService->getPositionById($id);
    }

    public function deleteStaff($id)
    {
        return $this->staffService->deleteStaff($id);
    }

    public function getStaff($id)
    {
        return $this->staffService->getStaffById($id);
    }

    public function renewStaffPosition($staffId, $positionId)
    {
        return $this->positionService->updateStaffPosition($staffId, $positionId);
    }

    public function login($credentials)
    {
        return $this->userAccountService->login($credentials);
    }

    public function logout()
    {
        return $this->userAccountService->logout();
    }

    public function storeAttendance($staffId, $name, $status, $checkInTime)
    {
        return $this->attendanceService->storeAttendance($staffId, $name, $status, $checkInTime);
    }

    public function getTransformedAttendance()
    {
        return $this->attendanceService->getPaginatedAttendanceRecords();
    }

    public function getFilteredAttendanceByDate($date)
    {
        return $this->attendanceService->getFilteredAttendanceByDate($date);
    }

    public function transformToHtml($data)
    {
        return $this->attendanceService->transformToHtml($data);
    }

    public function getPaginatedAttendanceRecords()
    {
        return $this->attendanceService->getPaginatedAttendanceRecords();
    }

    public function sendResetLink($email)
    {
        return $this->emailService->sendResetLink($email);
    }

    public function updatePassowrd($email, $password)
    {
        return $this->staffService->updateStaffPassword($email, $password);
    }
    public function readOwnAttendance($staffId, $limit = 10){
        return $this->attendanceService->getRecentAttendanceRecords($staffId, $limit = 10);
    }

    public function getStaffDetails($staffId){
        return $this->staffService->getStaffDetails($staffId);
    }

    public function updateProfile($staffId, $data){
        return $this->userAccountService->updateProfile($staffId, $data);
    }

}