<?php

namespace App\Models;
/**
 * File Name: Staff.php
 * Description: represents the staff table in the database, defining its primary key, fillable fields, and establishing a relationship
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Models
 */
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $primaryKey = 'staff_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'staff';

    protected $fillable = [
        'staff_id',
        'name',
        'ICNo',
        'gender',
        'dateOfBirth',
        'race',
        'email',
        'position_id',
        'bank_account',
        'password',
    ];
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'position_id');
    }
}