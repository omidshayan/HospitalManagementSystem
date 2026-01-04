<?php


// NOTE این قسمت باید چند بخش دیگه تکرار بشه تا امینت داشته باشه
require_once __DIR__ . '/core/sys/license_check.php';
require_once __DIR__ . '/core/sys/map.php';

$licenseFile = __DIR__ . '/license.lic';

if (!file_exists($licenseFile)) {
    die("License file not found!");
}

$licenseJson = file_get_contents($licenseFile);
$currentFingerprint = m_x();

$result = verify_license($licenseJson, $currentFingerprint);

if (!$result['valid']) {
    die("License is invalid: " . $result['message']);
}

if ($result['days_left'] <= 30) {
    echo "<div style='color:orange; font-weight:bold;'>Warning: Your license will expire in {$result['days_left']} day(s).</div>";
}

// ادامه اجرای برنامه ...


require_once 'config.php';
header('location: login');
