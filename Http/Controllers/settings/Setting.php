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
}
