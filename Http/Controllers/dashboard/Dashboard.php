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
        $sevenDaysAgo = date('Y-m-d', strtotime('-6 days')); // 6 روز قبل از امروز (شامل امروز 7 روز میشه)

        // گرفتن نسخه‌های 7 روز گذشته
                $prescriptionsLast7Days = $this->db->select("
            SELECT DATE(created_at) as date, COUNT(*) as count
            FROM prescriptions
            WHERE DATE(created_at) BETWEEN ? AND ?
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at) ASC
        ", [$sevenDaysAgo, $today])->fetchAll();


        require_once(BASE_PATH . '/resources/views/app/dashboard/index.php');
    }
}
