<?php

namespace App;

require_once 'Http/Controllers/App.php';

use database\DataBase;

class Expenses extends App
{

    // add expense page
    public function addExpense()
    {
        $this->middleware(true, true, 'general', true);
        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories WHERE `state` = 1')->fetchAll();
        $by_whom_employees = $this->db->select('SELECT * FROM employees WHERE `state` = 1')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/expenses/add-expenses.php');
    }

    // store expense
    public function expenseStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['title_expense'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $this->handleImageUpload($request['image'], 'images/expenses');

        $this->db->insert('expenses', array_keys($request), $request);
        $this->flashMessage('success', _success);
    }

    // show expenses
    public function showExpenses()
    {
        $this->middleware(true, true, 'general');
        $expenses = $this->db->select('SELECT * FROM expenses ORDER BY id DESC')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/expenses/show-expenses.php');
        exit();
    }

    // expense edit page
    public function editExpense($id)
    {
        $this->middleware(true, true, 'general');
        $expense = $this->db->select('SELECT * FROM expenses WHERE `id` = ?', [$id])->fetch();
        $expenses_categories = $this->db->select('SELECT * FROM expenses_categories')->fetchAll();
        $employees = $this->db->select('SELECT * FROM employees')->fetchAll();
        if ($expense != null) {
            require_once(BASE_PATH . '/resources/views/app/expenses/edit-expense.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    public function editExpenseStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['title_expense'] == '' || $request['category'] == '' || !isset($request['amount'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $item = $this->db->select('SELECT * FROM expenses WHERE `id` = ?', [$id])->fetch();

        if ($item) {
            if ($item['id'] != $id) {
                $this->flashMessage('error', 'شماره موبایل وارد شده قبلاً توسط کارمند دیگری ثبت شده است.');
                return;
            }
        }

        // check upload photo
        $this->handleImageUpdate($request, 'expenses', $item['id'], 'image', 'images/expenses', $_FILES['image']);

        $this->db->update('expenses', $id, array_keys($request), $request);
        $this->flashMessage('success', _success);
    }

    // expense details
    public function expenseDetails($id)
    {
        $this->middleware(true, true, 'general');
        $expense = $this->db->select('SELECT * FROM expenses WHERE id = ?', [$id])->fetch();
        if ($expense) {
            require_once(BASE_PATH . '/resources/views/app/expenses/expense-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change Status Expense
    public function changeStatusExpense($id)
    {
        $this->middleware(true, true, 'general');

        $employee = $this->db
            ->select('SELECT * FROM expenses WHERE id = ?', [$id])
            ->fetch();

        if (!$employee) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newState = ($employee['state'] == 1) ? 2 : 1;

        $this->db->update('expenses', $employee['id'], ['state'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }
}
