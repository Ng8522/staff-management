<!DOCTYPE html>
<html lang="en">
<!--
/**
 * File Name: error.blade.php
 * Description:  Page when unauthorized personnel accessing the staff pages
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */
-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Access Denied</h1>
        <p>You do not have permission to access this page. Please log in to continue.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Go to Home</a>
    </div>
</body>

</html>
