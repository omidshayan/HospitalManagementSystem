<?php

namespace App;

class NumberDrug extends App
{
    //  numberDrugs page
    public function numberDrugs()
    {
        $this->middleware(true, true, 'general', true);
        $numberDrugs = $this->db->select('SELECT * FROM number_of_drugs')->fetch();
        require_once(BASE_PATH . '/resources/views/app/number-drugs/number-drugs.php');
    }

    // store expenses
    public function expenseCatStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);
        if ($request['cat_name'] == '') {
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
