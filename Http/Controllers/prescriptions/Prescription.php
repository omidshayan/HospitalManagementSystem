<?php

namespace App;

require_once 'Http/Models/Calendar.php';
require_once 'Http/Models/Prescriptions.php';

use Models\Calendar\Calendar;
use Models\Prescriptions\Prescriptions;

class Prescription extends App
{
    private $calendar;
    private $prescription;
    public function __construct()
    {
        parent::__construct();
        $this->calendar = new Calendar();
        $this->prescription = new Prescriptions();
    }

    // drugs
    public function addPrescription()
    {
        $this->middleware(true, true, 'general', true);
        $drugCategories = $this->db->select('SELECT * FROM drug_categories WHERE `status` = ?', [1])->fetchAll();
        $units = $this->db->select('SELECT * FROM units WHERE `status` = ?', [1])->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/prescriptions/add-prescription.php');
    }


    // search product for inventory
    public function searchProdut($request)
    {
        $this->middleware(true, true, 'general');

        $product = $this->db->select(
            "SELECT id, `name` 
            FROM drugs 
            WHERE `status` = 1 
            AND `name` LIKE ? 
            ORDER BY `name` 
            LIMIT 20",
            ['%' . strtolower($request['customer_name']) . '%']
        )->fetchAll();

        $response = [
            'status' => 'success',
            'products' => $product,
            'message' => 'lists'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    //    add drug in Prescription Store
    public function drugPrescriptionStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // if (empty($request['drug_id']) || empty($request['drug_name'])) {
        //     $this->flashMessage('error', _emptyInputs);
        // }

        $this->validateInputs($request);

        $yearMonth = $this->calendar->getYearMonth();

        $user_id = $this->currentUser();

        //  Prepare invoice info
        $prescription = [
            'doctor_id' => $user_id['id'],
            'year' => $yearMonth['year'],
            'month' => $yearMonth['month'],
            'who_it' => $request['who_it'],
        ];

        //  Create or get existing invoice
        $invoice_id = $this->prescription->InvoiceConfirm($prescription);

        $invoice_items = [
            'invoice_id' => $invoice_id,
            'product_id' => $request['product_id'],
            'product_name' => $request['product_name'],
            'quantity' => $request['quantity'],
            'package_qty' => $request['package_qty'],
            'package_price_buy' => $request['package_price_buy'],
            'package_price_sell' => $request['package_price_sell'],
            'quantity_in_pack' => $request['quantity_in_pack'],
            // 'discount' => $request['discount'] ?? 0,
            'unit_qty' => $request['unit_qty'],
            'item_total_price' => $request['item_total_price'],
            'seller_id' => $request['seller_id'],
            'item_year' => $yearMonth['year'],
            'item_month' => $yearMonth['month'],
            'who_it' => $request['who_it'],
        ];

        //  Check if product exists in this invoice
        $exist_product = $this->prescription->getInvoiceItem($invoice_id, $request['product_id']);


        //         if (!$exist_product) {
        //     //  Insert new product
        //     $this->db->insert('invoice_items', array_keys($invoice_items), $invoice_items);
        // } else {
        //     // 🔄 Update existing product quantities
        //     $update_data = [
        //         'quantity' => $exist_product['quantity'] + $invoice_items['quantity'],
        //         'package_qty' => $exist_product['package_qty'] + $invoice_items['package_qty'],
        //         'unit_qty' => $exist_product['unit_qty'] + $invoice_items['unit_qty'],
        //         'item_total_price' => $exist_product['item_total_price'] + $invoice_items['item_total_price'],
        //         // 'discount' => $invoice_items['discount'] ?? $exist_product['discount'],
        //         'package_price_sell' => $invoice_items['package_price_sell'],
        //         'package_price_buy' => $invoice_items['package_price_buy'],
        //     ];

        //     $this->db->update('invoice_items', $exist_product['id'], array_keys($update_data), $update_data);
        // }

        // $this->flashMessage('success', _success);
    }









    // store employee
    public function employeeStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);
        // check empty form
        if ($request['employee_name'] == '' || $request['password'] == '' || $request['phone'] == '' || !isset($request['position'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $existingEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();
        if ($existingEmployee) {
            $this->flashMessage('error', _phone_repeat);
        } else {
            if (!isset($request['password']) || strlen(trim($request['password'])) < 6) {
                $this->flashMessage('error', 'رمز عبور باید حداقل 6 کاراکتر داشته باشد.');
            }

            $request = $this->validateInputs($request, ['image' => false]);
            $request['password'] = $this->hash($request['password']);

            // check image
            $this->handleImageUpload($request['image'], 'images/employees');

            $this->db->insert('employees', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // edit employee page
    public function editEmployee($id)
    {
        $this->middleware(true, true, 'general', true);

        $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$id])->fetch();
        $positions = $this->db->select('SELECT * FROM positions')->fetchAll();
        $sections = $this->db->select('SELECT * FROM sections WHERE `section_id` IS NULL ORDER BY id ASC')->fetchAll();
        $permissions = $this->db->select('SELECT * FROM permissions WHERE employee_id = ?', [$id])->fetchAll();
        if ($employee != null) {
            require_once(BASE_PATH . '/resources/views/app/employees/edit-employee.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit employee store
    public function editEmployeeStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['employee_name'] == '' || $request['phone'] == '' || !isset($request['position'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $existEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();

        if ($existEmployee) {
            if ($existEmployee['id'] != $existEmployee['id']) {
                $this->flashMessage('error', 'شماره موبایل وارد شده قبلاً توسط کارمند دیگری ثبت شده است.');
                return;
            }
        }

        // check upload photo
        $max_file_size = 1048576;
        if (is_uploaded_file($request['image']['tmp_name'])) {
            if ($request['image']['size'] > $max_file_size) {
                $this->flashMessage('error', 'حجم عکس نباید بیشتر از 1 mb باشد');
            } else {
                $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$existEmployee['id']])->fetch();
                $this->removeImage('public/images/employees/' . $employee['image']);
                $request['image'] = $this->saveImage($request['image'], 'images/employees');
            }
        } else {
            unset($request['image']);
        }

        $this->db->update('employees', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('employees'));
    }

    // show employees
    public function showEmployees()
    {
        $this->middleware(true, true, 'general');
        $employees = $this->db->select('SELECT * FROM employees ORDER BY id DESC')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/employees/show-employees.php');
        exit();
    }

    // change status employee
    public function changeStatus($id)
    {
        $this->middleware(true, true, 'general');

        $employee = $this->db
            ->select('SELECT * FROM employees WHERE id = ?', [$id])
            ->fetch();

        if (!$employee) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newState = ($employee['state'] == 1) ? 2 : 1;

        $this->db->update('employees', $employee['id'], ['state'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }


    // employee detiles page
    public function employeeDetails($id)
    {
        $this->middleware(true, true, 'general');
        $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$id])->fetch();
        if ($employee) {
            require_once(BASE_PATH . '/resources/views/app/employees/employee-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }
}
