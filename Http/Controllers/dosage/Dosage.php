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

    // store dosage
    public function dosageStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['dosage'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }
        $dosage = $this->db->select('SELECT dosage FROM dosage WHERE `dosage` = ?', [$request['dosage']])->fetch();

        if (!empty($dosage['dosage'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('dosage', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // dosage page
    public function editDosage($id)
    {
        $this->middleware(true, true, 'general');

        $dosage = $this->db->select('SELECT * FROM dosage WHERE `id` = ?', [$id])->fetch();
        if ($dosage != null) {
            require_once(BASE_PATH . '/resources/views/app/dosage/dosage.php');
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
