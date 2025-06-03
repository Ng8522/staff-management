<?php

namespace App\Services;
/**
 * File Name:Staff_Service.php
 * Description: responsible for managing staff records within the application
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package
 */
use App\Models\Staff;
use App\Security\DataProtection;

class Staff_Service
{
    public function createStaff($data)
    {
        $dataProtection = new DataProtection();
        $lastId = Staff::orderBy('staff_id', 'desc')->value('staff_id');
        $numericId = $lastId ? intval(substr($lastId, 1)) : 0;
        $newId = 'S' . str_pad($numericId + 1, 4, '0', STR_PAD_LEFT);
        try {
            $staff = Staff::create([
                'staff_id' => $newId,
                'name' => $data['name'],
                'ICNo' => $dataProtection->encryptData($data['ICNo']),
                'gender' => $data['gender'],
                'dateOfBirth' => $data['dateOfBirth'],
                'race' => $data['race'],
                'email' => $dataProtection->encryptData($data['email']),
                'position_id' => $data['position_id'],
                'bank_account' => $dataProtection->encryptData($data['bank_account']),
                'password' => $dataProtection->encryptData($data['email']),
            ]);
            return $staff;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function listStaff()
    {
        return Staff::where('position_id', '!=', 'ADMIN')->paginate(8);
    }

    public function findStaff($staffId)
    {
        return Staff::find($staffId);
    }

    public function updateStaff($staffId, $data)
    {
        $staff = Staff::find($staffId);

        if ($staff) {
            $staff->update($data);
            return $staff;
        }

        return null;
    }

    public function updateStaffPassword($email, $passwordReset){
        $dataProtection = new DataProtection();
        $findEmail = $dataProtection->encryptData($email);
        $find = Staff::where('email', $findEmail)->first();
        $newPassword = $dataProtection->encryptData($passwordReset);
        if($find){
            $find->password = $newPassword;
            $find->save();
            return true;
        }
        return null;
    }

    public function deleteStaff($staffId)
    {
        $staff = Staff::find($staffId);

        if ($staff) {
            $staff->delete();
            return true;
        }

        return false;
    }

    public function getStaffById($id)
    {
        return Staff::find($id);
    }

    public static function getStaffDetails($staffId)
    {
        $staff = Staff::where('staff_id', $staffId)->first();
        $dataProtection = new DataProtection();
        if ($staff) {
            $staff->email = $dataProtection->decryptData($staff->email);
            $staff->ICNo = $dataProtection->decryptData($staff->ICNo);
            $staff->bank_account = $dataProtection->decryptData($staff->bank_account);
        }

        return $staff;
    }


}