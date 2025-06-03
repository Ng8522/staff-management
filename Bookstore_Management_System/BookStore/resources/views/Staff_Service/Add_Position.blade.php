<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:Add_Position.blade.php
    * Description:creates a user interface for adding a new position within a staff management system.
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Position</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staff_management.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #ff4d4d;
            outline: none;
        }

        .button {
            display: inline-block;
            background-color: #ff4d4d;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            width: 100%;
        }

        .button:hover {
            background-color: #e60000;
        }
    </style>
</head>

<body>
    @include('Staff_Service.header_sidebar')

    <div class="container">
        <h3>Add Position</h3>
        <div class="alert-failed @if (session('error')) show @endif">
            @if (session('error'))
                {{ session()->get('error') }}
                <button class="close-button" onclick="this.parentElement.style.display='none';">&times;</button>
            @endif
        </div>

        <form action="{{ route('add_position') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="position_name">Position Name:</label>
                <input type="text" id="position_name" name="position_name" value="{{ old('position_name') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="basic_salary">Basic Salary:</label>
                <input type="number" step="0.01" id="basic_salary" name="basic_salary"
                    value="{{ old('basic_salary') }}" min="0" required>
            </div>

            <div class="form-group">
                <button type="submit" class="button">Add Position</button>
            </div>
        </form>
    </div>

</body>

</html>
