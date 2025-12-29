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
    public function prescriptionChangeStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

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

        $this->db->update('settings', $infos['id'], array_keys($data), $data);

        $this->flashMessage('success', 'اطلاعات با موفقیت ویرایش شد.');
    }
}
