<?php

namespace App;

class Unit extends App
{
    // units page
    public function units()
    {
        $this->middleware(true, true, 'general', true);
        $units = $this->db->select('SELECT * FROM units ORDER BY id DESC')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/units/units.php');
    }

    // store unit
    public function unitStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);
        if ($request['unit_name'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }
        $unit = $this->db->select('SELECT * FROM units WHERE `unit_name` = ?', [$request['unit_name']])->fetch();
        if (!empty($unit['unit_name'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('units', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // Expense Cat Details detiles page
    public function unitDetails($id)
    {
        $this->middleware(true, true, 'general');
        $unit = $this->db->select('SELECT * FROM units WHERE `id` = ?', [$id])->fetch();
        if ($unit != null) {
            require_once(BASE_PATH . '/resources/views/app/units/unit-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status Expense Cat
    public function changeStatusUnit($id)
    {
        $this->middleware(true, true, 'general');
        $unit = $this->db->select('SELECT * FROM units WHERE id = ?', [$id])->fetch();
        if ($unit != null) {
            if ($unit['status'] == 1) {
                $this->db->update('units', $unit['id'], ['status'], [2]);
                $this->send_json_response(true, _success, 2);
            } else {
                $this->db->update('units', $unit['id'], ['status'], [1]);
                $this->send_json_response(true, _success, 1);
            }
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit expense page
    public function editUnit($id)
    {
        $this->middleware(true, true, 'general', true);

        $unit = $this->db->select('SELECT * FROM units WHERE id = ?', [$id])->fetch();
        if ($unit != null) {
            require_once(BASE_PATH . '/resources/views/app/units/edit-unit.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit expense store
    public function editUnitStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['cat_name'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT * FROM drug_categories WHERE `cat_name` = ?', [$request['cat_name']])->fetch();

        if ($item) {
            if ($item['id'] != $id) {
                $this->flashMessage('error', 'این دسته قبلا ثبت شده است.');
                return;
            }
        }

        $this->db->update('drug_categories', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('drug-categories'));
    }
}
