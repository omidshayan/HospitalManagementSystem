<?php

namespace App;

class Department extends App
{
    //  departments page
    public function departments()
    {
        $this->middleware(true, true, 'departments', true);
        $departments = $this->db->select('SELECT * FROM departments')->fetchAll();
        $users = $this->db->select('SELECT * FROM employees WHERE `state` = 1')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/departments/departments.php');
    }

    // store department
    public function departmentStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['name'] == '' || $request['manager_id'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $department = $this->db->select('SELECT `name` FROM departments WHERE `name` = ?', [$request['name']])->fetch();

        if (!empty($department['name'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('departments', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // department page
    public function editDepartment($id)
    {
        $this->middleware(true, true, 'general');

        $department = $this->db->select('SELECT * FROM departments WHERE `id` = ?', [$id])->fetch();
        $users = $this->db->select('SELECT * FROM employees WHERE `state` = 1')->fetchAll();
        if ($department != null) {
            require_once(BASE_PATH . '/resources/views/app/departments/edit-department.php');
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
