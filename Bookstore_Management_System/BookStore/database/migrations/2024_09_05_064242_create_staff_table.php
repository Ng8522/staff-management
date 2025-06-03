<?php

/**
 * File Name:2024_09_05_064242_create_staff_table.php
 * Description:migration sets up the database schema for the staff table
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package migrations
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Security\DataProtection;


class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('staff')) {
            Schema::create('staff', function (Blueprint $table) {
                $table->string('staff_id')->primary();
                $table->string('name')->unique();
                $table->string('ICNo')->unique();
                $table->string('gender')->default('Not Specified');
                $table->string('dateOfBirth')->default('Not Specified');
                $table->string('race')->default('Not Specified');
                $table->string('email')->unique();
                $table->string('position_id');
                $table->string('bank_account')->default('Not Specified');
                $table->string('password');
                $table->timestamps();
            });
        }

        $dataProtection = new DataProtection();

        if (!DB::table('staff')->where('staff_id', 'S0001')->exists()) {
            DB::table('staff')->insert([
                'staff_id' => 'ADM',
                'name' => 'Admin',
                'ICNo' => 'Not Specified',
                'gender' => 'Not Specified',
                'dateOfBirth' => 'Not Specified',
                'race' => 'Not Specified',
                'email' => $dataProtection->encryptData('admin@example.com'),
                'position_id' => 'ADMIN',
                'bank_account' => $dataProtection->encryptData('Not Specified'),
                'password' => $dataProtection->encryptData('Adm123'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}