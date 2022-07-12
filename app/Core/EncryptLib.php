<?php

namespace App\Core;

class EncryptLib
{
    private static $key;
    private static $iv;


    public static function encryptString($plaintext, $key = null, $iv = null)
    {
        self::setKeyAndIv($key, $iv);
        $ciphertext = openssl_encrypt($plaintext, "AES-256-CBC", self::$key, OPENSSL_RAW_DATA, self::$iv);

        return base64_encode($ciphertext);
    }

    public static function decryptString($ciphertext, $key = null, $iv = null)
    {
        self::setKeyAndIv($key, $iv);
        $str = openssl_decrypt(base64_decode($ciphertext), 'AES-256-CBC', self::$key, OPENSSL_RAW_DATA, self::$iv);
        return $str;
    }

    protected static function setKeyAndIv($key, $iv)
    {
        if ($key) {
            self::$key =  $key;
        } else {
            self::$key = config('app.encrypt_key');
        }

        if ($iv) {
            self::$iv = $iv;
        } else {
            self::$iv = config('app.encrypt_iv');
        }
    }
}
