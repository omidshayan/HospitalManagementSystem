<?php
require_once __DIR__ . '/sign.php';

function create_license_data(array $info): string
{
    /*
     $info: آرایه اطلاعات لایسنس مانند:
     [
       'license_key' => 'OMID-9F3K-A72D-1QXZ',
       'fingerprint' => 'hashed fingerprint',
       'issue_date'  => '2026-01-04',
       'expire_date' => '2027-01-04',
       'product'     => 'MyOfflineSystem'
     ]
    */

    $data = json_encode($info, JSON_UNESCAPED_SLASHES);
    $signature = sign_data($data);

    $license = [
        'data' => $info,
        'signature' => $signature,
    ];

    return json_encode($license, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}
