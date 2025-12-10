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
        $this->middleware(true, true, 'addPrescription', true);

        $userId = $this->currentUser();

        $drugCategories = $this->db->select('SELECT * FROM drug_categories WHERE `status` = ?', [1])->fetchAll();

        $intake_times = $this->db->select('SELECT intake_time FROM intake_times WHERE `status` = ?', [1])->fetchAll();

        $dosage = $this->db->select('SELECT dosage FROM dosage WHERE `status` = ?', [1])->fetchAll();

        $intakeInstructions = $this->db->select('SELECT intake_instructions FROM intake_instructions WHERE `status` = ?', [1])->fetchAll();

        $number = $this->db->select('SELECT `number` FROM number_of_drugs')->fetch();

        $prescription = $this->db->select('SELECT * FROM prescriptions WHERE doctor_id = ? AND `type` = ? AND `status` = ?', [$userId['id'], 1, 1])->fetch();

        if ($prescription) {
            $drugList = $this->db->select('SELECT * FROM prescription_items WHERE `prescription_id` = ?', [$prescription['id']])->fetchAll();
        }

        require_once(BASE_PATH . '/resources/views/app/prescriptions/add-prescription.php');
    }

    // search prescription for inventory
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

        if (empty($request['drug_id']) || empty($request['drug_name'] || empty($request['drug_count']))) {
            $this->flashMessage('error', _emptyInputs);
        }

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
            'interval_time' => $request['interval_time'] ?? null,
            'dosage' => $request['dosage'] ?? null,
            'usage_instruction' => $request['usage_instruction'] ?? null,
            'description' => $request['description'] ?? null,
        ];

        $exist_item = $this->prescription->getPrescriptionItem($prescription_id, $request['drug_id']);

        if (!$exist_item) {
            $this->db->insert('prescription_items', array_keys($prescription_items), $prescription_items);
        } else {
            $this->flashMessage('error', 'داروی انتخاب شده، قبلا ثبت شده!');
        }

        $this->flashMessage('success', _success);
    }

    // show prescriptions
    public function prescriptions()
    {
        $this->middleware(true, true, 'showPrescription', true);

        $user = $this->currentUser();

        $status = 1;

        if ($user['role'] === 'admin') {

            $prescriptions = $this->db->select(
                'SELECT p.*, e.employee_name
             FROM prescriptions p
             JOIN employees e ON e.id = p.doctor_id
             WHERE p.status != ?',
                [$status]
            )->fetchAll();
        } else {

            $prescriptions = $this->db->select(
                'SELECT p.*, e.employee_name
             FROM prescriptions p
             JOIN employees e ON e.id = p.doctor_id
             WHERE p.doctor_id = ? AND p.status != ?',
                [$user['id'], $status]
            )->fetchAll();
        }

        require_once(BASE_PATH . '/resources/views/app/prescriptions/prescriptions.php');
    }


    // patient Inquiry
    public function patientInquiry()
    {
        $this->middleware(true, true, 'showPrescription', true);

        $user = $_GET['patient_name'];
        $birth_year = $_GET['birth_year'];

        $userSearch = $this->db->select("SELECT prescriptions.*, users.phone, users.father_name FROM prescriptions LEFT JOIN users ON prescriptions.patient_id = users.id WHERE LOWER(prescriptions.patient_name) LIKE ? AND prescriptions.birth_year = ?", ['%' . strtolower($user) . '%', $birth_year])->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/prescriptions/result-search.php');
    }

    // showPrescriptionItem
    public function showPrescriptionItem($id)
    {
        $this->middleware(true, true, 'prescriptionPrint', true);

        $prescription = $this->db->select(
            'SELECT p.*, 
                e.employee_name,
                e.expertise
         FROM prescriptions p
         JOIN employees e ON e.id = p.doctor_id
         WHERE  p.id = ?',
            [$id]
        )->fetch();

        $items = [];

        if ($prescription) {
            $items = $this->db->select(
                'SELECT *
             FROM prescription_items
             WHERE prescription_id = ?
             ORDER BY id ASC',
                [$prescription['id']]
            )->fetchAll();
        }

        require_once(BASE_PATH . '/resources/views/app/prescriptions/show-prescription-item.php');
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
    public function closePrescriptionStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);


        if (empty($request['user_name']) || empty($request['birth_year'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $prescription = $this->prescription->getPrescription($id);
        if (!$prescription) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        // get invoice items
        $prescription_items = $this->prescription->getPrescriptionItems($prescription['id']);
        // check invoice items
        if (!$prescription_items) {
            $this->flashMessage('error', 'فاکتور مورد نظر خالی است!');
            return;
        }

        $userId = null;

        // select and check user
        $user = $this->db->select('SELECT * FROM users WHERE user_name = ? AND birth_year = ?', [$request['user_name'], $request['birth_year']])->fetch();

        if (!$user) {
            $userData = [
                'user_name' => $request['user_name'],
                'birth_year' => $request['birth_year'],
                'father_name' => $request['father_name'] ?? null,
                'gender' => $request['gender'],
                'phone' => $request['phone'] ?? null,
            ];
            $this->db->insert('users', array_keys($userData), $userData);
            $userId = $this->db->lastInsertId();
        } else {
            $userId = $user['id'];
        }

        $newPrescription = [];
        // send notificatons
        // $this->notification->sendNotif([
        //     'branch_id' => $request['branch_id'],
        //     'user_id' => $request['seller_id'],
        //     'ref_id' => $invoice['id'],
        //     'type' => 1,
        // ]);



        // update daily reports
        // $dailyReports = [
        //     'branch_id' => $request['branch_id'],
        //     'total_price' =>  $request['total_price'],
        //     'paid_amount' => $request['paid_amount'],
        //     'discount' => $request['total_discount'],
        //     'type' => 1,
        // ];
        // $this->reports->updateDailyReports($dailyReports);

        $preInfos = [
            'patient_id' => $userId,
            'patient_name' => $request['user_name'],
            'birth_year' => $request['birth_year'],
            'bp' => $request['bp'],
            'pr' => $request['pr'],
            'rr' => $request['rr'],
            'temp' => $request['temp'],
            'spo2' => $request['spo2'],
            'status' => 2,
        ];

        $inserted = $this->db->update('prescriptions', $prescription['id'], array_keys($preInfos), $preInfos);
        $this->flashMessage('success', _success);
    }


    /////////////////// edit prescription ///////////////

    // edit employee page
    public function editPrescription($id)
    {
        $this->middleware(true, true, 'general', true);

        $prescription = $this->db->select('SELECT * FROM prescriptions WHERE id = ?', [$id])->fetch();
        $user = $this->db->select('SELECT * FROM users WHERE id = ?', [$prescription['patient_id']])->fetch();

        $intake_times = $this->db->select('SELECT intake_time FROM intake_times WHERE `status` = ?', [1])->fetchAll();

        $dosage = $this->db->select('SELECT dosage FROM dosage WHERE `status` = ?', [1])->fetchAll();

        $intakeInstructions = $this->db->select('SELECT intake_instructions FROM intake_instructions WHERE `status` = ?', [1])->fetchAll();

        $number = $this->db->select('SELECT `number` FROM number_of_drugs')->fetch();

        if ($prescription != null) {
            $drugList = $this->db->select('SELECT * FROM prescription_items WHERE `prescription_id` = ?', [$prescription['id']])->fetchAll();
            require_once(BASE_PATH . '/resources/views/app/prescriptions/edit-prescription.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }


    //    add drug in edit Prescription Store
    public function editDrugPrescriptionStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if (empty($request['drug_id']) || empty($request['drug_name'] || empty($request['drug_count']))) {
            $this->flashMessage('error', _emptyInputs);
        }

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
        $prescription_id = $this->prescription->editInvoiceConfirm($prescription);

        $prescription_items = [
            'prescription_id' => $prescription_id,
            'drug_id' => $request['drug_id'],
            'drug_name' => $request['drug_name'],
            'drug_count' => $request['drug_count'],
            'interval_time' => $request['interval_time'] ?? null,
            'dosage' => $request['dosage'] ?? null,
            'usage_instruction' => $request['usage_instruction'] ?? null,
            'description' => $request['description'] ?? null,
        ];

        $exist_item = $this->prescription->getPrescriptionItem($prescription_id, $request['drug_id']);

        if (!$exist_item) {
            $this->db->insert('prescription_items', array_keys($prescription_items), $prescription_items);
        } else {
            $this->flashMessage('error', 'داروی انتخاب شده، قبلا ثبت شده!');
        }

        $this->flashMessage('success', _success);
    }

    // edit close invoice
    public function editClosePrescriptionStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);


        if (empty($request['user_name']) || empty($request['birth_year'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $prescription = $this->prescription->getPrescription($id);
        if (!$prescription) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        // get invoice items
        $prescription_items = $this->prescription->getPrescriptionItems($prescription['id']);
        // check invoice items
        if (!$prescription_items) {
            $this->flashMessage('error', 'فاکتور مورد نظر خالی است!');
            return;
        }

        $userId = null;

        // select and check user
        $user = $this->db->select('SELECT * FROM users WHERE user_name = ? AND birth_year = ?', [$request['user_name'], $request['birth_year']])->fetch();

        if (!$user) {
            $userData = [
                'user_name' => $request['user_name'],
                'birth_year' => $request['birth_year'],
                'father_name' => $request['father_name'] ?? null,
                'gender' => $request['gender'],
                'phone' => $request['phone'] ?? null,
            ];
            $this->db->insert('users', array_keys($userData), $userData);
            $userId = $this->db->lastInsertId();
        } else {
            $userId = $user['id'];
        }

        $preInfos = [
            'patient_id' => $userId,
            'patient_name' => $request['user_name'],
            'birth_year' => $request['birth_year'],
            'bp' => $request['bp'],
            'pr' => $request['pr'],
            'rr' => $request['rr'],
            'temp' => $request['temp'],
            'spo2' => $request['spo2'],
        ];

        $inserted = $this->db->update('prescriptions', $prescription['id'], array_keys($preInfos), $preInfos);
        $this->flashMessageTo('success', _success, url('prescriptions'));
    }





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
