<?php
/**
 * File Name: 2024_09_20_122231_create_books_table.php
 * Description:  Schema for database in adding or removing record of Book
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('authors');
            $table->string('publisher');
            $table->enum('category', ['Drama', 'Epic', 'Poetry']);
            $table->string('cover'); // Store the path for the uploaded image
            $table->integer('year')->default(0);
            $table->decimal('price', 10, 2)->default(0.00);
            $table->integer('stock_quantity')->default(0);
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
