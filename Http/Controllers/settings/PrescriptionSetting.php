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
