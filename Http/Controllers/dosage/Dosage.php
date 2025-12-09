<?php

namespace App;

class Dosage extends App
{
    //  Dosage page
    public function dosage()
    {
        $this->middleware(true, true, 'general', true);
        $dosage = $this->db->select('SELECT * FROM dosage')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/dosage/dosage.php');
    }

    // store intake_time
    public function intakeTimeStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['intake_time'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }
        $intake_time = $this->db->select('SELECT intake_time FROM intake_times WHERE `intake_time` = ?', [$request['intake_time']])->fetch();

        if (!empty($intake_time['intake_time'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('intake_times', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // intake_time page
    public function editIntakeTime($id)
    {
        $this->middleware(true, true, 'general');
        $intake_time = $this->db->select('SELECT * FROM intake_times WHERE `id` = ?', [$id])->fetch();
        if ($intake_time != null) {
            require_once(BASE_PATH . '/resources/views/app/intake-times/edit-intake-time.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit intake_time store
    public function editIntakeTimeStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['intake_time'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT * FROM intake_times WHERE `intake_time` = ?', [$request['intake_time']])->fetch();

        if ($item) {
            if ($item['id'] != $id) {
                $this->flashMessage('error', 'این دسته قبلا ثبت شده است.');
                return;
            }
        }

        $this->db->update('intake_times', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('intake-times'));
    }

    // intakeTimeDetails Details detiles page
    public function intakeTimeDetails($id)
    {
        $this->middleware(true, true, 'general');
        $intake_time = $this->db->select('SELECT * FROM intake_times WHERE `id` = ?', [$id])->fetch();
        if ($intake_time != null) {
            require_once(BASE_PATH . '/resources/views/app/intake-times/intake_time-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status intake_time
    public function changeStatusIntakeTime($id)
    {
        $this->middleware(true, true, 'general');
        $intake_time = $this->db->select('SELECT * FROM intake_times WHERE id = ?', [$id])->fetch();
        if ($intake_time != null) {
            if ($intake_time['status'] == 1) {
                $this->db->update('intake_times', $intake_time['id'], ['status'], [2]);
                $this->send_json_response(true, _success, 2);
            } else {
                $this->db->update('intake_times', $intake_time['id'], ['status'], [1]);
                $this->send_json_response(true, _success, 1);
            }
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }
}
