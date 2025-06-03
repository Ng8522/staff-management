<?php

/**
 * File Name: PasswordReset.php
 * Description: Save the generated token to associate with staff email when staff needs to reset password
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Models
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $table = 'password_resets';
    public $timestamps = false;
    protected $primaryKey = null;

    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];

}