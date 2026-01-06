<?php

namespace App;

require_once 'Http/Controllers/App.php';

class Dashboard extends App
{
    public function index()
    {
        $hard = $this->blockSystem();

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

        // use drugs
        $topDrugs = $this->db->select("
        SELECT
            pi.drug_name,
            SUM(pi.drug_count) AS total_count
        FROM prescription_items pi
        LEFT JOIN prescriptions p ON p.id = pi.prescription_id
        WHERE DATE(p.created_at) BETWEEN ? AND ?
        GROUP BY pi.drug_name
        ORDER BY total_count DESC
        LIMIT 7
    ", [$sevenDaysAgo, $today])->fetchAll();

        $drugNames = [];
        $drugCounts = [];

        foreach ($topDrugs as $drug) {
            $drugNames[] = $drug['drug_name'];
            $drugCounts[] = (int)$drug['total_count'];
        }


        $totalUsers = $this->db->select("SELECT COUNT(*) AS total_users FROM users")->fetch();
        $totalPrescriptions = $this->db->select("SELECT COUNT(*) AS total_prescriptions FROM prescriptions")->fetch();
        $totalDrugs = $this->db->select("SELECT COUNT(*) AS total_drugs FROM drugs")->fetch();

        require_once(BASE_PATH . '/resources/views/app/dashboard/index.php');
    }
}
