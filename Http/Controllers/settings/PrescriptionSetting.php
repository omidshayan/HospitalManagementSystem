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

        if (!isset($_SESSION['settings']) || !is_array($_SESSION['settings'])) {
            $_SESSION['settings'] = [];
        }

        $this->db->update('settings', $infos['id'], array_keys($data), $data);

        $this->flashMessage('success', 'اطلاعات با موفقیت ویرایش شد.');
    }
}
