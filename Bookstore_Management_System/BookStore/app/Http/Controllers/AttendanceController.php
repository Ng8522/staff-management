<?php

/**
 * File Name: PasswordReset.php
 * Description: implemented to manage staff attendance, including recording, displaying, and filtering attendance data
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Controllers
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use StaffManagement;
use Illuminate\Support\Facades\Session;


class AttendanceController extends Controller
{
    public function storeAttendance(Request $request)
    {
        $staff_id = Session::get('staffid');

        $validateData = $request->validate([
            'status' => 'required',
            'check_in_time' => 'nullable'
        ]);

        $xml = simplexml_load_file(storage_path('app/xml/staff_attendance.xml'));
        $today = now()->format('Y-m-d');

        foreach ($xml->children() as $attendance) {
            if ((string) $attendance->staff_id === $staff_id && (string) $attendance->date === $today) {
                return response()->json(['message' => 'You have already checked in today']);
            }
        }
        $staff = StaffManagement::getStaff($staff_id);

        StaffManagement::storeAttendance(
            $staff_id,
            $staff->name,
            $validateData['status'],
            $validateData['check_in_time']
        );

        return response()->json(['message' => 'Attendance recorded successfully for '. $today . '!']);
    }


    public function showAttendance(Request $request)
    {
        $date = $request->input('date', null);
        $data = $date ?
            StaffManagement::getFilteredAttendanceByDate($date) :
            StaffManagement::getPaginatedAttendanceRecords();

        $html = StaffManagement::transformToHtml($data['xml']);

        return view('Staff_Service.Attendance_List', [
            'attendanceHtml' => $html,
            'pagination' => $data['paginator'] ?? null
        ]);
    }

    public function filterByDate(Request $request)
    {
        $date = $request->input('date');

        $filteredAttendance = StaffManagement::getFilteredAttendanceByDate($date);
        $attendanceHtml = StaffManagement::transformToHtml($filteredAttendance['xml']);

        return view('Staff_Service.Attendance_List', [
            'attendanceHtml' => $attendanceHtml,
        ]);
    }
}