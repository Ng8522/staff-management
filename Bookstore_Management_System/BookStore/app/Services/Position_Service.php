<?php

/**
 * File Name: Position_Service.php
 * Description:manages staff positions within the application. It provides methods to list available positions, add new ones, delete positions (if no staff are assigned), and update existing positions
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Services
 */

namespace App\Services;

use Illuminate\Support\Facades\Facade;
use App\Models\Position;
use App\Models\Staff;

class Position_Service extends Facade
{
    public function listPosition()
    {
        return Position::where('position_id', '!=', 'ADMIN')
        ->withCount('staff')
        ->paginate(10);
    }

    public function addPosition($data)
    {
        $lastId = Position::orderBy('position_id', 'desc')->value('position_id');
        $numericId = $lastId ? intval(substr($lastId, 1)) : 0;
        $newId = 'P' . str_pad($numericId + 1, 4, '0', STR_PAD_LEFT);

        return Position::create([
            'position_id' => $newId,
            'position_name' => $data['position_name'],
            'basic_salary' => $data['basic_salary'],
        ]);
    }

    public function deletePosition($id)
    {
        $position = Position::find($id);

        if (!$position) {
            return false;
        }

        $staffCount = Staff::where('position_id', $position->position_id)->count();

        if ($staffCount > 0) {
            return false;
        }

        $position->delete();
        return true;
    }

    public function updatePosition($id, $data)
    {
        $position = Position::find($id);
        if ($position) {
            return $position->update($data);
        }
        return false;
    }

    public function getPositionById($id)
    {
        return Position::find($id);
    }

    public function updateStaffPosition($staffId, $newPositionId)
    {
        $staff = Staff::find($staffId);
        $staff->position_id = $newPositionId;
        $staff->save();
        return $staff;
    }
}