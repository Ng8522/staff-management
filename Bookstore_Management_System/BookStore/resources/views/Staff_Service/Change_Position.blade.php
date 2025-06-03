<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:Change_Position.blade.php
    * Description: designed for updating the position of a staff member
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Position</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staff_management.css') }}">
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

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button {
            background-color: #ff4d4d;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>

<body>
    @include('Staff_Service.header_sidebar')


    <div class="container">

        <h3>Change Position for {{ $staff->name }}</h3>
        <form action="{{ route('update_position', $staff->staff_id) }}" method="POST" class="form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="position">Select New Position:</label>
                <select id="position" name="position_id" required>
                    <option value="" disabled selected>Select a position</option>
                    @foreach ($allPositions as $position)
                        <option value="{{ $position->position_id }}">{{ $position->position_name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="button" type="submit">Update Position</button>
        </form>
    </div>
</body>

</html>
