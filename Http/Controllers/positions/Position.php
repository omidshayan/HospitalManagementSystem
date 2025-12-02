<?php

namespace App;

require_once 'Http/Controllers/App.php';

use database\DataBase;

class Position extends App
{

    // add position page
    public function addPosition()
    {
        $this->middleware(true, true, 'general', true);
        $positions = $this->db->select('SELECT * FROM positions')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/positions/add-position.php');
    }

    // store postion
    public function store($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);
        $position = $this->db->select('SELECT * FROM positions WHERE `name` = ?', [$request['name']])->fetch();
        if ($position['name'] != '' && $position != false) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('positions', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // show departments
    public function showDepartments()
    {
        $this->middleware(true, true, 'general');
        $departments = $this->db->select('SELECT * FROM departments')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/departments/show-departments.php');
    }

    // change status department
    public function changeStatus($id)
    {
        $this->middleware(true, true, 'general');
        $department = $this->db->select('SELECT * FROM departments WHERE id = ?', [$id])->fetch();
        if ($department != null) {
            if ($department['state'] == 1) {
                $this->db->update('departments', $department['id'], ['state'], [2]);
                flash('success', _success);
                $this->redirectBack();
                exit();
            } else {
                $this->db->update('departments', $department['id'], ['state'], [1]);
                flash('success', _success);
                $this->redirectBack();
                exit();
            }
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }
}
