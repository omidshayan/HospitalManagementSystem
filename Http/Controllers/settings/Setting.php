<?php

namespace App;

require_once 'Http/Controllers/App.php';

use database\DataBase;

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
}
