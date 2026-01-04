<?php

require __DIR__ . '/core/sys/env.php';

echo e_h() . '<br>';
echo e_o() . '<br>';
echo e_d();


require_once 'config.php';
header('location: login');
