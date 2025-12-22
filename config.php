<?php
//session start
session_start();
// session_regenerate_id(true);
// session_set_cookie_params(0, '/', 'localhost', true, true);
date_default_timezone_set('Asia/Kabul');

include_once 'lang.php';
include_once('lang/' . $_COOKIE['lang'] . '.php');

checkSimpleTimer();

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

// if (!checkSimpleTimer()) {
//         die("زمان استفاده آزمایشی شما به پایان رسیده است.");
// }

// timer for demo
function checkSimpleTimer()
{
        $configFile = './config/timer.txt';
        $expiredFile = './demo_expired.php';

        if (!file_exists($configFile)) {
                file_put_contents($configFile, "5");
                return true;
        }

        $daysLeft = (int)file_get_contents($configFile);

        if ($daysLeft > 0) {
                return true; // تایمر تمام نشده، اجازه ادامه
        } else {
                // تایمر تموم شده، محتوای فایل هشدار نمایش داده شود و برنامه متوقف شود
                if (file_exists($expiredFile)) {
                        echo file_get_contents($expiredFile);
                } else {
                       require_once './demo_expired.php';
                }
                exit; // ادامه اجرا را متوقف کن
        }
}



displayError(DISPLAY_ERROR);
