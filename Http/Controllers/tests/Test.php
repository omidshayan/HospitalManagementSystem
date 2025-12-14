<?php

namespace App;

class Test extends App
{
    //  intakeTimes page
    public function tests()
    {
        // NOTE add test to permissions 
        $this->middleware(true, true, 'intakeTime', true);
        $tests = $this->db->select('SELECT * FROM tests')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/tests/tests.php');
    }

    // store test
    public function testStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['test_name'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $test = $this->db->select('SELECT test_name FROM tests WHERE `test_name` = ?', [$request['test_name']])->fetch();

        if (!empty($test['test_name'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('tests', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // test page
    public function editTest($id)
    {
        $this->middleware(true, true, 'general');
        $test = $this->db->select('SELECT * FROM tests WHERE `id` = ?', [$id])->fetch();
        if ($test != null) {
            require_once(BASE_PATH . '/resources/views/app/tests/edit-test.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit test store
    public function editTestStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['test_name'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT * FROM tests WHERE `test_name` = ?', [$request['test_name']])->fetch();

        if ($item) {
            if ($item['id'] != $id) {
                $this->flashMessage('error', 'این آزمایش قبلا ثبت شده است.');
                return;
            }
        }

        $this->db->update('tests', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('tests'));
    }

    // test Details detiles page
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

    // change status test
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
