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

        $prescription = $this->db->select('SELECT * FROM prescriptions WHERE `type` = ? AND `status` = ?', [1, 1])->fetch();

        if ($prescription) {
            $drugList = $this->db->select('SELECT * FROM prescription_items WHERE `prescription_id` = ?', [$prescription['id']])->fetchAll();
        }

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
            'type' => 1,
            'year' => $yearMonth['year'],
            'month' => $yearMonth['month'],
            'who_it' => $request['who_it'],
        ];
        //  Create or get existing prescription
        $prescription_id = $this->prescription->InvoiceConfirm($prescription);


        $prescription_items = [
            'prescription_id' => $prescription_id,
            'drug_id' => $request['drug_id'],
            'drug_name' => $request['drug_name'],
            'drug_count' => $request['drug_count'],
            'interval_time' => $request['interval_time'],
            'dosage' => $request['dosage'],
            'usage_instruction' => $request['usage_instruction'],
            'description' => $request['description'],
        ];

        $exist_item = $this->prescription->getPrescriptionItem($prescription_id, $request['drug_id']);

        if (!$exist_item) {
            $this->db->insert('prescription_items', array_keys($prescription_items), $prescription_items);
        } else {
            $update_data = [
                'quantity' => $exist_item['quantity'] + $prescription_items['quantity'],
                'package_qty' => $exist_item['package_qty'] + $prescription_items['package_qty'],
            ];
            $this->db->update('prescription_items', $exist_item['id'], array_keys($update_data), $update_data);
        }

        $this->flashMessage('success', _success);
    }



    //////////////////////////////////////////////

    // delete saleproduct from cart
    public function deletePrescriptionItem($id)
    {
        $this->middleware(true, true, 'general', true);

        if (!is_numeric($id)) {
            $this->flashMessage('error', 'لطفا اطلاعات درست ارسال نمائید!');
        }

        $prescription_item = $this->db->select('SELECT id FROM prescription_items WHERE `id` = ?', [$id])->fetch();
        if (!$prescription_item) {
            require_once(BASE_PATH . '/404.php');
            exit;
        }

        $this->db->delete('prescription_items', $id);
        $this->flashMessage('success', _success);
    }

    // delete prescription
    public function deletePrescription($id)
    {
        $this->middleware(true, true, 'general', true);

        if (!is_numeric($id)) {
            $this->flashMessage('error', 'لطفا اطلاعات درست ارسال نمائید!');
        }

        $prescription = $this->db->select('SELECT id FROM prescriptions WHERE `id` = ?', [$id])->fetch();

        if (!$prescription) {
            require_once(BASE_PATH . '/404.php');
            exit;
        }

        $this->db->delete('prescriptions', $id);
        $this->flashMessage('success', _success);
        exit;
    }


    // close invoice
    // public function closeSaleInvoiceStore($request)
    // {
    //     $this->middleware(true, true, 'general', true, $request, true);

    //     // check pain amount to not larg
    //     $total_price = isset($request['total_price']) && is_numeric($request['total_price']) ? floatval($request['total_price']) : 0;
    //     $sale_discount = isset($request['total_discount']) && is_numeric($request['total_discount']) ? floatval($request['total_discount']) : 0;
    //     $sale_paid_amount = isset($request['paid_amount']) && is_numeric($request['paid_amount']) ? floatval($request['paid_amount']) : 0;

    //     if (
    //         !is_numeric($request['total_price']) && $request['total_price'] !== '' ||
    //         !is_numeric($request['total_discount']) && $request['total_discount'] !== '' ||
    //         !is_numeric($request['paid_amount']) && $request['paid_amount'] !== ''
    //     ) {
    //         $this->flashMessage('error', 'لطفا فقط مقدار عددی وارد کنید!');
    //     } else {
    //         $remaining_amount = $total_price - $sale_discount - $sale_paid_amount;
    //         $after_discount = $sale_discount + $sale_paid_amount;

    //         if ($sale_paid_amount > $total_price || $remaining_amount < 0) {
    //             $this->flashMessage('error', 'مبلغ پرداختی نمی‌تواند بیشتر از مبلغ فاکتور باشد!');
    //         }
    //     }

    //     if ($request['seller_id'] == '') {
    //         if ($total_price > $after_discount) {
    //             $this->flashMessage('error', 'چون مشتری عمومی است، باید مبلغ کل به صورت کامل پرداخت شود!');
    //         }
    //     }

    //     $branchId = $this->getBranchId();
    //     // get sale invoice
    //     $invoice = $this->invoice->getInvoice($request['invoice_id'], $branchId);
    //     if (!$invoice) {
    //         require_once(BASE_PATH . '/404.php');
    //         exit();
    //     }

    //     // get month and year
    //     $yearMonth = $this->calendar->getYearMonth();


    //     // get invoice items
    //     $invoice_items = $this->invoice->getInvoiceItems($invoice['id']);
    //     // check invoice items
    //     if (!$invoice_items) {
    //         $this->flashMessage('error', 'فاکتور مورد نظر خالی است!');
    //         return;
    //     }

    //     // foreach for handle invoice items
    //     foreach ($invoice_items as $item) {

    //         // exist product to sales table?
    //         $existingInventory = $this->db->select(
    //             "SELECT * FROM inventory WHERE product_id = ? AND branch_id = ?",
    //             [$item['product_id'], $item['branch_id']]
    //         )->fetch();


    //         if ($existingInventory) {

    //             // get settings for sell any situation
    //             $settings = $this->db->select("SELECT sell_any_situation FROM settings WHERE branch_id = ?", [$item['branch_id']])->fetch();
    //             if ($settings['sell_any_situation'] == 2) {
    //                 if ($item['quantity'] > $existingInventory['quantity']) {
    //                     $this->flashMessage('error', 'تعداد موجودی نسبت به تعداد فروش کم است!');
    //                 }
    //             }

    //             // check product batches 
    //             $product_batches = $this->db->select(
    //                 "SELECT * FROM product_batches WHERE product_id = ? AND branch_id = ? AND status = 1 ORDER BY id ASC",
    //                 [$item['product_id'], $item['branch_id']]
    //             )->fetchAll();

    //             $totalProfit = 0;
    //             $remainingQty = $item['quantity'];

    //             foreach ($product_batches as $batch) {
    //                 if ($remainingQty <= 0) break;

    //                 // تعداد واقعی فروخته شده از این batch
    //                 $soldQty = min($remainingQty, (int)$batch['quantity']);
    //                 $remainingQty -= $soldQty;

    //                 // محاسبه سود برای همین batch
    //                 $profit = ($batch['package_price_sell'] - $batch['package_price_buy']) * $soldQty; // قیمت فروش و خرید هر batch
    //                 $totalProfit += $profit;

    //                 // ثبت سود در جدول invoice_profits
    //                 $profitData = [
    //                     'branch_id' => $item['branch_id'],
    //                     'invoice_id' => $invoice['id'],
    //                     'invoice_item_id' => $item['id'],
    //                     'product_id' => $item['product_id'],
    //                     'batch_id' => $batch['id'],
    //                     'quantity' => $soldQty,
    //                     'buy_price' => $batch['package_price_buy'],
    //                     'sell_price' => $batch['package_price_sell'],
    //                     'profit' => $profit,
    //                 ];
    //                 $this->db->insert('invoice_profits', array_keys($profitData), $profitData);

    //                 // به‌روزرسانی batch
    //                 $newBatchQty = (int)$batch['quantity'] - $soldQty;
    //                 if ($newBatchQty <= 0) {
    //                     // کل batch فروخته شد → فقط status تغییر کند
    //                     $this->db->update('product_batches', $batch['id'], ['quantity', 'status'], [0, 2]);
    //                 } else {
    //                     // بخشی از batch فروخته شد → آپدیت مقدار باقی مانده
    //                     $this->db->update('product_batches', $batch['id'], ['quantity'], [$newBatchQty]);
    //                 }

    //                 // کاهش تعداد از inventory (همیشه)
    //                 $newInventoryQty = $existingInventory['quantity'] - $item['quantity'];
    //                 $this->db->update('inventory', $existingInventory['id'], ['quantity'], [$newInventoryQty]);
    //             }
    //         } else {
    //             $this->flashMessage('error', 'محصول تا به حال در موجودی ثبت نشده!');
    //         }
    //     } //end foreach

    //     // array for transaction
    //     $this->transaction->addNewTransaction([
    //         'branch_id' => $request['branch_id'],
    //         'user_id' => $request['seller_id'],
    //         'ref_id' => $invoice['invoice_number'],
    //         'total_price' =>  $request['total_price'],
    //         'paid_amount' => $request['paid_amount'],
    //         'discount' => $request['total_discount'],
    //         'transaction_date'  => $request['date'],
    //         'who_it' => $request['who_it'],
    //         'year' => $yearMonth['year'],
    //         'month' => $yearMonth['month'],
    //         'transaction_type' => 1, // sale
    //     ]);

    //     // send notificatons
    //     $this->notification->sendNotif([
    //         'branch_id' => $request['branch_id'],
    //         'user_id' => $request['seller_id'],
    //         'ref_id' => $invoice['id'],
    //         'type' => 1,
    //     ]);

    //     // update account balance
    //     $accoutBalance = [
    //         'branch_id' => $request['branch_id'],
    //         'user_id' => $request['seller_id'],
    //         'total_price' =>  $request['total_price'],
    //         'paid_amount' => $request['paid_amount'],
    //         'discount' => $request['total_discount'],
    //         'year' => $yearMonth['year'],
    //         'type' => 1,
    //     ];
    //     $this->transaction->updateAccountBalance($accoutBalance);

    //     // update daily reports
    //     $dailyReports = [
    //         'branch_id' => $request['branch_id'],
    //         'total_price' =>  $request['total_price'],
    //         'paid_amount' => $request['paid_amount'],
    //         'discount' => $request['total_discount'],
    //         'type' => 1,
    //     ];
    //     $this->reports->updateDailyReports($dailyReports);



    //     // update fund
    //     $updateFund = [
    //         'branch_id'   => $request['branch_id'],
    //         'paid_amount' => $sale_paid_amount,
    //         'type'        => 1,
    //         'source'      => isset($request['source']) ? (int)$request['source'] : 1,
    //     ];
    //     $this->reports->updateFund($updateFund);


    //     // invoice data
    //     $invoice_infos = [
    //         'total_amount' => $total_price,
    //         'discount' => $sale_discount,
    //         'user_id' => $request['seller_id'],
    //         'date' => $request['date'],
    //         'paid_amount' => $sale_paid_amount,
    //         'description' => $request['description'],
    //         'year' => $yearMonth['year'],
    //         'month' => $yearMonth['month'],
    //         'status' => 2,
    //     ];


    //     $inserted = $this->db->update('invoices', $invoice['id'], array_keys($invoice_infos), $invoice_infos);
    //     if ($inserted) {
    //         if (isset($request['invoice_print'])) {
    //             $this->InvoicePrint($request['invoice_id']);
    //             $invoicePrintData = $this->InvoicePrint($request['invoice_id']);

    //             $this->flashMessagePrint('success', _success, [
    //                 'print_invoice' => $invoicePrintData,
    //             ]);
    //         }
    //     }
    //     $this->flashMessage('success', _success);
    // }

    // edit and close invoice sale cart controllers
    // public function editSaleProductCart($id)
    // {
    //     $this->middleware(true, true, 'general', true);

    //     $product_cart = $this->db->select('SELECT * FROM invoice_items WHERE id = ?', [$id])->fetch();

    //     if ($product_cart == null) {
    //         require_once(BASE_PATH . '/404.php');
    //         exit();
    //     }

    //     $user = $this->db->select('SELECT id, user_name FROM users WHERE id = ?', [$product_cart['seller_id']])->fetch();

    //     if ($product_cart != null) {
    //         require_once(BASE_PATH . '/resources/views/app/sales/edit-sale-product-cart.php');
    //         exit();
    //     } else {
    //         require_once(BASE_PATH . '/404.php');
    //         exit();
    //     }
    // }

    // edit sale product cart store
    // public function editSaleProductCartStore($request, $id)
    // {


    //     $this->middleware(true, true, 'general', true, $request, true);

    //     if ($request['package_qty'] == '' && $request['unit_qty'] == '') {
    //         $this->flashMessage('error', 'لطفا تعداد بسته یا عدد را وارد نمائید!');
    //     }

    //     $product_cart = $this->db->select('SELECT * FROM invoice_items WHERE `id` = ?', [$id])->fetch();
    //     if (!$product_cart) {
    //         require_once(BASE_PATH . '/404.php');
    //         exit;
    //     }

    //     $request = $this->cleanNumbers($request, ['package_qty', 'unit_qty']);




    //     $unit_prices = $this->calculateUnitPrices($product_cart);
    //     $unit_price = $unit_prices['sell'];

    //     // new quantity
    //     $request['quantity'] = ($product_cart['quantity_in_pack'] * (int)$request['package_qty']) + (int)$request['unit_qty'];

    //     // $item_discount = 0;
    //     // if ($request['discount'] != 0) {
    //     //     $item_discount =  intval($request['discount']);
    //     // }

    //     $request['item_total_price'] = $unit_price * $request['quantity'];  // - $item_discount

    //     $this->db->update('invoice_items', $id, array_keys($request), $request);
    //     $this->flashMessageTo('success', _success, url('add-sale'));
    // }


    // delete sale invoice from buy product form







































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
