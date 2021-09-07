<?php

// Const with used in this algorithm charset
define('CHARSTR', '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

/**
 *  This function returns generated string or false if there was an error happen
 * @return false|string
 */
function generateRandomHash() {
    try {
        $gen_str = '';

        // 1. Preparing a random (with high cryptographic stability) string length
        $str_length = random_int(20, 40);

        // 2. Fill the string with random chars from const
        for ($i = 0; $i < $str_length; $i++) {
            $index = rand(0, strlen(CHARSTR) - 1);
            $gen_str[$i] = CHARSTR[$index];
        }

        // 3. Getting sha-256 hash function with prepared string and return it
        $gen_str = hash('sha256', $gen_str);
        return $gen_str;
    } catch (Exception $e) {
        return false;
    }
}
