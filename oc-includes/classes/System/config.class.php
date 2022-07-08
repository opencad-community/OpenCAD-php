<?php

namespace System;

class Config extends \Dbh
{
    public function generateAPI()
    {
        $key = generateRandomString(64);
        $stmt = $this->connect()->prepare("UPDATE " . DB_PREFIX . "config SET `value`='[$key]'");
        if (!$stmt->execute()) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    public function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function getAllTrueOptions(){
        $stmt = $this->connect()->prepare("SELECT * FROM " . DB_PREFIX . "options WHERE `autoload`='1'");
        if (!$stmt->execute()) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    public function encryptString($key){
        $value = $key;

        // Encrpy key
        $ciphering = "AES-256-CTR";

        // Use OpenSSl Encryption method
        $options = 0;

        // Non-NULL Initialization Vector for encryption
        $encryption_iv = substr(NONCE_KEY, 0, 16);

        // Store the encryption key
        $encryption_key = SECURE_AUTH_KEY;

        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt(
            $value,
            $ciphering,
            $encryption_key,
            $options,
            $encryption_iv
        );

        return $encryption;
    }

    public function decrpytString($key)
    {
        $key = $key;

        // Encrpy key
        $ciphering = "AES-256-CTR";

        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for decryption
        $decryption_iv = substr(NONCE_KEY, 0, 16);

        // Store the decryption key
        $decryption_key = SECURE_AUTH_KEY;

        // Use openssl_decrypt() function to decrypt the data
        $decryption = openssl_decrypt(
            $key,
            $ciphering,
            $decryption_key,
            $options,
            $decryption_iv
        );

        return $decryption;
    }
}
