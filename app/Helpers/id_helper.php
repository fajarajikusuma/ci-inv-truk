<?php
// app/Helpers/id_helper.php

if (!function_exists('encode_id')) {
    /**
     * Encrypt and URL-safe encode an integer/string id
     *
     * @param mixed $id
     * @return string
     */
    function encode_id($id)
    {
        // get encrypter service
        $encrypter = \Config\Services::encrypter();

        // encrypt (returns binary)
        $cipher = $encrypter->encrypt((string)$id);

        // base64 encode then make URL-safe
        $b64 = base64_encode($cipher);
        $urlSafe = strtr($b64, '+/', '-_'); // remove + and /
        $urlSafe = rtrim($urlSafe, '='); // trim padding

        return $urlSafe;
    }
}

if (!function_exists('decode_id')) {
    /**
     * Decode URL-safe encrypted id back to original
     *
     * @param string $encoded
     * @return string|false original id string, or false on failure
     */
    function decode_id($encoded)
    {
        if (empty($encoded)) return false;

        // restore base64 padding
        $b64 = strtr($encoded, '-_', '+/');
        $pad = strlen($b64) % 4;
        if ($pad) {
            $b64 .= str_repeat('=', 4 - $pad);
        }

        $cipher = base64_decode($b64, true);
        if ($cipher === false) return false;

        try {
            $encrypter = \Config\Services::encrypter();
            $plain = $encrypter->decrypt($cipher);
            return $plain;
        } catch (\Throwable $e) {
            // decrypt failed
            return false;
        }
    }
}
