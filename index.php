<?php

// NOTE این قسمت باید چند بخش دیگه تکرار بشه تا امینت داشته باشه
$core_path = __DIR__ . '/core/sys/';
$required_files = ['env.php', 'map.php', 'stat.php'];

if (!is_dir(__DIR__ . '/core')) {
    die("Critical system folder missing!");
}

foreach ($required_files as $file) {
    if (!file_exists($core_path . $file)) {
        die("Critical system file missing: $file");
    }
}

require __DIR__ . '/core/sys/map.php';

echo m_x();

require_once 'config.php';
header('location: login');
