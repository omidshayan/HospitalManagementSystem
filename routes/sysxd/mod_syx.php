 <?php
    // مسیر کامل فایل تنظیمات لایسنس
    $config_file = __DIR__ . '/cfg_syx.json';

    // بررسی وجود فایل تنظیمات
    if (!file_exists($config_file)) {
        die('not file!');
    }

    // خواندن محتویات فایل
    $config_content = file_get_contents($config_file);

    // تبدیل JSON به آرایه PHP
    $config = json_decode($config_content, true);



    // تاریخ امروز سیستم
    $today = strtotime(date('Y-m-d'));

    // تاریخ انقضا از فایل لایسنس
    $expireDate = strtotime($config['expiration_date']);

    if ($today > $expireDate) {
        die('❌ لایسنس منقضی شده است. لطفاً لایسنس را تمدید نمایید.');
    }

    if (!$config) {
        die('خطا در خواندن یا تجزیه فایل تنظیمات لایسنس!');
    }

    // نمایش اطلاعات لایسنس
    echo "<h3>اطلاعات لایسنس:</h3>";
    echo "تاریخ انقضا: " . htmlspecialchars($config['expiration_date']) . "<br>";
    echo "شناسه سخت‌افزار: " . htmlspecialchars($config['hardware_id']) . "<br>";
    echo "آخرین بررسی: " . date('Y-m-d H:i:s', $config['last_check']) . "<br>";
    echo "شناسه کاربر: " . htmlspecialchars($config['user_id']) . "<br>";
    echo "شناسه لایسنس: " . htmlspecialchars($config['license_id']) . "<br>";
    echo "نسخه نرم‌افزار: " . htmlspecialchars($config['version']) . "<br>";
    echo "آخرین به‌روزرسانی آنلاین: " . ($config['last_online_update'] > 0 ? date('Y-m-d H:i:s', $config['last_online_update']) : 'هیچ') . "<br>";
    echo "وضعیت لایسنس: " . htmlspecialchars($config['status']) . "<br>";
    ?>
