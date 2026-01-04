<?php
// core/sys/cache_check.php

$cache_check_file = __DIR__ . '/.last_check';

function shouldRunCheck($intervalSeconds = 3600) {
    global $cache_check_file;
    if (!file_exists($cache_check_file)) {
        return true;
    }

    $last = (int)file_get_contents($cache_check_file);
    $now = time();
    return (($now - $last) > $intervalSeconds);
}

function updateCheckTime() {
    global $cache_check_file;
    file_put_contents($cache_check_file, time());
}
