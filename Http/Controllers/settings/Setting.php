<?php

namespace App;

class Setting extends App
{

    // management of years page
    public function manageYears()
    {
        $this->middleware(true, true, 'students', true);
        $years = $this->db->select('SELECT * FROM years ORDER BY id DESC')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/settings/manage-years.php');
    }

    // change status years
    public function changeStatusYears($request, $id)
    {
        $this->middleware(true, true, 'students', true, $request);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            $this->flashMessage('error', 'درخواست نامعتبر است!');
            exit();
        }

        $year = $this->db->select('SELECT * FROM years WHERE id = ?', [$id])->fetch();
        if (!$year) {
            http_response_code(404);
            $this->flashMessage('error', 'سال موردنظر یافت نشد!');
            exit();
        }

        $currentYear = $this->convertPersionNumber(jdate('Y'));
        $yearFromDB = is_numeric($year['year']) ? $year['year'] : jdate('Y', strtotime($year['year']));
        if ($currentYear == $yearFromDB) {
            http_response_code(403);
            $this->flashMessage('error', 'سال جاری را نمی‌توان بست!');
            exit();
        }

        $newStatus = ($year['status'] == 1) ? 2 : 1;
        $this->db->update('years', $year['id'], ['status'], [$newStatus]);
        $this->flashMessage('success', 'عملیات موفقانه انجام شد.');
    }

    // prescription page
    public function prescriptionSettings()
    {
        $this->middleware(true, true, 'general', true);
        $prescription_infos = $this->db->select('SELECT * FROM prescription_settings')->fetch();
        require_once(BASE_PATH . '/resources/views/app/settings/prescription-settings.php');
    }

    // prescription settings store
    public function prescriptionSettingsStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if (empty($request['center_name'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $branch = $this->db->select('SELECT * FROM prescription_settings')->fetch();

        if (!$branch) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $this->updateImageUpload($request, 'image', 'public', 'prescription_settings', $branch['id']);

        $this->db->update('prescription_settings', $branch['id'], array_keys($request), $request);

        $this->flashMessage('success', 'اطلاعات با موفقیت ویرایش شد.');
    }

    ////////////////////////////////////
    public function prePrintSettings()
    {
        $this->middleware(true, true, 'general', true);
        $settings = $this->db->select('SELECT * FROM settings')->fetch();
        require_once(BASE_PATH . '/resources/views/app/settings/settings.php');
    }

    public function changeStatusPrePrint()
    {
        $this->middleware(true, true, 'general');
        $row = $this->db->select('SELECT id, single_print FROM settings')->fetch();

        if (!$row) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($row['single_print'] == 1) ? 2 : 1;
        $this->db->update('settings', $row['id'], ['single_print'], [$newStatus]);
        $this->send_json_response(true, _success, $newStatus);
    }

    // change status admission
    public function changeStatusAdmission()
    {
        $this->middleware(true, true, 'general');

        $row = $this->db->select(
            'SELECT id, admission FROM settings LIMIT 1'
        )->fetch();

        if (!$row) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($row['admission'] == 1) ? 2 : 1;

        $this->db->update(
            'settings',
            $row['id'],
            ['admission'],
            [$newStatus]
        );

        if (!isset($_SESSION['settings']) || !is_array($_SESSION['settings'])) {
            $_SESSION['settings'] = [];
        }

        $_SESSION['settings']['admission'] = $newStatus;

        $this->send_json_response(true, _success, $newStatus);
    }

    // change status count drug
    public function changeStatusCountDrugShow()
    {
        $this->middleware(true, true, 'general');

        $row = $this->db->select(
            'SELECT id, count_drug FROM settings LIMIT 1'
        )->fetch();

        if (!$row) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($row['count_drug'] == 1) ? 2 : 1;

        $this->db->update(
            'settings',
            $row['id'],
            ['count_drug'],
            [$newStatus]
        );

        if (!isset($_SESSION['settings']) || !is_array($_SESSION['settings'])) {
            $_SESSION['settings'] = [];
        }

        $_SESSION['settings']['count_drug'] = $newStatus;

        $this->send_json_response(true, _success, $newStatus);
    }

    // change status intake-time
    public function changeStatusIntakeTimeShow()
    {
        $this->middleware(true, true, 'general');

        $row = $this->db->select(
            'SELECT id, intake_time FROM settings LIMIT 1'
        )->fetch();

        if (!$row) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($row['intake_time'] == 1) ? 2 : 1;

        $this->db->update(
            'settings',
            $row['id'],
            ['intake_time'],
            [$newStatus]
        );

        if (!isset($_SESSION['settings']) || !is_array($_SESSION['settings'])) {
            $_SESSION['settings'] = [];
        }

        $_SESSION['settings']['intake_time'] = $newStatus;

        $this->send_json_response(true, _success, $newStatus);
    }
    
    // change status dosage
    public function changeStatusDosageShow()
    {
        $this->middleware(true, true, 'general');

        $row = $this->db->select(
            'SELECT id, dosage FROM settings LIMIT 1'
        )->fetch();

        if (!$row) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($row['dosage'] == 1) ? 2 : 1;

        $this->db->update(
            'settings',
            $row['id'],
            ['dosage'],
            [$newStatus]
        );

        if (!isset($_SESSION['settings']) || !is_array($_SESSION['settings'])) {
            $_SESSION['settings'] = [];
        }

        $_SESSION['settings']['dosage'] = $newStatus;

        $this->send_json_response(true, _success, $newStatus);
    }    

    // change status Intake Instructions
    public function changeStatusIntakeInstructionsShow()
    {
        $this->middleware(true, true, 'general');

        $row = $this->db->select(
            'SELECT id, intake_instructions FROM settings LIMIT 1'
        )->fetch();

        if (!$row) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($row['intake_instructions'] == 1) ? 2 : 1;

        $this->db->update(
            'settings',
            $row['id'],
            ['intake_instructions'],
            [$newStatus]
        );

        if (!isset($_SESSION['settings']) || !is_array($_SESSION['settings'])) {
            $_SESSION['settings'] = [];
        }

        $_SESSION['settings']['intake_instructions'] = $newStatus;

        $this->send_json_response(true, _success, $newStatus);
    }
}
