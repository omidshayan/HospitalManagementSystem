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

if (!verify_license($licenseJson, $currentFingerprint)) {
    die("License is invalid or expired. Please contact support.");
}
require_once 'config.php';
header('location: login');
