<?php

/**
 * File Name: PositionController.php
 * Description: manages staff positions by handling operations
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Controllers
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Staff;
use StaffManagement;

class PositionController extends Controller
{
    public function showPositionList()
    {
        $positions = StaffManagement::PositionList();
        return view("Staff_Service.Position_Management", compact("positions"));
    }

    public function addPosition(Request $request)
    {
        $validatedData = $request->validate([
            'position_name' => 'required|string|max:255',
            'basic_salary' => 'required|numeric|min:0',
        ]);

        $existingPosition = Position::where('position_name', $validatedData['position_name'])->first();

        if ($existingPosition) {
            return redirect()->back()->with('error', 'Position already exists.');
        }

        $position = StaffManagement::insertPosition($validatedData);

        if ($position) {
            return redirect()->route('Position_Management')->with('success', 'Position added successfully!');
        }

        return redirect()->back()->with('error', 'Failed to add position.');
    }

    public function removePosition($id)
    {
        $deleted = StaffManagement::deletePosition($id);
        if ($deleted) {
            return redirect()->route('Position_Management')->with('success', 'Position deleted successfully!');
        }
        return redirect()->route('Position_Management')->with('error', 'Cannot delete the position because it is assigned to current staff.');
    }

    public function editPosition(Request $request, $id)
    {
        $validatedData = $request->validate([
            'position_name' => 'required|string|max:255',
            'basic_salary' => 'required|numeric|min:0',
        ]);

        $existingPosition = Position::where('position_name', $validatedData['position_name'])
            ->where('position_id', '!=', $id)->first();

        if ($existingPosition) {
            return redirect()->back()->with('error', 'Position name already exists.');
        }

        $updated = StaffManagement::editPosition($id, $validatedData);

        if ($updated) {
            return redirect()->route('Position_Management')->with('success', 'Position updated successfully!');
        }

        return redirect()->back()->with('error', 'Failed to update position.');
    }

    public function goEditPage($id)
    {
        $position = StaffManagement::getPosition($id);
        if (!$position) {
            return redirect()->route('Position_Management')->with('error', 'Position not found.');
        }
        return view('Staff_Service.Edit_Position', compact('position'));
    }

    public function showInRegisterForm()
    {
        $positions = Position::where('position_id', '!=', 'ADMIN')->get(['position_id', 'position_name']);
        return view('Staff_Service.Register_Staff', compact('positions'));
    }

    public function showStaffPosition($id)
    {
        $staff = StaffManagement::getStaff($id);
        $positions = StaffManagement::getPosition($staff->position_id);
        $allPositions = StaffManagement::PositionList();
        return view('Staff_Service.Change_Position', compact('staff', 'positions', 'allPositions'));
    }

    public function updateStaffPosition(Request $request, $staffId)
    {
        $positionId = $request->input('position_id');
        if (is_null($positionId)) {
            return redirect()->back()->with('error', 'Position ID cannot be null.');
        }
        $staff = Staff::find($staffId);
        if (!$staff) {
            return redirect()->back()->with('error', 'Staff member not found.');
        }

        if ($staff->position_id == $positionId) {
            return redirect()->back()->with('error', 'The new position is the same as the current position.');
        }


        if($staff->position_id == $positionId){
            return redirect()->back()->with('error', 'You cannot submit same position.');
        }
        $staff = StaffManagement::renewStaffPosition($staffId, $positionId);
        if ($staff) {
            return redirect()->route('Staff_list')->with('success', 'Position updated successfully.');
        }

    }
}
