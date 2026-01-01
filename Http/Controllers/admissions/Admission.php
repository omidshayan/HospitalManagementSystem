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
    public function admissions()
    {
        $this->middleware(true, true, 'showAdmissions');
        $admissions = $this->db->select("
            SELECT a.*, e.employee_name
            FROM admissions a
            LEFT JOIN employees e ON a.doctor_id = e.id
            WHERE DATE(a.created_at) = CURDATE()
            ORDER BY a.id DESC
        ")->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/admissions/admissions.php');
        exit();
    }
}
