<?php

namespace App;

require_once 'Http/Controllers/App.php';

use database\DataBase;

class Employee extends App
{

    // add employee page
    public function addEmployee()
    {
        $this->middleware(true, true, 'general', true);
        $positions = $this->db->select('SELECT * FROM positions')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/employees/add-employee.php');
    }

    // store employee
    public function employeeStore($request)
    {



        $this->middleware(true, true, 'general', true, $request, true);
        // check empty form
        // if ($request['employee_name'] == '' || $request['password'] == '' || $request['phone'] == '' || !isset($request['position'])) {
        //     $this->flashMessage('error', _emptyInputs);
        // }

        $existingEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();
        if ($existingEmployee) {
            $this->flashMessage('error', _phone_repeat);
        } else {
            if (!isset($request['password']) || strlen(trim($request['password'])) < 6) {
                $this->flashMessage('error', 'رمز عبور باید حداقل 6 کاراکتر داشته باشد.');
            }

            $request = $this->validateInputs($request, ['image' => false]);
            $request['password'] = $this->hash($request['password']);

            // check image
            $this->handleImageUpload($request['image'], 'images/employees');

            $this->db->insert('employees', array_keys($request), $request);
            $lastId = $this->db->lastInsertId();

            $permissions = [];

            if (isset($request['prescriptionPrint']) && $request['prescriptionPrint'] == 'on') {
                $permissions['prescriptionPrint'] = 'prescriptionPrint';
            }

            if (isset($request['paitents']) && $request['paitents'] == 'on') {
                $permissions['paitents'] = 'paitents';
            }
            if (isset($request['paitents']) && $request['paitents'] == 'on') {
                $permissions['parentPaitents'] = 'parentPaitents';
                $permissions['paitents'] = 'paitents';
            }
            if (isset($request['addPrescription']) && $request['addPrescription'] == 'on') {
                $permissions['parentPrescription'] = 'parentPrescription';
                $permissions['addPrescription'] = 'addPrescription';
            }
            if (isset($request['showPrescription']) && $request['showPrescription'] == 'on') {
                $permissions['parentPrescription'] = 'parentPrescription';
                $permissions['showPrescription'] = 'showPrescription';
            }


            if (isset($request['addEmployee']) && $request['addEmployee'] == 'on') {
                $permissions['parentEmployee'] = 'parentEmployee';
                $permissions['addEmployee'] = 'addEmployee';
            }
            if (isset($request['showEmployees']) && $request['showEmployees'] == 'on') {
                $permissions['parentEmployee'] = 'parentEmployee';
                $permissions['showEmployees'] = 'showEmployees';
            }
            if (isset($request['positions']) && $request['positions'] == 'on') {
                $permissions['parentEmployee'] = 'parentEmployee';
                $permissions['positions'] = 'positions';
            }

            if (isset($request['addDrug']) && $request['addDrug'] == 'on') {
                $permissions['parentDrug'] = 'parentDrug';
                $permissions['addDrug'] = 'addDrug';
            }
            if (isset($request['showDrugs']) && $request['showDrugs'] == 'on') {
                $permissions['parentDrug'] = 'parentDrug';
                $permissions['showDrugs'] = 'showDrugs';
            }
            if (isset($request['catDrug']) && $request['catDrug'] == 'on') {
                $permissions['parentDrug'] = 'parentDrug';
                $permissions['catDrug'] = 'catDrug';
            }
            if (isset($request['unitDrug']) && $request['unitDrug'] == 'on') {
                $permissions['parentDrug'] = 'parentDrug';
                $permissions['unitDrug'] = 'unitDrug';
            }

            if (isset($request['numberDrugs']) && $request['numberDrugs'] == 'on') {
                $permissions['parentNumberDrugs'] = 'parentNumberDrugs';
                $permissions['numberDrugs'] = 'numberDrugs';
            }
            if (isset($request['intakeTime']) && $request['intakeTime'] == 'on') {
                $permissions['parentNumberDrugs'] = 'parentNumberDrugs';
                $permissions['intakeTime'] = 'intakeTime';
            }
            if (isset($request['dosage']) && $request['dosage'] == 'on') {
                $permissions['parentNumberDrugs'] = 'parentNumberDrugs';
                $permissions['dosage'] = 'dosage';
            }
            if (isset($request['intakeInstructions']) && $request['intakeInstructions'] == 'on') {
                $permissions['parentNumberDrugs'] = 'parentNumberDrugs';
                $permissions['intakeInstructions'] = 'intakeInstructions';
            }
            dd($permissions);
            // $permissions['employee_id'] == $lastId;
            $this->db->insert('employees', array_keys($permissions), $permissions);

            $this->flashMessage('success', _success);
        }
    }

    // edit employee page
    public function editEmployee($id)
    {
        $this->middleware(true, true, 'general', true);

        $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$id])->fetch();
        $positions = $this->db->select('SELECT * FROM positions')->fetchAll();
        $sections = $this->db->select('SELECT * FROM sections WHERE `section_id` IS NULL ORDER BY id ASC')->fetchAll();
        $permissions = $this->db->select('SELECT * FROM permissions WHERE employee_id = ?', [$id])->fetchAll();
        if ($employee != null) {
            require_once(BASE_PATH . '/resources/views/app/employees/edit-employee.php');
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

    // show employees
    public function showEmployees()
    {
        $this->middleware(true, true, 'general');

        $id = $this->currentUser();

        $employees = $this->db->select(
            'SELECT * FROM employees WHERE id != ? ORDER BY id DESC',
            [$id['id']]
        )->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/employees/show-employees.php');
        exit();
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
