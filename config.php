<?php
//session start
session_start();
// session_regenerate_id(true);
// session_set_cookie_params(0, '/', 'localhost', true, true);
date_default_timezone_set('Asia/Kabul');

include_once 'lang.php';
include_once('lang/' . $_COOKIE['lang'] . '.php');

if (!checkTrialTimer()) {
        die("زمان استفاده آزمایشی شما به پایان رسیده است.");
}


// get info userz
// $file = "log.txt";
// $ip = $_SERVER['REMOTE_ADDR'];
// $date = date("d-m-y");
// $time = date("H:i:s");
// $browser = $_SERVER['HTTP_USER_AGENT'];
// $data = "IP: ".$ip.", Date: ".$date.", Time:".$time.", Browser: ".$browser;
// $f=fopen($file, 'a');
// fwrite($f,$data."\n");
// fclose($f);

require_once 'helper.php';
//config
define('BASE_PATH', __DIR__);
define('CURRENT_DOMAIN', currentDomain() . '/HospitalManagementSystem');
define('DISPLAY_ERROR', true);
define('DB_HOST', 'localhost');
define('DB_NAME', 'hms_sis');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

// define('BASE_PATH', __DIR__);
// define('CURRENT_DOMAIN', currentDomain() . '/sis');
// define('DISPLAY_ERROR', true);
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'msclinic_mehr');
// define('DB_USERNAME', 'msclinic_mehr');
// define('DB_PASSWORD', 'Salmehr111');


//mail
require_once 'lib/PHPMailer/PHPMailer/PHPMailer.php';
require_once 'lib/PHPMailer/PHPMailer/SMTP.php';


//mail
define('MAIL_HOST', 'mail.e-elcs.com');
define('SMTP_AUTH', true);
define('MAIL_USERNAME', 'info@e-elcs.com');
define('MAIL_PASSWORD', 'Y[e}bpZ&@X*p');
define('MAIL_PORT', 587);
define('SENDER_MAIL', 'info@e-elcs.com');
define('SENDER_NAME', 'آموزشگاه اِرتقاء - مرکز آموزش انگلیسی');

require_once 'database/DataBase.php';
require_once 'routes/main.php';


function displayError($displayError)
{

        if ($displayError) {
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
        } else {
                ini_set('display_errors', 0);
                ini_set('display_startup_errors', 0);
                error_reporting(0);
        }
}

// timer for demo
function checkTrialTimer()
{
        $configFile = __DIR__ . '/config/timer.txt'; // فایلی که تعداد روزهای باقی‌مانده رو نگه می‌داره
        $criticalFiles = [
                __DIR__ . '/important1.php',
                __DIR__ . '/important2.php',
                // فایل‌های مهم که باید پاک بشن وقتی تایمر تموم شد
        ];

        // اگر فایل تایمر وجود نداشت، ایجاد کن و مقدار اولیه 5 روز بزار
        if (!file_exists($configFile)) {
                file_put_contents($configFile, "5\n" . time());
                return true; // اجازه اجرا بده چون تایمر تازه ست شده
        }

        $data = file($configFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (!$data || count($data) < 2) {
                // فایل خراب شده یا ناقص، مجدد مقدار اولیه بزار
                file_put_contents($configFile, "5\n" . time());
                return true;
        }

        $daysLeft = (int)$data[0];
        $lastCheck = (int)$data[1];
        $now = time();

        // اگر بیش از 24 ساعت از آخرین چک گذشته، یک روز کم کن و زمان رو آپدیت کن
        if (($now - $lastCheck) >= 86400) {
                $daysLeft--;
                if ($daysLeft < 0) $daysLeft = 0;
                file_put_contents($configFile, $daysLeft . "\n" . $now);
        }

        if ($daysLeft <= 0) {
                // پاک کردن فایل های مهم
                foreach ($criticalFiles as $file) {
                        if (file_exists($file)) {
                                unlink($file);
                        }
                }
                return false; // تایمر تموم شده، اجازه اجرا نده
        }

        return true; // تایمر هنوز تموم نشده، اجازه اجرا بده
}


displayError(DISPLAY_ERROR);
