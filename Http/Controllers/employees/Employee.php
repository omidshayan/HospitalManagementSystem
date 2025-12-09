<?php

namespace App;

require_once 'Http/Controllers/App.php';

class Employee extends App
{

    // add employee page
    public function addEmployee()
    {
        $this->middleware(true, true, 'addEmployee', true);
        $positions = $this->db->select('SELECT * FROM positions')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/employees/add-employee.php');
    }

    // check empty form
    // if ($request['employee_name'] == '' || $request['password'] == '' || $request['phone'] == '' || !isset($request['position'])) {
    //     $this->flashMessage('error', _emptyInputs);
    // }

    // store employee
    public function employeeStore($request)
    {
        $this->middleware(true, true, 'showEmployees', true, $request, true);

        // بررسی شماره‌ی تکراری
        $existingEmployee = $this->db->select(
            'SELECT * FROM employees WHERE `phone` = ?',
            [$request['phone']]
        )->fetch();

        if ($existingEmployee) {
            $this->flashMessage('error', _phone_repeat);
        }

        // بررسی پسورد
        if (!isset($request['password']) || strlen(trim($request['password'])) < 6) {
            $this->flashMessage('error', 'رمز عبور باید حداقل 6 کاراکتر داشته باشد.');
        }

        // فقط فیلدهای واقعی جدول employees را نگه دار
        $columns = $this->db->select("SHOW COLUMNS FROM employees")->fetchAll();
        $validColumns = array_column($columns, 'Field');

        $employeeData = [];
        foreach ($request as $key => $val) {
            if (in_array($key, $validColumns)) {
                $employeeData[$key] = $val;
            }
        }

        // هش کردن پسورد
        $employeeData['password'] = $this->hash($employeeData['password']);

        // آپلود عکس اگر هست
        $this->handleImageUpload($request['image'] ?? null, 'images/employees');

        // ذخیره کارمند
        $this->db->insert('employees', array_keys($employeeData), $employeeData);

        // دریافت آخرین id کارمند ثبت شده
        $lastEmployeeId = $this->db
            ->select("SELECT id FROM employees ORDER BY id DESC LIMIT 1")
            ->fetch()['id'];

        // تعریف ارتباط بخش ها با پرنت‌ها
        $permissionMap = [
            'paitents'           => 'parentPaitents',
            'addPrescription'    => 'parentPrescription',
            'showPrescription'   => 'parentPrescription',
            'addEmployee'        => 'parentEmployee',
            'showEmployees'      => 'parentEmployee',
            'positions'          => 'parentEmployee',
            'addDrug'            => 'parentDrug',
            'showDrugs'          => 'parentDrug',
            'catDrug'            => 'parentDrug',
            'unitDrug'           => 'parentDrug',
            'numberDrugs'        => 'parentNumberDrugs',
            'intakeTime'         => 'parentNumberDrugs',
            'dosage'             => 'parentNumberDrugs',
            'intakeInstructions' => 'parentNumberDrugs',
            'prescriptionSettings' => 'parentNumberDrugs',
        ];

        // دسترسی های پیشفرض که همیشه ثبت شوند
        $defaultPermissions = ['profile', 'dashboard', 'general'];

        // استخراج دسترسی‌های انتخاب شده از فرم
        $selectedPermissions = [];
        foreach ($request as $key => $val) {
            if ($val === 'on') {
                $selectedPermissions[] = $key;

                // اضافه کردن parent اگر وجود دارد
                if (isset($permissionMap[$key])) {
                    $selectedPermissions[] = $permissionMap[$key];
                }
            }
        }

        // اضافه کردن دسترسی های پیشفرض
        $selectedPermissions = array_merge($selectedPermissions, $defaultPermissions);

        // حذف موارد تکراری
        $selectedPermissions = array_unique($selectedPermissions);

        // ذخیره دسترسی‌ها اگر وجود داشته باشند
        if (!empty($selectedPermissions)) {
            foreach ($selectedPermissions as $section) {
                $this->db->insert(
                    'permissions',
                    ['employee_id', 'section_name'],
                    [$lastEmployeeId, $section]
                );
            }
        }

        $this->flashMessage('success', _success);
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
