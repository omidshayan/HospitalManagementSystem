<?php

namespace App;

class Patient extends App
{
    // add employee page
    public function patients()
    {
        $this->middleware(true, true, 'showPatients', true);

        $user = $this->currentUser();

        if ($user['role'] === 'admin') {

            $users = $this->db
                ->select("SELECT u.*, COUNT(p.id) AS prescription_count FROM users u LEFT JOIN prescriptions p ON p.patient_id = u.id GROUP BY u.id ORDER BY u.id DESC")
                ->fetchAll();
        } else {
            $users = $this->db->select("
                SELECT 
                    u.*,
                    COUNT(p.id) AS prescription_count
                FROM users AS u
                INNER JOIN prescriptions AS p 
                    ON p.patient_id = u.id
                WHERE p.doctor_id = ?
                GROUP BY u.id
                ORDER BY u.id DESC
        ", [$user['id']])->fetchAll();
        }

        require_once(BASE_PATH . '/resources/views/app/users/show-users.php');
    }

    // live search
    public function liveSearchPatient($request)
    {
        $this->middleware(true, true, 'general');

        $keyword = '%' . $request['customer_name'] . '%';

        $sql = "SELECT * FROM users WHERE user_name LIKE ? LIMIT 20";
        $params = [$keyword];

        $infos = $this->db->select($sql, $params)->fetchAll();


        $response = [
            'status' => 'success',
            'items'  => $infos,
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}
