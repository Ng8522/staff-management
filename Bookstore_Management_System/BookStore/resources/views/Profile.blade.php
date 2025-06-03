<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:Profile.blade.php
    * Description:outlines the staff profile interface
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>User Profile</title>
    <style>
        .container {
            max-width: 600px;
            margin: 20px auto;
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

        input {
            height: 2em;
            width: 40%;
        }

        button {
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

        .alert-success {
            display: none;
            background-color: #cef9d3;
            color: darkgreen;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .alert-success.show {
            display: block;
        }

        .alert-failed {
            display: none;
            background-color: #fdc8c8;
            color: rgb(241, 23, 23);
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .alert-failed.show {
            display: block;
        }

    </style>
</head>

<body>
    <header>
        <h1>
            Your Profile
        </h1>
        <nav>
            <ul>
                @if (session('staffid'))
                    <li><a href="{{ route('home') }}">Back to Home</a></li>
                @endif
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="alert-success @if (session('success')) show @endif">
                {{ session('success') }}
            </div>
            <div class="alert-failed @if ($errors->has('error')) show @endif">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <h2>Fill in the form</h2>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $staff->name) }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="dateOfBirth">Date of Birth</label>
                    <input type="date" name="dateOfBirth" class="form-control" value="{{ $staff->dateOfBirth }}">
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="Male" {{ $staff->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $staff->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Not Specified" {{ $staff->gender == 'Not Specified' ? 'selected' : '' }}>Not
                            Specified</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="race">Race</label>
                    <input type="text" name="race" class="form-control" value="{{ $staff->race }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $staff->email) }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="ICNo">IC Number</label>
                    <input type="text" id="ICNo" name="ICNo" value="{{ old('ICNo', $staff->ICNo) }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="bank_account">Bank Account</label>
                    <input type="text" id="bank_account" name="bank_account"
                        value="{{ old('bank_account', $staff->bank_account) }}" required>
                </div>
                <button type="submit">Update Profile</button>
            </form>
        </div>
    </main>
</body>

</html>
