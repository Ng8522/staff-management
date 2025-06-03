<?php

/**
 * File Name: BookLog.php
 * Description: The model of BookLog, defining its content
 *
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_title',
        'action',
        'staff_id',
        'description'
    ]; //"book_title" refers to Book model "title" and "staff_id" refers to Staff model "staff_id"
}
