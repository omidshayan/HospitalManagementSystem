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
        if ($request['employee_name'] == '' || $request['password'] == '' || $request['phone'] == '' || !isset($request['position'])) {
            $this->flashMessage('error', _emptyInputs);
        }

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

            // array for employee data
            $employeeData = [
                'employee_name' => $request['employee_name'],
                'phone' => $request['phone'],
                'password' => $request['password'],
                'email' => $request['email'],
                'address' => $request['address'],
                'position' => $request['position'],
                'expertise' => $request['expertise'],
                'image' => $request['image'],
                'description' => $request['description'],
                'who_it' => $request['who_it'],
            ];
            $this->db->insert('employees', array_keys($employeeData), $employeeData);

            // گرفتن آی‌دی کارمند جدید
            $employeeId = $this->db->lastInsertId();

            // تعریف والدها و زیرمجموعه‌ها (نام‌ها و والدها)
            $parentChildMap = [
                // والد => [زیرمجموعه‌ها]
                'parentPatients' => ['showPatients'],
                'parentPrescription' => ['addPrescription', 'showPrescription'],
                'parentEmployee' => ['addEmployee', 'showEmployees', 'positions'],
                'parentDrug' => ['addDrug', 'showDrugs', 'catDrug', 'unitDrug'],
                'parentSetting' => ['numberDrugs', 'intakeTime', 'dosage', 'intakeInstructions', 'settingPrescription'],
                // تکی‌ها که والد ندارند
                'prescriptionPrint' => null,
            ];

            // ابتدا همه دسترسی‌های تکی که والد ندارند و چک شده‌اند را بررسی کنیم
            $permissionsToInsert = [];

            // اول چک باکس تکی بدون والد
            if (!empty($request['prescriptionPrint'])) {
                $permissionsToInsert[] = 'prescriptionPrint';
            }

            // تابعی برای اضافه کردن دسترسی‌ها با والدش
            $addPermissionWithParent = function ($parent, $children) use ($request, &$permissionsToInsert) {
                $parentAdded = false;
                foreach ($children as $child) {
                    if (!empty($request[$child])) {
                        if (!$parentAdded) {
                            $permissionsToInsert[] = $parent;
                            $parentAdded = true;
                        }
                        $permissionsToInsert[] = $child;
                    }
                }
            };

            // پردازش والد-زیرمجموعه ها
            foreach ($parentChildMap as $parent => $children) {
                if ($children === null) {
                    // یعنی تکی بدون زیرمجموعه (مثلا prescriptionPrint)
                    continue; // همین الان بالا چک کردیم
                }
                $addPermissionWithParent($parent, $children);
            }

            // ذخیره همه دسترسی‌ها در جدول permissions
            foreach ($permissionsToInsert as $sectionName) {
                $this->db->insert('permissions', ['employee_id', 'section_name'], [$employeeId, $sectionName]);
            }

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
