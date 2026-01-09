<?php

namespace App;

class DrugType extends App
{
    //  Dosage page
    public function drugTypes()
    {
        $this->middleware(true, true, 'dosage', true);
        $drug_types = $this->db->select('SELECT * FROM drug_types')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/drug-types/drug-types.php');
    }

    // store drug_type
    public function drugTypeStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['drug_type'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }
        $drug_type = $this->db->select('SELECT drug_type FROM drug_types WHERE `drug_type` = ?', [$request['drug_type']])->fetch();

        if (!empty($drug_type['drug_type'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('drug_types', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // dosage page
    public function editDosage($id)
    {
        $this->middleware(true, true, 'general');

        $dosage = $this->db->select('SELECT * FROM dosage WHERE `id` = ?', [$id])->fetch();
        if ($dosage != null) {
            require_once(BASE_PATH . '/resources/views/app/dosage/edit-dosage.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit dosage store
    public function editDosageStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['dosage'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $dosage = $this->db->select('SELECT * FROM dosage WHERE `dosage` = ?', [$request['dosage']])->fetch();

        if ($dosage) {
            if ($dosage['id'] != $id) {
                $this->flashMessage('error', 'این مقدار مصرف ثبت شده است.');
                return;
            }
        }

        $this->db->update('dosage', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('dosage'));
    }

    // dosage Details detiles page
    public function dosageDetails($id)
    {
        $this->middleware(true, true, 'general');
        $dosage = $this->db->select('SELECT * FROM dosage WHERE `id` = ?', [$id])->fetch();
        if ($dosage != null) {
            require_once(BASE_PATH . '/resources/views/app/dosage/dosage-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status dosage
    public function changeStatusDosage($id)
    {
        $this->middleware(true, true, 'general');

        $dosage = $this->db->select('SELECT id, `status` FROM dosage WHERE id = ?', [$id])->fetch();
        if (!$dosage) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($dosage['status'] == 1) ? 2 : 1;

        $this->db->update('dosage', $id, ['status'], [$newStatus]);
        $this->send_json_response(true, _success, $newStatus);
    }
}
