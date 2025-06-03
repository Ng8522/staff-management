<?php

namespace App\Http\Controllers;

/**
 * File Name: UserAccountController.php
 * Description:manages user account functionalities,
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Controllers
 */

use Illuminate\Http\Request;
use StaffManagement;
use Illuminate\Support\Facades\Validator;
use App\Models\PasswordReset;


class UserAccountController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $loginSuccess = StaffManagement::login($credentials);

        if ($loginSuccess) {
            return redirect('/home')->with('success', 'Logged in successfully');
        } else {
            return redirect()->back()->withErrors(provider: ['error' => 'Invalid email or password']);
        }
    }

    public function logout()
    {
        StaffManagement::logout();
        return redirect('/')->with('success', 'Logged out successfully');
    }

    public function showResetForm(Request $request)
    {
        $token = base64_decode($request->query('token'));
        return view('reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'token' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors(["error" => "Your password must at least 8."]);
        }

        $passwordReset = PasswordReset::where('token', $request->input('token'))->first();

        if (!$passwordReset) {
            return back()->withErrors(['error' => 'Invalid token.']);
        }
        StaffManagement::updatePassowrd($passwordReset->email,  $request->input('password'));
        PasswordReset::where('email', $passwordReset->email)->delete();

        return redirect()->route('login')->with('status', 'Password has been reset!');
    }


    public function updateProfile(Request $request)
    {
        $staffId = session('staffid');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'ICNo' => 'required|string|max:12',
            'dateOfBirth' => 'nullable|date',
            'gender' => 'required|string|in:Male,Female,Not Specified',
            'race' => 'nullable|string|max:255',
        ]);

        $updatedProfile = StaffManagement::updateProfile($staffId, $request->only(
            'name',
            'email',
            'ICNo',
            'gender',
            'dateOfBirth',
            'race',
            'bank_account'
        ));

        if ($updatedProfile) {
            return back()->with('success', 'Profile updated successfully!');
        } else {
            return back()->withErrors('error', 'Failed to update profile.');
        }
    }
}