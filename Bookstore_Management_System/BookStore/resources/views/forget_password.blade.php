<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:forget_password.blade.php
    * Description:allows users to request a password reset by entering their registered email address.
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        <div class="forgot-password-form">
            <h1>Reset Password</h1>
                <div class="alert-success  @if (session('status')) show @endif">
                    {{ session('status') }}
                </div>

                <div class="alert-failed @if ($errors->has('error')) show @endif">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            <form method="POST" action="{{ route('send-reset-email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <button type="submit">Send Password Reset Link</button>
            </form>
            <div class="back-to-login">
                <a href="{{ route('login') }}">Back to Login</a>
            </div>
        </div>
    </div>
</body>

</html>
