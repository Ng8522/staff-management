<!DOCTYPE html>
<html lang="en">
<!--
/**
 * File Name: xpath_results.blade.php
 * Description:  Page for display Xpath request
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XPath Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Books Retrieved with XPath</h1>
        <table class="table table-striped">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Year</th>
                <th>Price</th>
            </tr>
            @foreach ($books as $book)
                <tr>
                    <td>{{ (string) $book->title }}</td>
                    <td>{{ (string) $book->author }}</td>
                    <td>{{ (string) $book->publisher }}</td>
                    <td>{{ (string) $book->year }}</td>
                    <td>{{ (string) $book->price }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
