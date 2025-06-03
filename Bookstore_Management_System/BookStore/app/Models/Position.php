<?php
/**
 * File Name: Position.php
 * Description:represents the position table in the database, defining its structure and relationships
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Models
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = "position";
    protected $primaryKey = 'position_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'position_id',
        'position_name',
        'basic_salary'
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class, 'position_id', 'position_id');
    }
}
