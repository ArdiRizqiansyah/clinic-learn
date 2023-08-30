<?php
// generate random code

use Illuminate\Support\Facades\DB;

function generateRandomCode($codeDigits = 8)
{
    // buat random code
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomCode = '';

    for ($i = 0; $i < $codeDigits; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomCode .= $characters[$index];
    }

    return $randomCode;
}

function getRandomCode($table)
{
    do {
        $code = generateRandomCode();
    } while (DB::table($table)->where('kode', $code)->exists());

    return $code;
}
?>