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
        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories WHERE `cat_name` = ?', [$request['cat_name']])->fetch();
        if (!empty($expenses_categories['cat_name'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('expenses_categories', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // Expense Cat Details detiles page
    public function expenseCatDetails($id)
    {
        $this->middleware(true, true, 'general');
        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories WHERE `id` = ?', [$id])->fetch();
        if ($expenses_categories != null) {
            require_once(BASE_PATH . '/resources/views/app/expenses-categories/expense-cat-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
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

    // edit expense store
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
}
