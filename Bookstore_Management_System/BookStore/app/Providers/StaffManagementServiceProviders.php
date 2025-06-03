<?php

/**
 * File Name: StaffManagementServiceProviders.php
 * Description: registers the AllStaffService as a singleton service within the application, allowing it to be accessed through the "StaffManagement" alias, and it injects dependencies from various service classes related to staff management functionalities.
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Providers
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AllStaffService;
use App\Services\Staff_Service;
use App\Services\Position_Service;
use App\Services\User_Account_Service;
use App\Services\AttendanceService;
use App\Services\EmailService;

class StaffManagementServiceProviders extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton("StaffManagement", function ($app) {
            return new AllStaffService(
                $app->make(Staff_Service::class),
                $app->make(Position_Service::class),
                $app->make(User_Account_Service::class),
                $app->make(AttendanceService::class),
                $app->make(EmailService::class),
            );
        });
    }

    public function boot() {
    }
}