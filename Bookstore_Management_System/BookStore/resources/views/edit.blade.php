<!DOCTYPE html>
<html lang="en">
<!--
/**
 * File Name: edit.blade.php
 * Description:  Staff page for editing a Book record
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Book</h1>

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title"
                    value="{{ old('title', $book->title) }}" required>
            </div>

            <div class="form-group">
                <label for="authors">Author(s):</label>
                <input type="text" class="form-control" name="authors" id="authors"
                    value="{{ old('authors', $book->authors) }}" placeholder="Author1, Author2, Author3" required>
            </div>

            <div class="form-group">
                <label for="publisher">Publisher:</label>
                <input type="text" class="form-control" name="publisher" id="publisher"
                    value="{{ old('publisher', $book->publisher) }}" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" name="category" id="category" required>
                    <option value="Drama" {{ old('category', $book->category) == 'Drama' ? 'selected' : '' }}>Drama
                    </option>
                    <option value="Epic" {{ old('category', $book->category) == 'Epic' ? 'selected' : '' }}>Epic
                    </option>
                    <option value="Poetry" {{ old('category', $book->category) == 'Poetry' ? 'selected' : '' }}>Poetry
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="cover">Cover Image:</label>
                <input type="file" class="form-control-file" name="cover" id="cover" accept="image/*">
                @if ($book->cover)
                    <p>Current Cover:</p>
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="Current Cover"
                        style="width: 100px; height: auto;" />
                @endif
            </div>

            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" class="form-control" name="year" id="year" min="0"
                    value="{{ old('year', $book->year) }}" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" name="price" id="price" min="0" step="0.01"
                    value="{{ old('price', $book->price) }}">
            </div>

            <div class="form-group">
                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" class="form-control" name="stock_quantity" id="stock_quantity" min="0"
                    value="{{ old('stock_quantity', $book->stock_quantity) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Book</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>
