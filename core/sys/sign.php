<?php
require_once __DIR__ . '/ret.php';

function sign_data(string $data): string
{
    return hash_hmac('sha256', $data, secret_key());
}

function verify_signature(string $data, string $signature): bool
{
    $expected = sign_data($data);
    // مقایسه ثابت زمانی برای امنیت بهتر
    return hash_equals($expected, $signature);
}
