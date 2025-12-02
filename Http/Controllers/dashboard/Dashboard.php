<?php

namespace App;

require_once 'Http/Controllers/App.php';

use database\DataBase;

class Dashboard extends App
{
    public function index()
    {
        $this->middleware(true, true, 'general', true);

        $userId = $_SESSION['hms_employee']['id']
            ?? $_SESSION['hms_admin']['id']
            ?? null;

        // if (!$userId) {
        //     $this->redirect('logout');
        //     exit();
        // }

        $user = $this->db->select(
            'SELECT * FROM employees WHERE id = ?',
            [$userId]
        )->fetch();

        $total = $this->db->select(
            'SELECT COUNT(*) as cnt
         FROM notifications
         WHERE read_at IS NULL
         AND user_id = ?
         AND DATE(created_at) = CURDATE()',
            [$userId]
        )->fetch();

        $reports = $this->db->select(
            'SELECT id, msg
         FROM notifications
         WHERE read_at IS NULL
         AND user_id = ?
         AND DATE(created_at) = CURDATE()
         ORDER BY id DESC
         LIMIT 10',
            [$userId]
        )->fetchAll();

        $expences = $this->db->select(
            'SELECT *
         FROM expenses
         WHERE DATE(created_at) = CURDATE()
         LIMIT 10'
        )->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/dashboard/index.php');
    }
}
