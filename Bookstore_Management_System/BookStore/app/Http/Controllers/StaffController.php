<?php

/**
 * File Name: StaffController.php
 * Description: handles staff management operations
 *
 * Author: Ng Jun Yu
 * Date: 22-9-2024
 *
 * @package Controllers
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use StaffManagement;


class StaffController extends Controller
{
    public function showStaffList()
    {
        $staff = StaffManagement::StaffList();
        if ($staff) {
            return view("Staff_Service.Staff_List", compact("staff"));
        }
        return redirect()->back()->with('error', 'Unable to retrieve staff list.');
    }

    public function update($staffId, Request $request)
    {
        $updatedStaff = StaffManagement::updateStaff($staffId, $request->all());
        if ($updatedStaff) {
            return redirect()->back()->with('success', 'Staff updated successfully!');
        }
        return redirect()->back()->with('error', 'Staff not found!');
    }

    public function delete($staffId)
    {
        $deleted = StaffManagement::deleteStaff($staffId);

        if ($deleted) {
            return redirect()->back()->with('success', 'Staff deleted successfully!');
        }

        return redirect()->back()->with('error', 'Staff not found!');
    }

    public function addStaff(Request $request)
    {

        $run = StaffManagement::insertStaff($request->all());
        if($run){
            return redirect()->back()->with('success', 'Staff registered successfully!');
        }
        return redirect()->back()->with('failed', 'Check your inserted data.');

    }
}