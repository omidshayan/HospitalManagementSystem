<?php
// core/sys/hardware.php

function get_cpu_id(): string {
    // اجرای دستور wmic برای گرفتن شناسه CPU در ویندوز
    $cpuId = trim(shell_exec('wmic cpu get processorid 2>&1'));
    // خروجی دستور معمولا شامل یک خط اول عنوان است، پس خط اول را حذف می‌کنیم
    $lines = explode("\n", $cpuId);
    return trim($lines[1] ?? '');
}

function get_disk_id(): string {
    // گرفتن شناسه دیسک سیستم (اولین دیسک فیزیکی)
    $diskId = trim(shell_exec('wmic diskdrive get serialnumber 2>&1'));
    $lines = explode("\n", $diskId);
    return trim($lines[1] ?? '');
}
