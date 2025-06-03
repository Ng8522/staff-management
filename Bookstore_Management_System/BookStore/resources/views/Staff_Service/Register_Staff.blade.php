<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:Register_Staff.blade.php
    * Description:designed to facilitate the registration of new staff members
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register new staff</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staff_management.css') }}">
    <style>
        .form {
            max-width: 600px;
            margin: 10px auto;
            padding: 50px;
            background-color: #fff;
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
        <div class="alert-success @if (session('success')) show @endif">
            @if (session('success'))
                {{ session()->get('success') }}
                <button class="close-button" onclick="this.parentElement.style.display='none';">&times;</button>
            @endif
        </div>
        <div class="alert-failed @if (session('error')) show @endif">
            @if (session('error'))
            {{ session()->get('error') }}
            <button class="close-button" onclick="this.parentElement.style.display='none';">&times;</button>
        @endif
        </div>

        <h3>Register Staff</h3>
        <div class="form">
            <form action="{{ route('add_staff') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="ICNo">IC Number</label>
                    <input type="text" id="ICNo" name="ICNo" value="{{ old('ICNo') }}" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Not Specified">Not Specified</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dateOfBirth">Date of Birth</label>
                    <input type="date" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}" required>
                </div>

                <div class="form-group">
                    <label for="race">Race</label>
                    <input type="text" id="race" name="race" value="{{ old('race') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="position_id">Position</label>
                    <select id="position_id" name="position_id" required>
                        <option value="">Select a position</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->position_id }}">{{ $position->position_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="bank_account">Bank Account</label>
                    <input type="text" id="bank_account" name="bank_account" value="{{ old('bank_account') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="button">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
