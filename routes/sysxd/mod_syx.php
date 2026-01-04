 <?php
    // مسیر کامل فایل تنظیمات لایسنس
    $config_file = __DIR__ . '/cfg_syx.json';


    function getCpuId()
    {
        $cpuId = '';

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            @exec('wmic cpu get ProcessorId', $output);
            if (isset($output[1])) {
                $cpuId = trim($output[1]);
            }
        }

        return $cpuId;
    }

    function getDiskSerial()
    {
        $diskId = '';

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            @exec('wmic diskdrive get SerialNumber', $output);
            if (isset($output[1])) {
                $diskId = trim($output[1]);
            }
        }

        return $diskId;
    }



    

    function generateHardwareId()
    {
        $data = [];

        // نام سیستم
        $data[] = php_uname('n');

        // سیستم عامل
        $data[] = php_uname('s') . php_uname('r');

        // مسیر اصلی دیسک
        $data[] = __DIR__;

        // MAC Address (در صورت امکان)
        $mac = '';
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            @exec('getmac', $output);
            if (!empty($output[0])) {
                $mac = $output[0];
            }
        } else {
            @exec("ifconfig -a | grep ether", $output);
            if (!empty($output[0])) {
                $mac = $output[0];
            }
        }

        $data[] = $mac;

        // ساخت هش نهایی
        return hash('sha256', implode('|', $data));
    }




    // ===== بررسی فاصله زمانی چک =====

    $checkInterval = 3600; // 1 ساعت (به ثانیه)
    $now = time();

    if (
        isset($config['last_check']) &&
        $config['last_check'] > 0 &&
        ($now - $config['last_check']) < $checkInterval
    ) {
        // اخیراً بررسی شده، نیازی به بررسی مجدد نیست
        return;
    }




    // بررسی وجود فایل تنظیمات
    if (!file_exists($config_file)) {
        die('not file!');
    }

    // خواندن محتویات فایل
    $config_content = file_get_contents($config_file);

    // تبدیل JSON به آرایه PHP
    $config = json_decode($config_content, true);







    // ===== بررسی تاریخ انقضا =====

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





    // ===== تشخیص دستکاری تاریخ سیستم =====

    $todayDate = date('Y-m-d');
    $lastRunDate = $config['last_run_date'];

    if (strtotime($todayDate) < strtotime($lastRunDate)) {
        die('❌ خطا: تاریخ سیستم دستکاری شده است.');
    }


    // ذخیره تاریخ اجرای فعلی
    $config['last_run_date'] = $todayDate;

    // ذخیره مجدد در فایل
    file_put_contents(
        $config_file,
        json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );




    // ===== بررسی سخت‌افزار =====

    $currentHardwareId = generateHardwareId();

    // اگر برای اولین بار اجرا می‌شود
    if (empty($config['hardware_id']) || $config['hardware_id'] === 'sample-hardware-id') {
        // قفل روی این سیستم
        $config['hardware_id'] = $currentHardwareId;
    } else {
        // مقایسه با مقدار ذخیره‌شده
        if ($config['hardware_id'] !== $currentHardwareId) {
            die('❌ این لایسنس مخصوص این سیستم نیست.');
        }
    }





    // ===== ذخیره زمان آخرین بررسی =====

    $config['last_check'] = $now;

    file_put_contents(
        $config_file,
        json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );



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
