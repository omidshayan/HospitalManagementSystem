<?php
require_once __DIR__ . '/core/sys/map.php';
require_once __DIR__ . '/core/sys/license_data.php';

$info = [
    'license_key' => 'OMID-9F3K-A72D-1QXZ',
    'fingerprint' => m_x(),
    'issue_date' => date('Y-m-d'),
    'expire_date' => date('Y-m-d', strtotime('+1 year')),
    'product' => 'MyOfflineSystem',
    'license_type' => 'Basic', // یا 'Pro' یا 'Enterprise'
];


$licenseJson = create_license_data($info);

file_put_contents(__DIR__ . '/license.lic', $licenseJson);

echo "License file created with current system fingerprint.\n";
