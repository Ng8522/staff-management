<?php

namespace App\Services;
/**
 * File Name:User_Account_Service.php
 * Description:handles user authentication and profile management for staff members
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Services
 */

use App\Security\DataProtection;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use Illuminate\Support\Facades\Session;


class User_Account_Service
{
    public function logout()
    {
        Session::forget('staffid');
        Auth::logout();
        return redirect('/');
    }

    public static function login($credentials)
    {
        $dataProtection = new DataProtection();
        $encryptedEmail = $dataProtection->encryptData($credentials['email']);
        $password = $credentials['password'];
        $staff = Staff::where('email', $encryptedEmail)->first();
        if ($staff) {
            $decryptedStoredPassword = $dataProtection->decryptData($staff->password);
            if ($password === $decryptedStoredPassword) {
                Session::put('staffid', $staff->staff_id);
                return true;
            }
        }
        return false;
    }

    public static function updateProfile($staffId, $data)
    {
        $staff = Staff::where('staff_id', $staffId)->first();

        if ($staff) {
            $dataProtection = new DataProtection();
            $data['email'] = $dataProtection->encryptData($data['email']);
            $data['ICNo'] = $dataProtection->encryptData($data['ICNo']);
            $data['bank_account'] = $dataProtection->encryptData($data['bank_account']);

            $staff->update($data);
            return $staff;
        }

        return null;
    }
}
