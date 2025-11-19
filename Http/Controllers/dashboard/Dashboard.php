<?php

namespace App;

require_once 'Http/Controllers/App.php';

use database\DataBase;

class Dashboard extends App
{
    public function index()
    {
        $this->db = DataBase::getInstance();
        if (isset($_SESSION['af_em_id'])) {
            $user = $this->db->select('SELECT * FROM `employees` WHERE id = ?', [$_SESSION['af_em_id']])->fetch();
        }
        require_once(BASE_PATH . '/resources/views/app/dashboard/index.php');

    }
}
