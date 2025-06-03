<?php

/**
 * File Name:2024_09_05_065821_create_staff_table.php
 * Description:migration sets up the database schema for the position table
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

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        if (!Schema::hasTable('position')) {
            Schema::create('position', function (Blueprint $table) {
                $table->string('position_id')->primary();
                $table->string('position_name');
                $table->double('basic_salary')->default('0.0');
            });
        }

        if(!DB::table('position')->where('position_id', 'P0001')->exists()){
            DB::table('position')->insert([
                'position_id'=>'ADMIN',
                'position_name' => 'Admin'
            ]);
            DB::table('position')->insert([
                'position_id'=>'P0001',
                'position_name' => 'HR Manager',
                'basic_salary' => '4500'
            ]);
            DB::table('position')->insert([
                'position_id' => 'P0002',
                'position_name' => 'Inventory Manager',
                'basic_salary' => '4500'
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
        Schema::dropIfExists('position_management');
    }
};