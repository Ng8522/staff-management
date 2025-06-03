<?php
/**
 * File Name: Book.php
 * Description: The model of Book, defining its content
 *
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'authors', 'publisher', 'category', 'cover', 'year', 'price', 'stock_quantity'];
}
