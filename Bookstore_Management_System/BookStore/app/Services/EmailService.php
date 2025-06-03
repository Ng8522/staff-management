<?php

namespace App\Services;
/**
 * File Name: EmailService.php
 * Description:handles the process of sending password reset links to users
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Services
 */
use Illuminate\Support\Facades\Http;
use App\Models\PasswordReset;
use Illuminate\Support\Str;

class EmailService{
    public function sendResetLink($email)
    {
        $resetToken = Str::random(60);
        $resetLink = url('/reset-password?token=' . base64_encode($resetToken));
        $this->storeResetToken($email, $resetToken);

        $url = env('JAVA_SERVICE_URL');
        $response = Http::post($url, [
            'email' => $email,
            'resetLink' => $resetLink,
        ]);
        return $response->successful();
    }

    protected function storeResetToken($email, $token)
    {
        PasswordReset::updateOrCreate(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );
    }

}