<?php

namespace App;

require_once 'Http/Controllers/App.php';

use database\DataBase;

class Position extends App
{
    // add position page
    public function Positions()
    {
        $this->middleware(true, true, 'positions', true);
        $positions = $this->db->select('SELECT * FROM positions')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/positions/positions.php');
    }

    // store postion
    public function positionStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if (empty(trim($request['name'] ?? ''))) {
            $this->flashMessage('error', _emptyInputs);
            return;
        }
        $branchId = $this->getBranchId();
        $position = $this->db->select('SELECT `name` FROM positions WHERE `name` = ? AND branch_id = ?', [$request['name'], $branchId])->fetch();

        if ($position) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('positions', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // edit position page
    public function editPosition($id)
    {
        $this->middleware(true, true, 'general', true);

        $position = $this->db->select('SELECT * FROM positions WHERE id = ?', [$id])->fetch();

        if ($position) {
            require_once(BASE_PATH . '/resources/views/app/positions/edit-position.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit position store
    public function editPositionStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if (trim($request['name']) == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $currentPosition = $this->db->select(
            'SELECT * FROM positions WHERE id = ?',
            [$id]
        )->fetch();

        if (!$currentPosition) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $exists = $this->db->select(
            'SELECT id FROM positions WHERE name = ? AND id != ?',
            [$request['name'], $id]
        )->fetch();

        if ($exists) {
            $this->flashMessage('error', _repeat);
        }

        $this->db->update('positions', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('positions'));
    }

    // position detiles page
    public function positionDetails($id)
    {
        $this->middleware(true, true, 'general');

        $position = $this->db->select('SELECT * FROM positions WHERE id = ?', [$id])->fetch();
        if ($position != null) {
            require_once(BASE_PATH . '/resources/views/app/positions/position-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status Position
    public function changeStatusPosition($id)
    {
        $this->middleware(true, true, 'general');

        $position = $this->db->select('SELECT * FROM positions WHERE id = ?', [$id])->fetch();

        if (!$position) {
            require BASE_PATH . '/404.php';
            exit;
        }

        $newState = $position['state'] == 1 ? 2 : 1;
        $this->db->update('positions', $position['id'], ['state'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }
}
