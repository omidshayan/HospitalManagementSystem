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

        $tests = $this->db->select('SELECT id, test_name FROM tests WHERE `status` = ?', [1])->fetchAll();

        $intakeInstructions = $this->db->select('SELECT intake_instructions FROM intake_instructions WHERE `status` = ?', [1])->fetchAll();

        $number = $this->db->select('SELECT `number` FROM number_of_drugs')->fetch();

        $prescription = $this->db->select('SELECT * FROM prescriptions WHERE doctor_id = ? AND `type` = ? AND `status` = ?', [$userId['id'], 1, 1])->fetch();

        // if active admissions
        if (
            isset($_SESSION['settings']['admission']) && $_SESSION['settings']['admission'] == 1
        ) {
            $patients = $this->db->select(
                'SELECT id, patient_id, user_name, queue_number, age, `status`
            FROM admissions
            WHERE doctor_id = ?
            AND created_at >= CURDATE()
            AND created_at < CURDATE() + INTERVAL 1 DAY
            ORDER BY queue_number ASC',
                [$userId['id']]
            )->fetchAll();
        }


        if ($prescription) {

            $recommended = $this->db->select('
                SELECT 
                    r.id AS recommended_id,
                    r.recommended AS test_id,
                    t.test_name
                FROM recommended r
                JOIN tests t ON r.recommended = t.id
                WHERE r.prescription_id = ?
            ', [$prescription['id']])->fetchAll();


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

        $drugInvalid =
            empty($request['drug_id']) ||
            empty($request['drug_name']) ||
            empty($request['drug_count']);

        $hasRecommended = !empty($request['recommended']);

        if ($drugInvalid && !$hasRecommended) {
            $this->flashMessage('error', _emptyInputs);
        }

        $this->validateInputs($request);

        $yearMonth = $this->calendar->getYearMonth();

        $user_id = $this->currentUser();

        $prescription = [
            'doctor_id' => $user_id['id'],
            'type' => 1,
            'year' => $yearMonth['year'],
            'month' => $yearMonth['month'],
            'who_it' => $request['who_it'],
        ];

        $prescription_id = $this->prescription->InvoiceConfirm($prescription);

        if (!$drugInvalid) {
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
        }

        if ($hasRecommended) {
            foreach ($request['recommended'] as $recommendedId) {

                $test = $this->db->select(
                    'SELECT id FROM recommended 
                    WHERE prescription_id = ? AND recommended = ?',
                    [$prescription_id, $recommendedId]
                )->fetch();

                if (!$test) {
                    $recommendedData = [
                        'prescription_id' => $prescription_id,
                        'recommended'     => $recommendedId,
                    ];

                    $this->db->insert(
                        'recommended',
                        array_keys($recommendedData),
                        $recommendedData
                    );
                } else {
                    $this->flashMessage('error', 'آزمایش انتخاب شده، قبلاً برای این نسخه ثبت شده!');
                }
            }
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
             WHERE p.status != ? ORDER BY id DESC',
                [$status]
            )->fetchAll();
        } else {

            $prescriptions = $this->db->select(
                'SELECT p.*, e.employee_name
             FROM prescriptions p
             JOIN employees e ON e.id = p.doctor_id
             WHERE p.doctor_id = ? AND p.status != ? ORDER BY id DESC',
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
        $birth_year = $this->getBirthYearFromAge($birth_year);

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

            $tests = $this->db->select(
                'SELECT r.*, t.test_name
         FROM recommended r
         JOIN tests t ON r.recommended = t.id
         WHERE r.prescription_id = ?',
                [$prescription['id']]
            )->fetchAll();

            $preInfos = $this->db->select('SELECT * FROM prescription_settings')->fetch();
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

    // delete test from cart
    public function deleteTestItem($id)
    {
        $this->middleware(true, true, 'general', true);

        if (!is_numeric($id)) {
            $this->flashMessage('error', 'لطفا اطلاعات درست ارسال نمائید!');
        }

        $recommended = $this->db->select('SELECT id FROM recommended WHERE `id` = ?', [$id])->fetch();
        if (!$recommended) {
            require_once(BASE_PATH . '/404.php');
            exit;
        }

        $this->db->delete('recommended', $id);
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

        $prescription = $this->prescription->getPrescription($id);
        if (!$prescription) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        if ($prescription['status'] == 2) {
            $this->flashMessage('error', 'این نسخه قبلاً بسته شده است');
            return;
        }

        if (isset($_SESSION['settings']['admission']) && $_SESSION['settings']['admission'] == 1) {

            $patient = $this->db->select(
                'SELECT id, patient_id, status FROM admissions WHERE id = ?',
                [$request['admission_id']]
            )->fetch();

            if (!$patient) {
                $this->flashMessage('error', 'پذیرش معتبر نیست');
                return;
            }

            if ($patient['status'] == 2) {
                $this->flashMessage('error', 'این مریض قبلاً ویزیت شده است');
                return;
            }

            $user = $this->db->select(
                'SELECT * FROM users WHERE id = ?',
                [$patient['patient_id']]
            )->fetch();

            if (!$user) {
                $this->flashMessage('error', 'مریض یافت نشد');
                return;
            }

            $preInfos = [
                'patient_id'   => $user['id'],
                'patient_name' => $user['user_name'],
                'birth_year'   => $user['birth_year'],
                'admission_id' => $patient['id'],
                'diagnosis'    => $request['diagnosis'],
                'bp'           => $request['bp'],
                'pr'           => $request['pr'],
                'rr'           => $request['rr'],
                'temp'         => $request['temp'],
                'spo2'         => $request['spo2'],
                'status'       => 2,
            ];

            $this->db->update(
                'admissions',
                $patient['id'],
                ['status'],
                [2]
            );

            $this->db->update(
                'prescriptions',
                $prescription['id'],
                array_keys($preInfos),
                $preInfos
            );
        } else {

            if (empty($request['user_name']) || empty($request['birth_year'])) {
                $this->flashMessage('error', _emptyInputs);
                return;
            }

            $user = $this->db->select(
                'SELECT * FROM users WHERE user_name = ? AND birth_year = ?',
                [$request['user_name'], $request['birth_year']]
            )->fetch();

            if (!$user) {
                $userData = [
                    'user_name'   => $request['user_name'],
                    'birth_year'  => $request['birth_year'],
                    'father_name' => $request['father_name'] ?? null,
                    'gender'      => $request['gender'],
                    'phone'       => $request['phone'] ?? null,
                    'who_it'      => $request['who_it'],
                ];

                $this->db->insert('users', array_keys($userData), $userData);
                $userId = $this->db->lastInsertId();
            } else {
                $userId = $user['id'];
            }

            $preInfos = [
                'patient_id'   => $userId,
                'patient_name' => $request['user_name'],
                'birth_year'   => $request['birth_year'],
                'diagnosis'    => $request['diagnosis'],
                'bp'           => $request['bp'],
                'pr'           => $request['pr'],
                'rr'           => $request['rr'],
                'temp'         => $request['temp'],
                'spo2'         => $request['spo2'],
                'status'       => 2,
            ];

            $this->db->update(
                'prescriptions',
                $prescription['id'],
                array_keys($preInfos),
                $preInfos
            );
        }

        $settings = $this->db->select('SELECT single_print FROM settings')->fetch();

        if ($settings['single_print'] == 1) {
            $this->flashMessageId('success', _success, $prescription['id']);
        } else {
            $this->flashMessage('success', _success);
        }
    }

    // single print
    public function singlePrint($id)
    {
        $this->middleware(true, true, 'prescriptionPrint', true);

        $prescription = $this->db->select('SELECT * FROM prescriptions WHERE doctor_id = ? AND `type` = ? AND `status` = ?', [$id, 1, 1])->fetch();

        $print = '';
        $prescriptionPrintl = $this->db->select(
            'SELECT p.*, 
                e.employee_name,
                e.expertise
         FROM prescriptions p
         JOIN employees e ON e.id = p.doctor_id
         WHERE  p.id = ?',
            [$id]
        )->fetch();

        $items = [];

        if ($prescriptionPrintl) {
            $items = $this->db->select(
                'SELECT *
         FROM prescription_items
         WHERE prescription_id = ?
         ORDER BY id ASC',
                [$prescriptionPrintl['id']]
            )->fetchAll();

            $testsp = $this->db->select(
                'SELECT r.*, t.test_name
         FROM recommended r
         JOIN tests t ON r.recommended = t.id
         WHERE r.prescription_id = ?',
                [$prescriptionPrintl['id']]
            )->fetchAll();
        }

        $drugCategories = $this->db->select('SELECT * FROM drug_categories WHERE `status` = ?', [1])->fetchAll();

        $intake_times = $this->db->select('SELECT intake_time FROM intake_times WHERE `status` = ?', [1])->fetchAll();

        $dosage = $this->db->select('SELECT dosage FROM dosage WHERE `status` = ?', [1])->fetchAll();

        $tests = $this->db->select('SELECT id, test_name FROM tests WHERE `status` = ?', [1])->fetchAll();

        $intakeInstructions = $this->db->select('SELECT intake_instructions FROM intake_instructions WHERE `status` = ?', [1])->fetchAll();

        $number = $this->db->select('SELECT `number` FROM number_of_drugs')->fetch();

        $recommended = $this->db->select('
                SELECT 
                    r.id AS recommended_id,
                    r.recommended AS test_id,
                    t.test_name
                FROM recommended r
                JOIN tests t ON r.recommended = t.id
                WHERE r.prescription_id = ?
            ', [$prescriptionPrintl['id']])->fetchAll();


        $drugListPre = $this->db->select('SELECT * FROM prescription_items WHERE `prescription_id` = ?', [$prescriptionPrintl['id']])->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/prescriptions/add-prescription.php');
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

        $tests = $this->db->select('SELECT id, test_name FROM tests WHERE `status` = ?', [1])->fetchAll();

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
        $prescription = $this->db->select('SELECT id FROM prescriptions WHERE `id` = ?', [$id])->fetch();

        $prescription_items = [
            'prescription_id' => $prescription['id'],
            'drug_id' => $request['drug_id'],
            'drug_name' => $request['drug_name'],
            'drug_count' => $request['drug_count'],
            'interval_time' => $request['interval_time'] ?? null,
            'dosage' => $request['dosage'] ?? null,
            'usage_instruction' => $request['usage_instruction'] ?? null,
            'description' => $request['description'] ?? null,
        ];

        $exist_item = $this->prescription->getPrescriptionItem($prescription['id'], $request['drug_id']);

        if (!$exist_item) {
            $this->db->insert('prescription_items', array_keys($prescription_items), $prescription_items);
        } else {
            $this->flashMessage('error', 'داروی انتخاب شده، قبلا ثبت شده!');
        }

        $this->flashMessage('success', _success);
    }

    // NOTE باگ قسمت ویرایش سن وجود داره
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
        dd('ok');
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
