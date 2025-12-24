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

        if ($request['employee_name'] == '' || $request['password'] == '' || $request['phone'] == '' || !isset($request['position'])) {
            $this->flashMessage('error', _emptyInputs);
            return;
        }

        $existingEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();
        if ($existingEmployee) {
            $this->flashMessage('error', _phone_repeat);
            return;
        }

        if (!isset($request['password']) || strlen(trim($request['password'])) < 6) {
            $this->flashMessage('error', 'رمز عبور باید حداقل 6 کاراکتر داشته باشد.');
            return;
        }

        try {
            $this->db->beginTransaction();

            $request = $this->validateInputs($request, ['image' => false]);
            $request['password'] = $this->hash($request['password']);

            $this->handleImageUpload($request['image'], 'images/employees');

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

            $employeeId = $this->db->lastInsertId();

            $parentChildMap = [
                'parentPatients' => ['showPatients', 'addPatient'],
                'parentAdmission' => ['addAdmission', 'showAdmissions'],
                'parentPrescription' => ['addPrescription', 'showPrescription'],
                'parentEmployee' => ['addEmployee', 'showEmployees', 'positions'],
                'parentDrug' => ['addDrug', 'showDrugs', 'catDrug', 'unitDrug'],
                'parentSetting' => ['numberDrugs', 'intakeTime', 'dosage', 'intakeInstructions', 'settingPrescription', 'tests'],
                'prescriptionPrint' => null,
            ];

            $permissionsToInsert = [];

            if (!empty($request['prescriptionPrint'])) {
                $permissionsToInsert[] = 'prescriptionPrint';
            }

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

            foreach ($parentChildMap as $parent => $children) {
                if ($children === null) {
                    continue;
                }
                $addPermissionWithParent($parent, $children);
            }

            foreach ($permissionsToInsert as $sectionName) {
                $this->db->insert('permissions', ['employee_id', 'section_name'], [$employeeId, $sectionName]);
            }

            $defaultPermissions = ['dashboard', 'profile', 'general'];
            foreach ($defaultPermissions as $defaultPermission) {
                $this->db->insert('permissions', ['employee_id', 'section_name'], [$employeeId, $defaultPermission]);
            }

            $this->db->commit();

            $this->flashMessage('success', _success);
        } catch (\Exception $e) {
            $this->db->rollBack();
            $this->flashMessage('error', 'خطا در ثبت کارمند: ' . $e->getMessage());
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
            return;
        }

        $existEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();
        if ($existEmployee && $existEmployee['id'] != $id) {
            $this->flashMessage('error', 'شماره موبایل وارد شده قبلاً توسط کارمند دیگری ثبت شده است.');
            return;
        }

        try {
            $this->db->beginTransaction();

            $this->updateImageUpload($request, 'image', 'employees', 'employees', $id);

            $this->db->update('employees', $id, array_keys($request), $request);

            $this->db->deleteWhere('permissions', 'employee_id', $id);

            $menuStructure = [
                'parentPrescription' => ['addPrescription', 'showPrescription'],
                'parentAdmission' => ['addAdmission', 'showAdmissions'],
                'parentEmployee' => ['addEmployee', 'showEmployees', 'positions'],
                'parentDrug' => ['addDrug', 'showDrugs', 'catDrug', 'unitDrug'],
                'parentSetting' => ['numberDrugs', 'intakeTime', 'dosage', 'intakeInstructions', 'settingPrescription', 'tests'],
                'parentPatients' => ['showPatients', 'addPatient'],
            ];

            $independentSections = ['prescriptionPrint', 'dashboard', 'profile'];

            $defaultPermissions = ['dashboard', 'profile', 'general'];

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

            $finalPermissions = array_unique(array_merge($finalPermissions, $defaultPermissions));

            foreach ($finalPermissions as $permission) {
                $this->db->insert('permissions', ['employee_id', 'section_name'], [$id, $permission]);
            }

            $this->db->commit();

            $this->flashMessageTo('success', _success, url('employees'));
        } catch (\Exception $e) {
            $this->db->rollBack();
            $this->flashMessage('error', 'خطا در بروزرسانی کارمند: ' . $e->getMessage());
        }
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
            $today = date('Y-m-d');
            $sevenDaysAgo = date('Y-m-d', strtotime('-6 days'));

            $prescriptionsLast7Days = $this->db->select("
            SELECT DATE(created_at) as date, COUNT(*) as count
            FROM prescriptions
            WHERE doctor_id = ? AND DATE(created_at) BETWEEN ? AND ?
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at) ASC
        ", [$id, $sevenDaysAgo, $today])->fetchAll();

            $dates = [];
            for ($i = 6; $i >= 0; $i--) {
                $dates[] = date('Y-m-d', strtotime("-$i days"));
            }

            $data = array_fill_keys($dates, 0);

            foreach ($prescriptionsLast7Days as $row) {
                $data[$row['date']] = (int)$row['count'];
            }

            $totalPrescriptions = $this->db->select("
                SELECT COUNT(*) as total
                FROM prescriptions
                WHERE doctor_id = ?
            ", [$id])->fetchColumn();

            require_once(BASE_PATH . '/resources/views/app/employees/employee-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }
}
