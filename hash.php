<?php


define('CPU', 'BFEBFBFF000306C3');
define('HDD', 'S250NXAH334410L');

define('start_date', '2020-01-01');
define('end_date', '2026-12-31');


define('LICENSE_SECRET', 'x9@A#pQ!29sL');

$raw = CPU . '|' . HDD . '|' . start_date . '|' . end_date . '|' . LICENSE_SECRET;
$signature = hash('sha256', $raw);
echo $signature;
