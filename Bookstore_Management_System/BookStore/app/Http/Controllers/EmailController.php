<?php

/**
 * File Name:EmailController.php
 * Description:manage password reset functionality by sending reset links to users' emails and storing reset tokens
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Controllers
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordReset;
use StaffManagement;


class EmailController extends Controller
{
    public function sendResetEmail(Request $request)
    {
        $email = $request->input('email');
        if (StaffManagement::sendResetLink($email)) {
            return back()->with('status', 'Password reset link sent!');
        }

        return back()->withErrors(['email' => 'Failed to send reset link. Please try again.']);
    }


    protected function storeResetToken($email, $token)
    {
        PasswordReset::where('email', $email)->delete();

        PasswordReset::updateOrInsert([
            'email' => $email,
            'token' => $token
        ]);
    }
}
