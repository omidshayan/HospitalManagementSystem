<?php
//session start
session_start();
// session_regenerate_id(true);

date_default_timezone_set('Asia/Kabul');

include_once 'lang.php';
include_once('lang/' . $_COOKIE['lang'] . '.php');

require_once 'helper.php';


//config
define('BASE_PATH', __DIR__);
define('CURRENT_DOMAIN', currentDomain() . '/HospitalManagementSystem');
define('DISPLAY_ERROR', true);
define('DB_HOST', 'localhost');
define('DB_NAME', 'hms_sis');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

define('CPU', 'BFEBFBFF000306C3');
define('HDD', 'S250NXAH334410L');

define('start_date', '2020-01-01');
define('end_date', '2026-12-31');


//mail
require_once 'lib/PHPMailer/PHPMailer/PHPMailer.php';
require_once 'lib/PHPMailer/PHPMailer/SMTP.php';

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

displayError(DISPLAY_ERROR);
