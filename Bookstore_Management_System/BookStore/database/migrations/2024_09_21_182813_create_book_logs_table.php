<?php
/**
 * File Name: 2024_09_21_182813_create_book_logs_table.php
 * Description:  Schema for database in adding or removing record of Book Log
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookLogsTable extends Migration
{
    public function up()
    {
        Schema::create('book_logs', function (Blueprint $table) {
            $table->id();
            $table->string('book_title');
            $table->string('staff_id');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_logs');
    }
}

