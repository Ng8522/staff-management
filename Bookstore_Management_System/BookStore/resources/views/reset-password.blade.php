<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:reset-password.blade.php
    * Description:outlines the reset password interface
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Reset Password</title>
</head>

<body>
    <div class="container">
        <h1>Reset Password</h1>
        <div class="alert-success @if (session('status')) show @endif">
            {{ session('status') }}
        </div>

        <div class="alert-failed @if ($errors->has('error')) show @endif">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <form action="{{ route('update-password') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>

</html>
