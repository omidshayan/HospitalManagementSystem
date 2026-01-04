<?php
require_once __DIR__ . '/sign.php';

function days_until_expire(string $expireDate): int
{
    $today = new DateTime();
    $expire = DateTime::createFromFormat('Y-m-d', $expireDate);
    if ($expire < $today) {
        return 0;
    }
    return (int)$today->diff($expire)->format('%a');
}


function verify_license(string $jsonLicense, string $currentFingerprint): array
{
    $license = json_decode($jsonLicense, true);
    if (!$license || !isset($license['data'], $license['signature'])) {
        return ['valid' => false, 'message' => 'Invalid license format'];
    }

    $data = json_encode($license['data'], JSON_UNESCAPED_SLASHES);
    $signature = $license['signature'];

    if (!verify_signature($data, $signature)) {
        return ['valid' => false, 'message' => 'Invalid signature'];
    }

    $info = $license['data'];
    if ($info['fingerprint'] !== $currentFingerprint) {
        return ['valid' => false, 'message' => 'Fingerprint mismatch'];
    }

    $today = new DateTime();
    $issueDate = DateTime::createFromFormat('Y-m-d', $info['issue_date']);
    $expireDate = DateTime::createFromFormat('Y-m-d', $info['expire_date']);

    if ($today < $issueDate) {
        return ['valid' => false, 'message' => 'License not active yet'];
    }

    if ($today > $expireDate) {
        return ['valid' => false, 'message' => 'License expired'];
    }

    $daysLeft = (int)$today->diff($expireDate)->format('%a');

    return ['valid' => true, 'days_left' => $daysLeft];
}
