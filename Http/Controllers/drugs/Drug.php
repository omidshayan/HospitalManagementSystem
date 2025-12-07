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
        $units = $this->db->select('SELECT * FROM units WHERE `status` WHERE `status` = ?', [1])->fetchAll();
        if ($drug != null) {
            require_once(BASE_PATH . '/resources/views/app/drugs/edit-drug.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }


    // edit employee store
    public function editEmployeeStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['employee_name'] == '' || $request['phone'] == '' || !isset($request['position'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $existEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();

        if ($existEmployee) {
            if ($existEmployee['id'] != $existEmployee['id']) {
                $this->flashMessage('error', 'شماره موبایل وارد شده قبلاً توسط کارمند دیگری ثبت شده است.');
                return;
            }
        }

        // check upload photo
        $max_file_size = 1048576;
        if (is_uploaded_file($request['image']['tmp_name'])) {
            if ($request['image']['size'] > $max_file_size) {
                $this->flashMessage('error', 'حجم عکس نباید بیشتر از 1 mb باشد');
            } else {
                $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$existEmployee['id']])->fetch();
                $this->removeImage('public/images/employees/' . $employee['image']);
                $request['image'] = $this->saveImage($request['image'], 'images/employees');
            }
        } else {
            unset($request['image']);
        }

        $this->db->update('employees', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('employees'));
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
