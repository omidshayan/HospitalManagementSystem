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

    // backup page
    public function backup()
    {
        $this->middleware(true, true, 'general');

        $backups = $this->db->select('SELECT * FROM backups ORDER BY id DESC')->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/backups/backups.php');
    }

    // backup download
    public function backupDownload()
    {
        $this->middleware(true, true, 'general');

        $backups = $this->db->select('SELECT * FROM backups ORDER BY id DESC')->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/backups/backups.php');
    }

    // backup
    public function backupCreate()
    {
        $this->middleware(true, true, 'general', true);

        $backupDir = BASE_PATH . '/storage/backups/';
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $baseName = 'backup_' . date('Y_m_d_H_i_s');
        $sqlFile  = $backupDir . $baseName . '.sql';
        $zipFile  = $backupDir . $baseName . '.zip';

        $mysqldump = 'C:\wamp64\bin\mysql\mysql9.1.0\bin\mysqldump.exe';

        $host = DB_HOST;
        $user = DB_USERNAME;
        $pass = DB_PASSWORD;
        $db   = DB_NAME;

        $command = "\"$mysqldump\" --host=$host --user=$user --password=\"$pass\" $db > \"$sqlFile\"";
        exec($command, $output, $result);

        if ($result !== 0 || !file_exists($sqlFile)) {
            $this->flashMessage('error', 'خطا در گرفتن بکاپ دیتابیس');
            return false;
        }

        $zip = new \ZipArchive();
        if ($zip->open($zipFile, \ZipArchive::CREATE) !== true) {
            unlink($sqlFile);
            $this->flashMessage('error', 'خطا در ساخت فایل ZIP');
            return false;
        }

        $password = $db . APP_NAME;

        $zip->setPassword($password);
        $zip->addFile($sqlFile, basename($sqlFile));
        $zip->setEncryptionName(basename($sqlFile), \ZipArchive::EM_AES_256);

        $zip->close();

        unlink($sqlFile);

        $userInfo = $this->currentUser();
        $backupInfo = [
            'backup' => $baseName,
            'who_it' => $userInfo['name'],
        ];

        $inserted = $this->db->insert('backups', array_keys($backupInfo), $backupInfo);

        if (!$inserted) {
            $this->flashMessage('error', 'خطا در ثبت اطلاعات بکاپ در دیتابیس');
            return false;
        }

        $this->flashMessage('success', 'بکاپ دیتابیس با موفقیت رمزگذاری و ذخیره شد');
        return true;
    }
}
