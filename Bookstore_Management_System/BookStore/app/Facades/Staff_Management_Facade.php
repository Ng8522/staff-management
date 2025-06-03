<?php

/**
 * File Name: Staff_Management_Facade.php
 * Description:  provides a static interface to the StaffManagement service by defining the getFacadeAccessor() method that returns the string identifier 'StaffManagement'.
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Facade
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Staff_Management_Facade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'StaffManagement';
    }

}