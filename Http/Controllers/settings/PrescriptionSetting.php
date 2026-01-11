<?php

namespace App;

class PrescriptionSetting extends App
{
    // management of years page
    public function prescriptionSettings()
    {
        $this->middleware(true, true, 'general', true);
        $prescrption_change = $this->db->select('SELECT * FROM settings')->fetch();
        require_once(BASE_PATH . '/resources/views/app/settings/prescription-change.php');
    }

    // change status tests
    public function changeStatusActiveInfosPre()
    {
        $this->middleware(true, true, 'general');

        $row = $this->db->select(
            'SELECT id, active_infos_pre FROM settings LIMIT 1'
        )->fetch();

        if (!$row) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($row['active_infos_pre'] == 1) ? 2 : 1;

        $this->db->update(
            'settings',
            $row['id'],
            ['active_infos_pre'],
            [$newStatus]
        );

        if (!isset($_SESSION['settings']) || !is_array($_SESSION['settings'])) {
            $_SESSION['settings'] = [];
        }

        $_SESSION['settings']['active_infos_pre'] = $newStatus;

        $this->send_json_response(true, _success, $newStatus);
    }

    // show doctor infos
    public function changeStatusActiveDoctorInfos()
    {
        $this->middleware(true, true, 'general');

        $row = $this->db->select(
            'SELECT id, active_doctor_infos FROM settings LIMIT 1'
        )->fetch();

        if (!$row) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($row['active_doctor_infos'] == 1) ? 2 : 1;

        $this->db->update(
            'settings',
            $row['id'],
            ['active_doctor_infos'],
            [$newStatus]
        );

        if (!isset($_SESSION['settings']) || !is_array($_SESSION['settings'])) {
            $_SESSION['settings'] = [];
        }

        $_SESSION['settings']['active_doctor_infos'] = $newStatus;

        $this->send_json_response(true, _success, $newStatus);
    }

    // prescription settings store
    public function prescriptionChangeStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if (!isset($request['image']) || !is_uploaded_file($request['image']['tmp_name'])) {
            $this->flashMessage('error', 'لطفا یک عکس انتخاب نمایید');
        }

        $infos = $this->db->select('SELECT * FROM settings')->fetch();

        if (!$infos) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $this->updateImageUpload($request, 'image', 'public', 'settings', $infos['id']);
        // $this->updateImageUpload($request, 'image', 'employees', 'employees', $id);
        $data = [
            'image' => $request['image'],
        ];

        if (isset($_SESSION['settings']) || is_array($_SESSION['settings'])) {
            unset($_SESSION['settings']);
        }

        $this->db->update('settings', $infos['id'], array_keys($data), $data);

        $this->flashMessage('success', 'اطلاعات با موفقیت ویرایش شد.');
    }

    // backup
    // public function backup()
    // {
    //     $this->middleware(true, true, 'general', true);

    //     // مسیر ذخیره بکاپ
    //     $backupDir = BASE_PATH . '/storage/backups/';
    //     if (!is_dir($backupDir)) {
    //         mkdir($backupDir, 0755, true);
    //     }

    //     // نام فایل
    //     $fileName = 'db_backup_' . date('Y_m_d_H_i_s') . '.sql';
    //     $filePath = $backupDir . $fileName;

    //     // مسیر mysqldump (حتماً چک کن)
    //     $mysqldump = 'C:\wamp64\bin\mysql\mysql9.1.0\bin\mysqldump.exe';

    //     // اطلاعات دیتابیس
    //     $host = DB_HOST;
    //     $user = DB_USERNAME;
    //     $pass = DB_PASSWORD;
    //     $db   = DB_NAME; // hms_sis

    //     // دستور بکاپ
    //     $command = "\"$mysqldump\" --host=$host --user=$user --password=\"$pass\" $db > \"$filePath\"";

    //     exec($command, $output, $result);

    //     if ($result !== 0 || !file_exists($filePath)) {
    //         $this->flashMessage('error', 'خطا در گرفتن بکاپ دیتابیس');
    //         return false;
    //     }

    //     $this->flashMessage('success', 'بکاپ دیتابیس با موفقیت ایجاد شد');
    //     return true;
    // }

    public function backupEncrypted($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // بررسی سخت‌افزار و لایسنس
        $this->db->validateHardware();
        $this->db->validateLicenseDate();

        $backupDir = BASE_PATH . '/storage/backups/';
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $timestamp = date('Y_m_d_H_i_s');
        $sqlFile = $backupDir . "backup_$timestamp.sql";
        $zipFile = $backupDir . "backup_$timestamp.zip";

        // مسیر mysqldump (WAMP)
        $mysqldump = 'C:\wamp64\bin\mysql\mysql9.1.0\bin\mysqldump.exe';

        $command = "\"$mysqldump\" --user=" . DB_USERNAME .
            " --password=\"" . DB_PASSWORD . "\"" .
            " " . DB_NAME . " > \"$sqlFile\"";

        exec($command, $out, $result);

        if ($result !== 0 || !file_exists($sqlFile)) {
            $this->flashMessage('error', 'خطا در ایجاد فایل بکاپ');
            return false;
        }

        // 🔐 پسورد وابسته به سخت‌افزار
        $password = substr($this->db->getSysh(), 0, 16);

        $zip = new \ZipArchive();
        if ($zip->open($zipFile, \ZipArchive::CREATE) !== true) {
            unlink($sqlFile);
            $this->flashMessage('error', 'خطا در ساخت فایل ZIP');
            return false;
        }

        $zip->setPassword($password);
        $zip->addFile($sqlFile, basename($sqlFile));
        $zip->setEncryptionName(basename($sqlFile), \ZipArchive::EM_AES_256);
        $zip->close();

        unlink($sqlFile); // حذف فایل خام

        $this->rotateBackups($backupDir, 5); // نگه داشتن 5 بکاپ آخر

        $this->flashMessage('success', 'بکاپ رمزگذاری‌شده با موفقیت ایجاد شد');
        return true;
    }

    public function restoreEncrypted($request, $fileName)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // بررسی سخت‌افزار
        $this->db->validateHardware();
        $this->db->validateLicenseDate();

        $backupDir = realpath(BASE_PATH . '/storage/backups/');
        $zipPath = realpath($backupDir . '/' . $fileName);

        if (!$zipPath || strpos($zipPath, $backupDir) !== 0) {
            $this->flashMessage('error', 'فایل نامعتبر است');
            return false;
        }

        if (!file_exists($zipPath)) {
            $this->flashMessage('error', 'فایل بکاپ یافت نشد');
            return false;
        }

        $password = substr($this->db->getSysh(), 0, 16);

        $zip = new \ZipArchive();
        if ($zip->open($zipPath) !== true) {
            $this->flashMessage('error', 'خطا در باز کردن فایل ZIP');
            return false;
        }

        if (!$zip->setPassword($password)) {
            $this->flashMessage('error', 'پسورد فایل بکاپ اشتباه است');
            return false;
        }

        $extractPath = $backupDir . '/tmp_restore/';
        if (!is_dir($extractPath)) {
            mkdir($extractPath, 0755, true);
        }

        if (!$zip->extractTo($extractPath)) {
            $zip->close();
            $this->flashMessage('error', 'عدم تطابق سخت‌افزار با بکاپ');
            return false;
        }
        $zip->close();

        $sqlFiles = glob($extractPath . '*.sql');
        if (empty($sqlFiles)) {
            $this->flashMessage('error', 'فایل SQL یافت نشد');
            return false;
        }

        $sqlFile = $sqlFiles[0];

        $mysql = 'C:\wamp64\bin\mysql\mysql8.0.36\bin\mysql.exe';

        $command = "\"$mysql\" --user=" . DB_USERNAME .
            " --password=\"" . DB_PASSWORD . "\"" .
            " " . DB_NAME . " < \"$sqlFile\"";

        exec($command, $out, $result);

        unlink($sqlFile);
        rmdir($extractPath);

        if ($result !== 0) {
            $this->flashMessage('error', 'خطا در بازگردانی دیتابیس');
            return false;
        }

        $this->flashMessage('success', 'دیتابیس با موفقیت بازگردانی شد');
        return true;
    }

    private function rotateBackups($dir, $keep = 5)
    {
        $files = glob($dir . '/*.zip');
        usort($files, fn($a, $b) => filemtime($b) - filemtime($a));

        foreach (array_slice($files, $keep) as $file) {
            unlink($file);
        }
    }
}
