<?php

namespace App\Security;
/**
 * File Name: DataProtection.php
 * Description:  provides methods for encrypting and decrypting data using AES-256-CTR encryption, utilizing a secret key derived from an environment variable and a fixed initialization vector (IV).
 *
 * Author: Ng Jun Yu
 * Date: 22/9/2024
 *
 * @package Security
 */
class DataProtection {

    private $secretKey;
    private $ciphering = "AES-256-CTR";
    private $options = 0;
    private $iv;

    public function __construct() {
        $this->secretKey = substr(hash('sha256', env('DATA_PROTECTION_KEY')), 0, 32);
        $this->iv = substr(hash('sha256', 'bookstore-management-system-iv'), 0, openssl_cipher_iv_length($this->ciphering));
    }

    public function encryptData($data) {
        $encryptedData = openssl_encrypt($data, $this->ciphering, $this->secretKey, $this->options, $this->iv);
        return base64_encode($encryptedData);
    }

    public function decryptData($encryptedData) {
        $encryptedData = base64_decode($encryptedData);
        return openssl_decrypt($encryptedData, $this->ciphering, $this->secretKey, $this->options, $this->iv);
    }
}