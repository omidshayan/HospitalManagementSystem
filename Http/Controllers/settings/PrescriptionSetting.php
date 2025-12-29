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
