<?php

namespace App;

require_once 'Http/Auth/Login.php';
require_once 'lib/jdf.php';
require_once 'Http/Controllers/Middleware.php';


use database\DataBase;

use Auth\Login;

class App
{
        use Middleware;
        protected $currentDomain;
        protected $basePath;
        protected $db;
        function __construct()
        {
                $auth = new Login();
                $auth->userCheck();
                $this->db = DataBase::getInstance();
                $this->currentDomain = CURRENT_DOMAIN;
                $this->basePath = BASE_PATH;
        }

        // format score
        public function formatScore($score)
        {
                if (!is_numeric($score)) {
                        return $score;
                }
                if (is_array($score)) {
                        return array_map([$this, 'formatScore'], $score);
                }
                return preg_replace('/\.00$/', '', number_format((float) $score, 2, '.', ''));
        }

        // validate request
        public function validateRequest($request, ...$fields)
        {
                foreach ($fields as $field) {
                        if (empty($request[$field])) {
                                $this->flashMessage('error', 'اطلاعات ارسالی معتبر نیست!');
                                return false;
                        }
                }
                return true;
        }

        public function currentUser()
        {
                if (isset($_SESSION['hms_admin']) && !empty($_SESSION['hms_admin'])) {
                        return [
                                'id'   => $_SESSION['hms_admin']['id'],
                                'name' => $_SESSION['hms_admin']['name'],
                                'role' => 'admin'
                        ];
                }

                if (isset($_SESSION['hms_employee']) && !empty($_SESSION['hms_employee'])) {
                        return [
                                'id'        => $_SESSION['hms_employee']['id'],
                                'name'      => $_SESSION['hms_employee']['name'],
                                'role'      => 'employee',
                                'branch_id' => $_SESSION['hms_employee']['branch_id']
                        ];
                }

                $this->redirect('logout');
                exit;
        }

        // handle birth year
        public function getAge($birthYear)
        {
                $currentYear = jdate('Y');
                $currentYear = $this->convertPersionNumber($currentYear);
                return $currentYear - (int)$birthYear;
        }


        // validations start
        function validateInputs($inputs, $validateFields = [])
        {
                foreach ($inputs as $key => $value) {
                        if (!isset($validateFields[$key]) || $validateFields[$key]) {
                                $inputs[$key] = $this->validation($value);
                        }
                }
                return $inputs;
        }

        // update img 
        public function updateImageUpload(&$request, $fieldName, $destinationPath, $tableName, $recordId, $maxFileSize = 1048576)
        {
                if (!isset($_FILES[$fieldName]) || !is_uploaded_file($_FILES[$fieldName]['tmp_name'])) {
                        unset($request[$fieldName]);
                        return;
                }
                $file = $_FILES[$fieldName];
                if ($file['size'] > $maxFileSize) {
                        $this->flashMessage('error', 'حجم عکس نباید بیشتر از ' . ($maxFileSize / 1024 / 1024) . ' MB باشد');
                        unset($request[$fieldName]);
                        return;
                }

                $record = $this->db->select("SELECT * FROM {$tableName} WHERE id = ?", [$recordId])->fetch();
                if ($record && !empty($record[$fieldName])) {
                        $this->removeImage('public/images/' . $destinationPath . '/' . $record[$fieldName]);
                }
                $request[$fieldName] = $this->saveImage($file, 'images/' . $destinationPath);
        }

        // get convert age to jalali
        function getBirthYearFromAge($age)
        {
                $jalaliYearFa = jdate('Y');
                $jalaliYearEn = $this->convertPersionNumber($jalaliYearFa);

                return (int)$jalaliYearEn - (int)$age;
        }

        // change english number to persion
        function convertEnNumber($number)
        {
                $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                return str_replace($englishDigits, $persianDigits, $number);
        }

        // hash password
        public function hash($password)
        {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                return $hashPassword;
        } //end hash password

        function validation($data)
        {
                if (is_array($data)) {
                        return $this->validateInputs($data);
                }
                $user_input = array('<', '>', '/', '"', '\'', '(', ')', 'query', ',', ';', '[', ']', '$', 'SELEC', ':', '-', '=', '.', '#', '*', '%', '^', '&', "!", 'delete', 'DELETE', '@');
                $user_input = '/[<>\/"\(\),;[\]\$\:=-\.\#\*%\^&!@]/';
                $forbiddenWords = array('delete', 'DELETE', 'QUERY', 'query', 'select', 'SELECT');
                $data = str_replace($user_input, "", $data);
                $data = str_replace($forbiddenWords, "", $data);
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
        }

        // start validation empty inputs 
        public function checkEmptyInputs($inputs, $requiredInputs)
        {
                $emptyInputs = [];
                foreach ($requiredInputs as $inputName) {
                        if (empty($inputs[$inputName])) {
                                $emptyInputs[] = $inputName;
                        }
                }

                return $emptyInputs;
        }
        // end validation empty inputs 

        protected function validateImage($image)
        {
                $allowedFormats = ['jpeg', 'jpg', 'png'];
                $maxFileSize = 5 * 1024 * 1024; // 5 MB

                // Check if the file is a valid image
                $imageInfo = getimagesize($image['tmp_name']);
                if (!$imageInfo || !in_array($imageInfo['mime'], ['image/jpeg', 'image/png'])) {
                        return false;
                }

                // Check if the file format is allowed
                $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
                if (!in_array($fileExtension, $allowedFormats)) {
                        return false;
                }

                // Check if the file size is within the allowed limit
                if ($image['size'] > $maxFileSize) {
                        return false;
                }

                // If all checks pass, the image is valid
                return true;
        }

        // check time start
        function checkDaysForStartEnd($expireDate)
        {
                $currentTimestamp = time();
                $currentDate = floor($currentTimestamp / (24 * 3600)) * (24 * 3600);
                $dateFromTimestamp = floor($expireDate / (24 * 3600)) * (24 * 3600);
                $differenceInDays = floor(($dateFromTimestamp - $currentDate) / (24 * 3600));
                return $differenceInDays;
        }

        // check last days
        function daysSinceTimestamp($timestamp)
        {
                $currentTimestamp = time();
                $differenceInSeconds = $currentTimestamp - $timestamp;
                $differenceInDays = floor($differenceInSeconds / (60 * 60 * 24));
                return $differenceInDays;
        }

        // check end dayes
        function daysUntilTimestamp($futureTimestamp)
        {
                $currentTimestamp = time();
                $differenceInSeconds = $futureTimestamp - $currentTimestamp;
                $differenceInDays = ceil($differenceInSeconds / (60 * 60 * 24));
                return $differenceInDays;
        }

        // check dayes
        function calculateDays($timestamp)
        {
                $currentTimestamp = time();
                $differenceInSeconds = $timestamp - $currentTimestamp;
                if ($differenceInSeconds > 0) {
                        $differenceInDays = ceil($differenceInSeconds / (60 * 60 * 24));
                        return $differenceInDays;
                } else {
                        $differenceInDays = floor(abs($differenceInSeconds) / (60 * 60 * 24));
                        return $differenceInDays;
                }
        }

        // change date in shamsi
        function convertToJalali($gregorian_date)
        {
                $date_time_parts = explode(' ', $gregorian_date);
                $date_parts = explode('-', $date_time_parts[0]);
                $year = intval($date_parts[0]);
                $month = intval($date_parts[1]);
                $day = intval($date_parts[2]);
                $jalali_date = jdate('Y/m/d', strtotime($gregorian_date), '', '', 'fa');
                return $jalali_date;
        }

        // convert to shamsi
        function convertTimestampToDate($timestamp)
        {
                if (!is_numeric($timestamp) || $timestamp <= 0) {
                        return "تاریخ نامعتبر";
                }

                // تاریخ میلادی
                $gregorianDate = date("Y-m-d", $timestamp);

                // تاریخ شمسی (با استفاده از کتابخانه jdate)
                $jalaliDate = jdate("Y/m/d", $timestamp);

                return [
                        'miladi' => $gregorianDate,
                        'jalali' => $jalaliDate,
                ];
        }


        // save multi images
        protected function saveImage($image, $subfolder, $imageName = null)
        {
                $uploadDir = 'public/' . $subfolder . '/';
                if (!$imageName) {
                        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
                        $imageName = date("Y-m-d-H-i-s") . '_' . uniqid() . '.' . $extension;
                }
                $uploadPath = $uploadDir . $imageName;
                $fileSizeInBytes = filesize($image['tmp_name']);
                $fileSizeInKb = round($fileSizeInBytes / 1024, 2);
                if ($fileSizeInKb > 700) {
                        $this->send_json_response(false, 'حجم عکس نباید بیشتر از یک ام بی باشد!');
                        // flash('error', 'حجم تصویر بیشتر از حد مجاز می‌باشد.');
                        // $this->redirectBack();
                        // exit();
                }
                if (is_uploaded_file($image['tmp_name'])) {
                        if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                                return $imageName;
                        } else {
                                return false;
                        }
                } else {
                        return false;
                }
        }

        // remove img for update
        protected function removeImage($path)
        {
                $path = trim($this->basePath, '/ ') . '/' . trim($path, '/ ');
                if (file_exists($path) && !is_dir($path)) {
                        unlink($path);
                }
        }

        // unset empty values
        function unsetEmptyValues($request)
        {
                foreach ($request as $key => $value) {
                        if ($value === '') {
                                unset($request[$key]);
                        }
                }
                return $request;
        }

        public static function processCheckboxes($request)
        {
                $checkboxArray = array_keys($request); // دریافت نام چک باکس‌ها از داده‌های فرم
                $checked = [];

                foreach ($checkboxArray as $checkbox) {
                        $checked[$checkbox] = isset($request[$checkbox]) ? 1 : 0;
                }

                return $checked;
        }

        // generate Random Code 
        function generateRandomCode($length = 6)
        {
                $password = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomCode = '';
                for ($i = 0; $i < $length; $i++) {
                        $randomCode .= $password[rand(0, strlen($password) - 1)];
                }
                return $randomCode;
        }

        // send json response for clinet
        function send_json_response($error = false, $message = _success, $id = '')
        {
                $responseArray = array(
                        'success' => $error,
                        'message' => $message,
                        'id' => $id
                );
                header('Content-Type: application/json');
                echo json_encode($responseArray);
                exit();
        }

        // send json data for clinet
        function send_json_response_data($data = [], $error = false, $message = 'success')
        {
                $responseArray = [
                        'success' => !$error,
                        'message' => $message,
                ];
                // داده‌ها را با ساختار نهایی ترکیب می‌کنیم
                $responseArray = array_merge($responseArray, $data);
                header('Content-Type: application/json');
                echo json_encode($responseArray, JSON_UNESCAPED_UNICODE);
                exit();
        }


        public function validateRequiredFields($request, $requiredFields)
        {
                foreach ($requiredFields as $field) {
                        if (!isset($request[$field]) || $request[$field] === '') {
                                $this->flashMessage('error', 'لطفا مقادیر ضروری را وارد نمایید');
                                return false;
                        }
                }
                return true;
        }

        // validation questions type
        function validateQuestionType($value)
        {
                $valid_values = ['four_options', 'type2', 'type3', 'type4', 'type5', 'type6', 'type7', 'type8', 'type9', 'type10', 'type11', 'type12', 'type13'];
                return in_array($value, $valid_values);
        }

        // time stamp
        function calculateNewEndDate($start_date_timestamp, $days_off)
        {
                $seconds_per_day = 24 * 60 * 60;
                $days_off_seconds = $days_off * $seconds_per_day;
                $new_end_date_timestamp = $start_date_timestamp + $days_off_seconds;
                return $new_end_date_timestamp;
        }

        // remove Seconds 
        function removeSeconds($timeRange)
        {
                $timeParts = explode(' - ', $timeRange);
                $startTime = substr($timeParts[0], 0, -3);
                $endTime = substr($timeParts[1], 0, -3);
                return $startTime . ' - ' . $endTime;
        }

        // handle images upload
        public function handleImageUpload(&$file, $destinationPath, $maxFileSize = 1048576)
        {
                if (!is_uploaded_file($file['tmp_name'])) {
                        $file = null;
                        return null;
                }

                if ($file['size'] > $maxFileSize) {
                        $this->flashMessage('error', 'حجم فایل نباید بیشتر از ' . ($maxFileSize / 1024 / 1024) . ' MB باشد');
                        $file = null;
                        return null;
                }

                $file = $this->saveImage($file, $destinationPath);
                return $file;
        }

        // updata handle image upload
        public function handleImageUpdate(&$request, $table, $id, $imageField, $uploadPath, $file, $maxSize = 1048576)
        {
                if (isset($file['tmp_name']) && is_uploaded_file($file['tmp_name'])) {

                        if ($file['size'] > $maxSize) {
                                $this->flashMessage('error', 'حجم عکس نباید بیشتر از ' . ($maxSize / 1024 / 1024) . ' MB باشد');
                                return;
                        }

                        $record = $this->db->select("SELECT * FROM {$table} WHERE id = ?", [$id])->fetch();

                        if (!empty($record[$imageField])) {
                                $this->removeImage("public/{$uploadPath}/" . $record[$imageField]);
                        }

                        $newImageName = $this->saveImage($file, $uploadPath);

                        if ($newImageName) {
                                $request[$imageField] = $newImageName;
                        } else {
                                unset($request[$imageField]);
                        }
                } else {
                        unset($request[$imageField]);
                }
        }

        // return 404 page
        public function validateExistence(...$items)
        {
                foreach ($items as $item) {
                        if (!$item) {
                                require_once(BASE_PATH . '/404.php');
                                exit();
                        }
                }
        }

        // create reports
        function createReport($title, $reportId = null, $description = null)
        {
                if (!isset($_SESSION['er_em_name'])) {
                        $this->redirect('login');
                        exit();
                }
                $whoIt = $_SESSION['er_em_name'];

                $data = [
                        'report_title' => $title,
                        'who_it' => $whoIt,
                        'report_id' => $reportId,
                        'description' => $description,
                ];
                return $this->db->insert('reports', array_keys($data), $data);
        }

        // change persion number to english
        function convertPersionNumber($number)
        {
                $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                return str_replace($persianDigits, $englishDigits, $number);
        }

        // redirect to ...
        protected function redirect($url)
        {
                $currentDomain = $this->currentDomain ?? '';
                $url = $url ?? '';
                header('Location: ' . trim($currentDomain, '/ ') . '/' . trim($url, '/ '));
                exit;
        }

        // back link 
        function back_link($route)
        {
                return '
                <div class="fs14 text-underline center">
                <a href="' . url($route) . '" class="color">برگشت</a>
                </div>
                ';
        }

        // get shmasi year
        public function getValidYear($inputYear = null)
        {
                $calendarType = $this->db->select('SELECT calendar_type FROM calendar_settings LIMIT 1')->fetchColumn();

                if ($calendarType === 'jalali') {
                        $currentYear = jdate('Y');
                } else {
                        $currentYear = date('Y');
                }

                $currentYear = (int) str_replace(
                        ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'],
                        ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                        $currentYear
                );

                $years = $this->db->select('SELECT year FROM years WHERE calendar_type = ? AND `status` = ? ORDER BY year DESC', [$calendarType, 1])->fetchAll();

                $yearsList = array_column($years, 'year');

                if ($inputYear) {
                        $inputYear = (int) str_replace(
                                ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'],
                                ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                                $inputYear
                        );

                        if (!in_array($inputYear, $yearsList)) {
                                $this->flashMessage('error', "سال انتخاب‌شده معتبر نیست!");
                                exit();
                        }

                        return $inputYear;
                } else {
                        if (!in_array($currentYear, $yearsList)) {
                                require_once(BASE_PATH . '/year-error.php');
                                exit();
                        }
                        return $currentYear;
                }
        }

        // check branch count
        public function branchSelectField($selectedId = null): string
        {
                if (!isset($_SESSION['branch_id']) && !isset($_SESSION['admin'])) {
                        $this->redirect('logout');
                        exit;
                }

                if (isset($_SESSION['branch_id'])) {
                        $branchId = intval($_SESSION['branch_id']);
                        return "<input type=\"hidden\" name=\"branch_id\" value=\"$branchId\">";
                }

                if (isset($_SESSION['admin'])) {
                        $branches = $this->db->select('SELECT id, branch_name FROM branches')->fetchAll();

                        if (count($branches) === 1) {
                                $branchId = intval($branches[0]['id']);
                                return "<input type=\"hidden\" name=\"branch_id\" value=\"$branchId\">";
                        }

                        $html = '<div class="one">';
                        $html .= '<div class="label-form mb5 fs14">انتخاب شعبه <span class="color-red">*</span></div>';
                        $html .= '<select name="branch_id" id="mySelect" required>';
                        $html .= '<option selected disabled>انتخاب شعبه</option>';

                        foreach ($branches as $branch) {
                                $selected = ($branch['id'] == $selectedId) ? 'selected' : '';
                                $html .= "<option value=\"{$branch['id']}\" $selected>{$branch['branch_name']}</option>";
                        }

                        $html .= '</select>';
                        $html .= '</div>';

                        return $html;
                }

                return '';
        }

        // get sys infos
        function getSysh(): string
        {
                $cpu = @shell_exec('wmic cpu get ProcessorId 2>NUL');
                $hdd = @shell_exec('wmic diskdrive get SerialNumber 2>NUL');

                if (!$cpu || !$hdd) {
                        return '';
                }

                $cpuLines = explode("\n", trim($cpu));
                $cpuId = $cpuLines[1] ?? '';
                $hddLines = explode("\n", trim($hdd));
                $hddId = $hddLines[1] ?? '';

                $cpuId = preg_replace('/\s+/', '', $cpuId);
                $hddId = preg_replace('/\s+/', '', $hddId);

                $raw = $cpuId . '|' . $hddId;

                if (strlen($raw) < 10) {
                        return '';
                }

                return hash('sha256', $raw);
        }

        function getManualSysh(): string
        {
                if (empty(CPU) || empty(HDD)) {
                        require_once(BASE_PATH . '/resources/views/app/errors/hardware-error.php');
                        exit();
                }
                return hash('sha256', CPU . '|' . HDD);
        }

        function validateHardware(): void
        {
                $realHash = $this->getSysh();
                $manualHash = $this->getManualSysh();

                if ($realHash === '' || $manualHash === '' || !hash_equals($realHash, $manualHash)) {
                        require_once(BASE_PATH . '/resources/views/app/errors/hardware-error.php');
                        exit();
                }
        }

        // get and check date
        function validateLicenseDate(): void
        {
                $start = strtotime(start_date);
                $end = strtotime(end_date);
                $now = time();

                if ($now < $start) {
                        require_once(BASE_PATH . '/resources/views/app/errors/date-error.php');
                        exit();
                }

                if ($now > $end) {
                        require_once(BASE_PATH . '/resources/views/app/errors/date-expired.php');
                        exit();
                }
        }




        // get branch id
        public function getBranchId()
        {
                if (!isset($_SESSION['hms_employee']) && !isset($_SESSION['hms_admin']['admin'])) {
                        $this->redirect('logout');
                        exit;
                }

                $branches = $this->db->select('SELECT id FROM branches WHERE `is_active` = 1')->fetchAll();

                if (count($branches) === 1) {
                        return $branches[0]['id'];
                }

                if (!empty($_SESSION['hms_employee']['branch_id'])) {
                        return $_SESSION['hms_employee']['branch_id'];
                }

                if (!empty($_SESSION['hms_admin']['admin'])) {
                        return 'ALL';
                }

                return null;
        }

        // get branch count
        public function getBranchesCount()
        {
                $branches = $this->db->select('SELECT COUNT(*) as cnt FROM branches')->fetch();
                return $branches['cnt'] ?? 0;
        }

        // get month name
        function getMonthName($month)
        {
                return [
                        1 => 'حمل',
                        2 => 'ثور',
                        3 => 'جوزا',
                        4 => 'سرطان',
                        5 => 'اسد',
                        6 => 'سنبله',
                        7 => 'میزان',
                        8 => 'عقرب',
                        9 => 'قوس',
                        10 => 'جدی',
                        11 => 'دلو',
                        12 => 'حوت'
                ][$month] ?? 'نامشخص';
        }

        // get transaction type name for salay
        function getTransactionTypeName($type)
        {
                return [
                        1 => 'معاش',
                        2 => 'اضافه کاری',
                        3 => 'کسری معاش'
                ][$type] ?? 'نامشخص';
        }

        // go back page
        public function goBack($default = null)
        {
                if (!empty($_SERVER['HTTP_REFERER'])) {
                        return $_SERVER['HTTP_REFERER'];
                }

                return $default ?: url('home');
        }

        // user, branch exist?
        public function validateUserBranch()
        {
                if (isset($_SESSION['hms_employee']['branch_id'])) {
                        $branchId = $_SESSION['hms_employee']['branch_id'];

                        $branchExists = $this->db->select('SELECT id FROM branches WHERE id = ?', [$branchId])->fetch();

                        if (!$branchExists) {
                                $this->redirect('logout');
                                exit();
                        }
                }
        }

        // format gold
        function formatGold($amount)
        {
                $value = $amount / 1000;
                $formatted = number_format(abs($value), 3, '.', ',');

                if ($value < 0) {
                        return '<span class="color-red">- ' . $formatted . '</span>';
                } else {
                        return $formatted;
                }
        }

        // validate requests
        public function validateRequestt($request, $rules)
        {
                foreach ($rules as $field => $label) {
                        if (!isset($request[$field]) || trim($request[$field]) === '') {
                                $this->flashMessage('error', "{$label} نباید خالی باشد");
                                return false;
                        }

                        if (!is_numeric($request[$field])) {
                                $this->flashMessage('error', "ورودی {$label} باید عدد باشد");
                                return false;
                        }
                }
                return true;
        }

        // check time ago days
        function timeAgoInDays($datetime)
        {
                $now = new \DateTime();
                if (is_numeric($datetime)) {
                        $created = new \DateTime();
                        $created->setTimestamp($datetime);
                } else {
                        $created = new \DateTime($datetime);
                }

                $diff = $now->diff($created)->days;

                if ($diff == 0) {
                        return "امروز";
                } elseif ($diff == 1) {
                        return "دیروز";
                } else {
                        return $diff . " روز پیش";
                }
        }

        // format making sout
        function makingSut(int $sut): string
        {
                $value = $sut / 1000;
                return number_format($value, 3, '.', '');
        }

        function toMillisot($value)
        {
                $value = str_replace(',', '', $value);

                if (strpos($value, '.') === false) {
                        return (int)$value * 1000;
                }

                list($int, $dec) = explode('.', $value);

                $dec = str_pad($dec, 3, '0');

                return (int)($int . $dec);
        }

        function editToMillisot($value)
        {
                $clean = str_replace([",", " "], "", $value);
                if (strpos($value, ".") !== false) {
                        return (int)round(floatval($value) * 1000);
                }
                return (int)$clean;
        }

        // redirect to ...
        function flashMessageTo($type, $message, $redirectTo)
        {
                flash($type, $message);

                if ($type === 'success') {
                        unset($_SESSION['old']);
                        unset($_SESSION['temporary_old']);
                }

                header('Location: ' . $redirectTo);
                exit;
        }

        // format score
        public function formatNumber($score, $forInput = false)
        {
                if (!is_numeric($score)) return $score;
                if (is_array($score)) return array_map([$this, 'formatNumber'], $score);

                $rounded = round((float)$score, 2);
                $formatted = rtrim(rtrim(number_format(abs($rounded), 2, '.', ','), '0'), '.');

                $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                $formatted = str_replace($english, $persian, $formatted);

                if ($forInput) return $formatted;

                if ($rounded < 0)
                        return '<span style="color:red; direction:ltr; display:inline-block;">-&nbsp;' . $formatted . '</span>';
                else
                        return '<span style="direction:ltr; display:inline-block;">' . $formatted . '</span>';
        }

        // json return
        public function jsonResponse($status, $message = '', $data = [])
        {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode([
                        'status'  => $status, // success | error
                        'message' => $message,
                        'data'    => $data
                ]);
                exit;
        }
}
