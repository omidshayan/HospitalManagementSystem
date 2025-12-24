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

    // edit department store
    public function editDepartmentStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['name'] == '' || $request['manager_id'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $department = $this->db->select('SELECT * FROM departments WHERE `name` = ?', [$request['name']])->fetch();

        if ($department) {
            if ($department['id'] != $id) {
                $this->flashMessage('error', 'این مقدار مصرف ثبت شده است.');
                return;
            }
        }

        $this->db->update('departments', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('departments'));
    }

    // dosage Details detiles page
    public function departmentDetiles($id)
    {
        $this->middleware(true, true, 'general');
        $department = $this->db->select(
            'SELECT departments.*, users.employee_name 
            FROM departments 
            LEFT JOIN users ON users.id = departments.manager_id
            WHERE departments.id = ?',
            [$id]
        )->fetch();

        if ($department != null) {
            require_once(BASE_PATH . '/resources/views/app/departments/department-details.php');
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
