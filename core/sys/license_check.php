<?php
require_once __DIR__ . '/sign.php';

function verify_license(string $jsonLicense, string $currentFingerprint): bool
{
    $license = json_decode($jsonLicense, true);
    if (!$license || !isset($license['data'], $license['signature'])) {
        return false;
    }

    $data = json_encode($license['data'], JSON_UNESCAPED_SLASHES);
    $signature = $license['signature'];

    // بررسی امضا
    if (!verify_signature($data, $signature)) {
        return false;
    }

    $info = $license['data'];

    // بررسی تاریخ انقضا
    $today = new DateTime();
    $expire = DateTime::createFromFormat('Y-m-d', $info['expire_date']);
    if ($expire < $today) {
        return false;
    }

    // بررسی fingerprint
    if ($info['fingerprint'] !== $currentFingerprint) {
        return false;
    }

    return true;
}
