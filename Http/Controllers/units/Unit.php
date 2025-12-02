<?php

namespace App;

class Unit extends App
{
    // units page
    public function units()
    {
        dd('asdf');
        $this->middleware(true, true, 'general', true);
        $ProductCategory = $this->getTableData('products_category');

        require_once(BASE_PATH . '/resources/views/app/products/products-category/product-category.php');
    }

    // store products Category Store
    public function productsCategoryStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if (empty($request['product_category_name']) || empty($request['branch_id'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $isGlobal = isset($request['global']) && $request['global'] ? 1 : 0;

        if ($isGlobal) {
            $existingGlobal = $this->db->select(
                'SELECT * FROM products_category WHERE product_category_name = ? AND `global` = 1',
                [$request['product_category_name']]
            )->fetch();

            if (!empty($existingGlobal)) {
                $this->flashMessage('error', _repeat);
            }

            $existingLocal = $this->db->select(
                'SELECT * FROM products_category WHERE product_category_name = ? AND branch_id = ? AND `global` = 0',
                [$request['product_category_name'], $request['branch_id']]
            )->fetch();

            if (!empty($existingLocal)) {
                $requestUpdate = [
                    'product_category_name' => $existingLocal['product_category_name'],
                    'branch_id' => null,
                    'global' => 1
                ];
                $this->db->update('products_category', $existingLocal['id'], array_keys($requestUpdate), $requestUpdate);
                $this->flashMessage('success', _success);
            } else {
                $cols = ['product_category_name', 'branch_id', 'global'];
                $vals = [$request['product_category_name'], $request['branch_id'], 1];
                $this->db->insert('products_category', $cols, $vals);
                $this->flashMessage('success', _success);
            }
        } else {
            $existingLocal = $this->db->select(
                'SELECT * FROM products_category WHERE product_category_name = ? AND branch_id = ? AND `global` = 0',
                [$request['product_category_name'], $request['branch_id']]
            )->fetch();

            if (!empty($existingLocal)) {
                $this->flashMessage('error', _repeat);
            }

            $cols = ['product_category_name', 'branch_id', 'global'];
            $vals = [$request['product_category_name'], $request['branch_id'], 0];
            $this->db->insert('products_category', $cols, $vals);
            $this->flashMessage('success', _success);
        }
    }

    // edit expense category page
    public function editExpenseCat($id)
    {
        dd('ok');
    }

    // product Cat Details detiles page
    public function productCategoryDetails($id)
    {
        $this->middleware(true, true, 'students');
        $products_category = $this->db->select('SELECT * FROM products_category WHERE `id` = ?', [$id])->fetch();
        if ($products_category != null) {
            require_once(BASE_PATH . '/resources/views/app/products-category/products-category-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status product Cat
    public function changeStatusProductCat($id)
    {
        $this->middleware(true, true, 'students');
        $products_category = $this->db->select('SELECT * FROM products_category WHERE id = ?', [$id])->fetch();
        if ($products_category != null) {
            if ($products_category['status'] == 1) {
                $this->db->update('products_category', $products_category['id'], ['status'], [2]);
                $this->send_json_response(true, _success, 2);
            } else {
                $this->db->update('products_category', $products_category['id'], ['status'], [1]);
                $this->send_json_response(true, _success, 1);
            }
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }











    // change status years
    public function changeStatusYears($request, $id)
    {
        $this->middleware(true, true, 'students', true, $request);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            $this->flashMessage('error', 'درخواست نامعتبر است!');
            exit();
        }

        $year = $this->db->select('SELECT * FROM years WHERE id = ?', [$id])->fetch();
        if (!$year) {
            http_response_code(404);
            $this->flashMessage('error', 'سال موردنظر یافت نشد!');
            exit();
        }

        $currentYear = $this->convertPersionNumber(jdate('Y'));
        $yearFromDB = is_numeric($year['year']) ? $year['year'] : jdate('Y', strtotime($year['year']));
        if ($currentYear == $yearFromDB) {
            http_response_code(403);
            $this->flashMessage('error', 'سال جاری را نمی‌توان بست!');
            exit();
        }

        $newStatus = ($year['status'] == 1) ? 2 : 1;
        $this->db->update('years', $year['id'], ['status'], [$newStatus]);
        $this->flashMessage('success', 'عملیات موفقانه انجام شد.');
    }
}
