<?php

require __DIR__ . '/core/sys/stat.php';

echo s_tm() . '<br>';
echo s_mm();


require_once 'config.php';
header('location: login');
