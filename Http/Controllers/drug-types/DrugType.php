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
    public function editDrugType($id)
    {
        $this->middleware(true, true, 'general');

        $drug_type = $this->db->select('SELECT * FROM drug_types WHERE `id` = ?', [$id])->fetch();
        if ($drug_type != null) {
            require_once(BASE_PATH . '/resources/views/app/drug-types/edit-drug-type.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit dosage store
    public function editDrugTypeStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['drug_type'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $drug_type = $this->db->select('SELECT * FROM drug_types WHERE `drug_type` = ?', [$request['drug_type']])->fetch();

        if ($drug_type) {
            if ($drug_type['id'] != $id) {
                $this->flashMessage('error', 'این مقدار مصرف ثبت شده است.');
                return;
            }
        }

        $this->db->update('drug_types', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('drug-types'));
    }

    // dosage Details detiles page
    public function drugTypeDetails($id)
    {
        $this->middleware(true, true, 'general');
        $drug_type = $this->db->select('SELECT * FROM drug_types WHERE `id` = ?', [$id])->fetch();
        if ($drug_type != null) {
            require_once(BASE_PATH . '/resources/views/app/drug-types/drug-type-details.php');
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
