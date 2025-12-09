<?php

namespace App;

class IntakeTime extends App
{
    //  intakeTimes page
    public function intakeTimes()
    {
        $this->middleware(true, true, 'general', true);
        $intakeTimes = $this->db->select('SELECT * FROM intake_times')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/intake-times/intake-times.php');
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
    public function editCatStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['cat_name'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT * FROM expenses_categories WHERE `cat_name` = ?', [$request['cat_name']])->fetch();

        if ($item) {
            if ($item['id'] != $id) {
                $this->flashMessage('error', 'این دسته قبلا ثبت شده است.');
                return;
            }
        }

        $this->db->update('expenses_categories', $id, array_keys($request), $request);
        $this->flashMessage('success', _success);
    }


    // change status Expense Cat
    public function changeStatusExpenseCat($id)
    {
        $this->middleware(true, true, 'general');
        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories WHERE id = ?', [$id])->fetch();
        if ($expenses_categories != null) {
            if ($expenses_categories['state'] == 1) {
                $this->db->update('expenses_categories', $expenses_categories['id'], ['state'], [2]);
                $this->send_json_response(true, _success, 2);
            } else {
                $this->db->update('expenses_categories', $expenses_categories['id'], ['state'], [1]);
                $this->send_json_response(true, _success, 1);
            }
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit expense page
    public function editExpense($id)
    {
        $this->middleware(true, true, 'general', true);

        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories WHERE id = ?', [$id])->fetch();
        if ($expenses_categories != null) {
            require_once(BASE_PATH . '/resources/views/app/expenses-categories/edit-expense.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }
}
