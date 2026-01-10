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

        $drugTypes = $this->db->select('SELECT id, drug_type FROM drug_types WHERE `status` = ?', [1])->fetchAll();

        $intakeInstructions = $this->db->select('SELECT intake_instructions FROM intake_instructions WHERE `status` = ?', [1])->fetchAll();

        $number = $this->db->select('SELECT `number` FROM number_of_drugs')->fetch();

        $companies = $this->db->select('SELECT `name` FROM companies WHERE `status` = 1')->fetchAll();

        $prescription = $this->db->select('SELECT * FROM prescriptions WHERE doctor_id = ? AND `type` = ? AND `status` = ?', [$userId['id'], 1, 1])->fetch();

        // get today prescriptions
        $prescriptions = $this->db->select(
            'SELECT 
                p.*,
                e.employee_name
            FROM prescriptions AS p
            INNER JOIN employees AS e ON e.id = p.doctor_id
            WHERE p.doctor_id = ? AND `status` = ?
            AND DATE(p.created_at) = CURDATE()',
            [$userId['id'], 2]
        )->fetchAll();
        // dd($prescriptions);


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
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        $this->middleware(true, true, 'general', true);

        $drugInvalid =
            empty($request['drug_id']) ||
            empty($request['drug_name']);

        $hasRecommended = !empty($request['recommended']);

        // if ($drugInvalid && !$hasRecommended) {
        //     $this->flashMessage('error', _emptyInputs);
        // }
        if ($drugInvalid && !$hasRecommended) {
            if ($isAjax) {
                $this->jsonResponse('error', _emptyInputs);
            }
            $this->flashMessage('error', _emptyInputs);
        }

        $this->validateInputs($request);

        $yearMonth = $this->calendar->getYearMonth();

        $userInfo = $this->currentUser();

        $prescription = [
            'doctor_id' => $userInfo['id'],
            'type' => 1,
            'year' => $yearMonth['year'],
            'month' => $yearMonth['month'],
            'who_it' => $userInfo['name'],
        ];

        $prescription_id = $this->prescription->InvoiceConfirm($prescription);

        if (!$drugInvalid) {
            $prescription_items = [
                'prescription_id' => $prescription_id,
                'drug_id' => $request['drug_id'],
                'drug_type' => $request['drug_type'],
                'drug_name' => $request['drug_name'],
                'drug_count' => $request['drug_count'] ?? null,
                'interval_time' => $request['interval_time'] ?? null,
                'dosage' => $request['dosage'] ?? null,
                'company' => $request['company'] ?? null,
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

        // $this->flashMessage('success', _success);
        if ($isAjax) {
            $this->jsonResponse('success', _success, [
                'prescription_id' => $prescription_id
            ]);
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
                LEFT JOIN employees e ON e.id = p.doctor_id
                WHERE p.status != ?
                ORDER BY p.id DESC',
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

    // show Prescription Item
    public function showPrescriptionItem($id)
    {
        $this->middleware(true, true, 'prescriptionPrint', true);

        $prescrption_change = $this->db->select('SELECT * FROM settings')->fetch();

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

        $settings = $this->db->select('SELECT * FROM settings')->fetch();

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
                $this->flashMessage('error', 'مریض یافت نشد');
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
                'clinical_findings'    => $request['clinical_findings'],
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
                'clinical_findings'    => $request['clinical_findings'],
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

        $companies = $this->db->select('SELECT `name` FROM companies WHERE `status` = 1')->fetchAll();

        if ($prescription != null) {

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

        if (!$drugInvalid) {
            $prescription_items = [
                'prescription_id' => $prescription['id'],
                'drug_id' => $request['drug_id'],
                'drug_name' => $request['drug_name'],
                'drug_count' => $request['drug_count'],
                'interval_time' => $request['interval_time'] ?? null,
                'dosage' => $request['dosage'] ?? null,
                'company' => $request['company'] ?? null,
                'usage_instruction' => $request['usage_instruction'] ?? null,
                'description' => $request['description'] ?? null,
            ];

            $exist_item = $this->prescription->getPrescriptionItem($prescription['id'], $request['drug_id']);

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
                    [$id, $recommendedId]
                )->fetch();

                if (!$test) {
                    $recommendedData = [
                        'prescription_id' => $id,
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

    // edit close invoice
    public function editClosePrescriptionStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);


        // if (empty($request['user_name']) || empty($request['birth_year'])) {
        //     $this->flashMessage('error', _emptyInputs);
        // }

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
        $user = $this->db->select('SELECT * FROM users WHERE id = ?', [$prescription['patient_id']])->fetch();

        if (!$user) {
            $this->flashMessage('error', 'مریض مورد نظر معتبر نیست!');
        } else {

            $oldUserInfos = [
                'user_name' => $user['user_name'],
                'birth_year' => $user['birth_year'],
                'father_name' => $user['father_name'],
                'gender' => $user['gender'],
                'phone' => $user['phone'],
            ];
            $thisUserInfos = [
                'user_name' => $request['user_name'],
                'birth_year' => $request['birth_year'],
                'father_name' => $request['father_name'],
                'gender' => $request['gender'],
                'phone' => $request['phone'],
            ];

            if ($oldUserInfos != $thisUserInfos) {
                $this->db->update('users', $user['id'], array_keys($thisUserInfos), $thisUserInfos);
            }

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
            'diagnosis' => $request['diagnosis'],
            'edited' => 1,
        ];

        $this->db->update('prescriptions', $prescription['id'], array_keys($preInfos), $preInfos);
        $this->flashMessageTo('success', _success, url('prescriptions'));
    }
}
