<!DOCTYPE html>
<html lang="en">
<!--
/**
 * File Name: create.blade.php
 * Description:  Staff page for creating a new Book record
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h1>Add a New Book</h1>

        <form action="{{ url('books') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="form-group">
                <label for="authors">Author(s):</label>
                <input type="text" class="form-control" name="authors" id="authors"
                    placeholder="Author1, Author2, Author3" required>
            </div>

            <div class="form-group">
                <label for="publisher">Publisher:</label>
                <input type="text" class="form-control" name="publisher" id="publisher" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" name="category" id="category" required>
                    <option value="Drama">Drama</option>
                    <option value="Epic">Epic</option>
                    <option value="Poetry">Poetry</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cover">Cover Image:</label>
                <input type="file" class="form-control-file" name="cover" id="cover" accept="image/*">
            </div>

            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" class="form-control" name="year" id="year" min="0" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" name="price" id="price" min="0" step="1"
                    value="0.00">
            </div>
            <div class="form-group">
                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" class="form-control" name="stock_quantity" id="stock_quantity" min="0"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Save Book</button>
        </form>
    </div>
</body>

</html>
