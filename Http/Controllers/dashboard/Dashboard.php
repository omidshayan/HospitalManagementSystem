<?php

namespace App;

require_once 'Http/Controllers/App.php';

class Dashboard extends App
{
    public function index()
    {
        $this->middleware(true, true, 'dashboard', true);

        $userId = $_SESSION['hms_employee']['id']
            ?? $_SESSION['hms_admin']['id']
            ?? null;

        if (!$userId) {
            $this->redirect('logout');
            exit();
        }

        $user = $this->db->select(
            'SELECT * FROM employees WHERE id = ?',
            [$userId]
        )->fetch();

        $today = date('Y-m-d');
        $sevenDaysAgo = date('Y-m-d', strtotime('-6 days'));
        $prescriptionsLast7Days = $this->db->select("
            SELECT DATE(created_at) as date, COUNT(*) as count
            FROM prescriptions
            WHERE DATE(created_at) BETWEEN ? AND ?
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at) ASC
        ", [$sevenDaysAgo, $today])->fetchAll();

        $dates = [];
        for ($i = 6; $i >= 0; $i--) {
            $dates[] = date('Y-m-d', strtotime("-$i days"));
        }
        $data = array_fill_keys($dates, 0);
        foreach ($prescriptionsLast7Days as $row) {
            $data[$row['date']] = (int)$row['count'];
        }


$prescriptionsByGender = $this->db->select("
    SELECT 
        DATE(prescriptions.created_at) as date, 
        users.gender, 
        COUNT(*) as count
    FROM prescriptions
    LEFT JOIN users ON prescriptions.patient_id = users.id
    WHERE DATE(prescriptions.created_at) BETWEEN ? AND ?
    GROUP BY DATE(prescriptions.created_at), users.gender
    ORDER BY DATE(prescriptions.created_at) ASC
", [$sevenDaysAgo, $today])->fetchAll();


        $dates = [];
        for ($i = 6; $i >= 0; $i--) {
            $dates[] = date('Y-m-d', strtotime("-$i days"));
        }

        $dataMale = array_fill_keys($dates, 0);
        $dataFemale = array_fill_keys($dates, 0);

        foreach ($prescriptionsByGender as $row) {
            if ($row['gender'] === 'آقا') {
                $dataMale[$row['date']] = (int)$row['count'];
            } elseif ($row['gender'] === 'خانم') {
                $dataFemale[$row['date']] = (int)$row['count'];
            }
        }

        require_once(BASE_PATH . '/resources/views/app/dashboard/index.php');
    }
}
