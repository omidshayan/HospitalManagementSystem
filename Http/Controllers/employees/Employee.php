<?php

namespace App;

require_once 'Http/Controllers/App.php';

use database\DataBase;

class Employee extends App
{

    // add employee page
    public function addEmployee()
    {
        $this->middleware(true, true, 'addEmployee', true);
        $positions = $this->db->select('SELECT * FROM positions')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/employees/add-employee.php');
    }

    // store employee
    public function employeeStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // بررسی خالی بودن فیلدهای ضروری
        if ($request['employee_name'] == '' || $request['password'] == '' || $request['phone'] == '' || !isset($request['position'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        // چک تکراری بودن شماره تماس
        $existingEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();
        if ($existingEmployee) {
            $this->flashMessage('error', _phone_repeat);
        } else {
            // بررسی حداقل طول رمز عبور
            if (!isset($request['password']) || strlen(trim($request['password'])) < 6) {
                $this->flashMessage('error', 'رمز عبور باید حداقل 6 کاراکتر داشته باشد.');
            }

            // اعتبارسنجی ورودی‌ها
            $request = $this->validateInputs($request, ['image' => false]);
            $request['password'] = $this->hash($request['password']);

            // آپلود تصویر کارمند
            $this->handleImageUpload($request['image'], 'images/employees');

            // داده‌های کارمند
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

            // درج کارمند جدید
            $this->db->insert('employees', array_keys($employeeData), $employeeData);

            // گرفتن آی‌دی کارمند جدید
            $employeeId = $this->db->lastInsertId();

            // تعریف والد‌ها و زیرمجموعه‌ها
            $parentChildMap = [
                'parentPatients' => ['showPatients'],
                'parentPrescription' => ['addPrescription', 'showPrescription'],
                'parentEmployee' => ['addEmployee', 'showEmployees', 'positions'],
                'parentDrug' => ['addDrug', 'showDrugs', 'catDrug', 'unitDrug'],
                'parentSetting' => ['numberDrugs', 'intakeTime', 'dosage', 'intakeInstructions', 'settingPrescription'],
                'prescriptionPrint' => null, // مورد تکی بدون زیرمجموعه
            ];

            $permissionsToInsert = [];

            // بررسی دسترسی تکی بدون والد
            if (!empty($request['prescriptionPrint'])) {
                $permissionsToInsert[] = 'prescriptionPrint';
            }

            // تابع کمکی برای افزودن والد و زیرمجموعه‌ها
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

            // بررسی همه والد-زیرمجموعه‌ها
            foreach ($parentChildMap as $parent => $children) {
                if ($children === null) {
                    continue; // تکی بدون زیرمجموعه قبلا چک شده
                }
                $addPermissionWithParent($parent, $children);
            }

            // ثبت دسترسی‌ها در جدول permissions
            foreach ($permissionsToInsert as $sectionName) {
                $this->db->insert('permissions', ['employee_id', 'section_name'], [$employeeId, $sectionName]);
            }

            // ثبت دسترسی‌های پیش‌فرض برای همه کارمندان (مثل dashboard و profile)
            $defaultPermissions = ['dashboard', 'profile', 'general'];
            foreach ($defaultPermissions as $defaultPermission) {
                $this->db->insert('permissions', ['employee_id', 'section_name'], [$employeeId, $defaultPermission]);
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
            $employeePermissions = array_column($permissions, 'section_name');

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

        if ($request['employee_name'] == '' || $request['phone'] == '' || !isset($request['position'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $existEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();
        if ($existEmployee && $existEmployee['id'] != $id) {
            $this->flashMessage('error', 'شماره موبایل وارد شده قبلاً توسط کارمند دیگری ثبت شده است.');
            return;
        }

        $this->updateImageUpload($request, 'image', 'employees', 'employees', $id);

        $this->db->update('employees', $id, array_keys($request), $request);

        // حذف دسترسی‌های قبلی کارمند
        $this->db->deleteWhere('permissions', 'employee_id', $id);

        $menuStructure = [
            'parentPrescription' => ['addPrescription', 'showPrescription'],
            'parentEmployee' => ['addEmployee', 'showEmployees', 'positions'],
            'parentDrug' => ['addDrug', 'showDrugs', 'catDrug', 'unitDrug'],
            'parentSetting' => ['numberDrugs', 'intakeTime', 'dosage', 'intakeInstructions', 'settingPrescription'],
            'parentPatients' => ['showPatients'],
        ];

        $independentSections = ['prescriptionPrint', 'dashboard', 'profile'];

        $finalPermissions = [];

        foreach ($menuStructure as $parent => $children) {
            $childChecked = false;
            foreach ($children as $child) {
                if (isset($request[$child]) && $request[$child] == 'on') {
                    $childChecked = true;
                    $finalPermissions[] = $child;
                }
            }
            if ($childChecked) {
                $finalPermissions[] = $parent;
            }
        }

        foreach ($independentSections as $section) {
            if (isset($request[$section]) && $request[$section] == 'on') {
                $finalPermissions[] = $section;
            }
        }

        $finalPermissions = array_unique($finalPermissions);

        foreach ($finalPermissions as $permission) {
            $this->db->insert('permissions', ['employee_id', 'section_name'], [$id, $permission]);
        }

        $this->flashMessageTo('success', _success, url('employees'));
    }



    // show employees
    public function showEmployees()
    {
        $this->middleware(true, true, 'showEmployees');

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
