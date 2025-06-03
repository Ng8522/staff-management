<?php

/**
 * File Name: SessionController.php
 * Description: manages session-related functionalities, including displaying staff information on the home page, showing recent attendance records, and rendering the profile form
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

class SessionController extends Controller
{
    public function showNameInHome()
    {
        $staffId = session('staffid');
        if (Session::has('staffid')) {
            $staff = StaffManagement::getStaff($staffId);
            $position = $staff->position;
            $isAdminOrHRManager = in_array($position->position_name, ['Admin', 'HR Manager']);
            $isAdminOrInventoryManager = in_array($position->position_name, ['Admin', 'Inventory Manager']);
            return view('home', ['staff' => $staff, 'isAdminOrHRManager' => $isAdminOrHRManager, 'isAdminOrInventoryManager' => $isAdminOrInventoryManager]);
        }else{
            return redirect()->route('login')->with('error', 'Please login first.');
        }
    }

    public function showRecentAttendance(Request $request)
    {
        $staffId = session('staffid');

        if (!$staffId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $attendanceRecords = StaffManagement::readOwnAttendance($staffId)??[];

        return view('attendance-list', [
            'attendanceRecords' => $attendanceRecords
        ]);
    }

    public function showProfileForm()
    {
        $staffId = session('staffid');
        $staff = StaffManagement::getStaffDetails($staffId);

        return view('Profile', ['staff' => $staff]);
    }
}