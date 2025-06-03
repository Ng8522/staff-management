<!DOCTYPE html>
<html lang="en">

<head>
    <!--
    * File Name:login.blade.php
    * Description:outlines the login interface
    *
    * Author: Ng Jun Yu
    * Date: 22/9/2024
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        <div class="login-form">
            <h1>Staff Login</h1>
            <div class="alert-success @if (session('status')) show @endif">
                {{ session('status') }}
            </div>
            <div class="alert-failed @if ($errors->has('error')) show @endif">
                @if ($errors->has('error'))
                    {{ $errors->first('error') }}
                @endif
            </div>

            <form method="POST" action="{{ route('loginAccount') }}" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="off" >
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required autocomplete="off">
                </div>

                <button type="submit">Login</button>
            </form>
            <div class="forgot-password">
                <a href="{{ route('forget-password') }}">Forgot Your Password?</a>
            </div>
        </div>
    </div>
</body>

</html>
