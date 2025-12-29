<?php

namespace App;

class Admission extends App
{
    // Admission create
    public function admissionCreate()
    {
        $this->middleware(true, true, 'general', true);

        $doctors = $this->db->select(
            'SELECT id, employee_name 
         FROM employees 
         WHERE position = ? AND `state` = ?',
            ['داکتر', 1]
        )->fetchAll();

        $todayAdmissions = $this->db->select(
            'SELECT doctor_id, COUNT(*) AS total
         FROM admissions
         WHERE DATE(created_at) = CURDATE()
         GROUP BY doctor_id'
        )->fetchAll();

        $waitingAdmissions = $this->db->select(
            'SELECT doctor_id, COUNT(*) AS waiting_total
         FROM admissions
         WHERE DATE(created_at) = CURDATE() AND status = 1
         GROUP BY doctor_id'
        )->fetchAll();

        $doctorQueues = [];
        foreach ($todayAdmissions as $row) {
            $doctorQueues[$row['doctor_id']]['total'] = $row['total'];
        }

        foreach ($waitingAdmissions as $row) {
            $doctorQueues[$row['doctor_id']]['waiting'] = $row['waiting_total'];
        }

        foreach ($doctors as &$doctor) {
            $doctorId = $doctor['id'];
            $doctor['total_admissions'] = $doctorQueues[$doctorId]['total'] ?? 0;
            $doctor['waiting_admissions'] = $doctorQueues[$doctorId]['waiting'] ?? 0;
        }
        unset($doctor);

        require_once(BASE_PATH . '/resources/views/app/admissions/admission-create.php');
    }

    // store employee
    public function admissionStore($request)
    {
        $this->middleware(true, true, 'general', true);

        $user = $this->currentUser();


        $doctor = $this->db->select('SELECT id, department_id FROM employees WHERE id = ? AND `state` = ?', [$request['doctor_id'], 1])->fetch();
        if (!$doctor) {
            $this->flashMessage('error', 'دکتر یافت نشد');
            return;
        }


        $department = $this->db->select('SELECT id FROM departments WHERE id = ? AND `status` = ?', [$doctor['department_id'], 1])->fetch();
        if (!$department) {
            $this->flashMessage('error', 'داکتر مورد نظر، در هیچ دپارتمنتی ثبت نیست');
            return;
        }

        if ($request['user_id']) {

            $userInfos = $this->db->select('SELECT birth_year FROM users WHERE id = ?', [$request['user_id']])->fetch();
            $age = $this->getAge($userInfos['birth_year']);

            $adminssionData = [
                'patient_id' => $request['user_id'],
                'user_name' => $request['patient_name'],
                'age' => $age,
                'doctor_id' => $doctor['id'],
                'queue_number' => $request['queue_number'] ?? null,
                'department_id' => $department['id'],
                'who_it' => $user['name'],
            ];
            $this->db->insert('admissions', array_keys($adminssionData), $adminssionData);

            $this->flashMessage('success', _success);
        } else {

            // check empty form
            if ($request['user_name'] == '' || $request['birth_year'] == '' || $request['doctor_id'] == '' || $request['queue_number'] == '') {
                $this->flashMessage('error', _emptyInputs);
            }

            $userData = [
                'user_name' => $request['user_name'],
                'birth_year' => $request['birth_year'],
                'father_name' => $request['father_name'] ?? null,
                'gender' => $request['gender'],
                'phone' => $request['phone'] ?? null,
                'description' => $request['description'] ?? null,
                'who_it' => $user['name'],
            ];
            $this->db->insert('users', array_keys($userData), $userData);
            $userId = $this->db->lastInsertId();

            $adminssionData = [
                'patient_id' => $userId,
                'user_name' => $request['user_name'],
                'age' => $request['age'],
                'doctor_id' => $request['doctor_id'],
                'queue_number' => $request['queue_number'] ?? null,
                'department_id' => $doctor['department_id'],
                'who_it' => $user['name'],
            ];

            $this->db->insert('admissions', array_keys($adminssionData), $adminssionData);

            $this->flashMessage('success', _success);
        }
    }

    // show admissions
    public function showDrugs()
    {
        $this->middleware(true, true, 'admissions');
        $admissions = $this->db->select('SELECT * FROM admissions ORDER BY id DESC')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/admissions/admissions.php');
        exit();
    }
















    // edit drug page
    public function editDrug($id)
    {
        $this->middleware(true, true, 'general', true);

        $drug = $this->db->select('SELECT * FROM drugs WHERE id = ?', [$id])->fetch();
        $drugCategories = $this->db->select('SELECT * FROM drug_categories WHERE `status` = ?', [1])->fetchAll();
        $units = $this->db->select('SELECT * FROM units WHERE `status` = ?', [1])->fetchAll();
        if ($drug != null) {
            require_once(BASE_PATH . '/resources/views/app/drugs/edit-drug.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit employee store
    public function editDrugStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['name'] == '' || $request['category_id'] == '' || $request['unit'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $existDrug = $this->db->select(
            'SELECT id FROM drugs WHERE name = ? AND id != ? LIMIT 1',
            [$request['name'], $id]
        )->fetch();

        if ($existDrug) {
            $this->flashMessage('error', 'نام وارد شده قبلاً ثبت شده است.');
            return;
        }

        // check upload photo
        $this->updateImageUpload($request, 'image', 'drugs', 'drugs', $id);

        $this->db->update('drugs', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('drugs'));
    }

    // drug detiles page
    public function drugDetails($id)
    {
        $this->middleware(true, true, 'general');

        $drug = $this->db->select("
            SELECT 
                d.*, 
                c.cat_name,
                u.unit_name
            FROM drugs d
            LEFT JOIN drug_categories c ON d.category_id = c.id
            LEFT JOIN units u ON d.unit = u.id
            WHERE d.id = ?
            LIMIT 1
        ", [$id])->fetch();

        if ($drug) {
            require_once(BASE_PATH . '/resources/views/app/drugs/drug-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status drug
    public function changeDrugStatus($id)
    {
        $this->middleware(true, true, 'general');

        $drug = $this->db
            ->select('SELECT * FROM drugs WHERE id = ?', [$id])
            ->fetch();

        if (!$drug) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newState = ($drug['status'] == 1) ? 2 : 1;

        $this->db->update('drugs', $drug['id'], ['status'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }
}
