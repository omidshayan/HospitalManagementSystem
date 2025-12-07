<?php

namespace App;

class Drug extends App
{
    // drugs
    public function addDrug()
    {
        $this->middleware(true, true, 'general', true);
        $drugCategories = $this->db->select('SELECT * FROM drug_categories WHERE `status` = ?', [1])->fetchAll();
        $units = $this->db->select('SELECT * FROM units WHERE `status` = ?', [1])->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/drugs/add-drug.php');
    }

    // store employee
    public function drugStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['name'] == '' || $request['category_id'] == '' || $request['unit'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $existingDrug = $this->db->select('SELECT * FROM drugs WHERE `name` = ?', [$request['name']])->fetch();
        if ($existingDrug) {
            $this->flashMessage('error', _repeat);
        } else {

            $request = $this->validateInputs($request, ['image' => false]);

            // check image
            $this->handleImageUpload($request['image'], 'images/drugs');

            $this->db->insert('drugs', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // show drugs
    public function showDrugs()
    {
        $this->middleware(true, true, 'general');
        $drugs = $this->db->select('SELECT * FROM drugs ORDER BY id DESC')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/drugs/show-drugs.php');
        exit();
    }

    // edit drug page
    public function editDrug($id)
    {
        $this->middleware(true, true, 'general', true);

        $drug = $this->db->select('SELECT * FROM drugs WHERE id = ?', [$id])->fetch();
        $drugCategories = $this->db->select('SELECT * FROM drug_categories WHERE `status` = ?', [1])->fetchAll();
        $units = $this->db->select('SELECT * FROM units WHERE `status` = ?', [1])->fetchAll();
        if ($drug != null) {
            require_once(BASE_PATH . '/resources/views/app/drugs/edit-drug.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }


    // edit employee store
    public function editDrugStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['name'] == '' || $request['category_id'] == '' || $request['unit'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $existDrug = $this->db->select(
            'SELECT id FROM drugs WHERE name = ? AND id != ? LIMIT 1',
            [$request['name'], $id]
        )->fetch();

        if ($existDrug) {
            $this->flashMessage('error', 'نام وارد شده قبلاً ثبت شده است.');
            return;
        }

        // check upload photo
        $this->updateImageUpload($request, 'image', 'drugs', 'drugs', $id);

        $this->db->update('drugs', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('drugs'));
    }


    // change status employee
    public function changeStatus($id)
    {
        $this->middleware(true, true, 'general');

        $employee = $this->db
            ->select('SELECT * FROM employees WHERE id = ?', [$id])
            ->fetch();

        if (!$employee) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newState = ($employee['state'] == 1) ? 2 : 1;

        $this->db->update('employees', $employee['id'], ['state'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }


    // employee detiles page
    public function employeeDetails($id)
    {
        $this->middleware(true, true, 'general');
        $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$id])->fetch();
        if ($employee) {
            require_once(BASE_PATH . '/resources/views/app/employees/employee-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }
}
