<?php

namespace Auth;

use Auth\Auth;
use database\Database;

class Logout extends Auth
{
    public function logout()
    {
        $db = DataBase::getInstance();
        if (isset($_SESSION['hsm_em_id'])) {
            // به‌روزرسانی وضعیت توکن در دیتابیس
            $db->update('employees', $_SESSION['hsm_em_id'], ['expire_remember_token', 'remember_token'], [0, null]);
            unset($_SESSION['hsm_em_id']);
            unset($_SESSION['hsm_em_name']);
            unset($_SESSION['hsm_em_image']);
            unset($_SESSION['permissions']);
            unset($_SESSION['admin']);

            session_destroy();

            $expiry = time() - 3600;
            setcookie("hsm_user", '', $expiry, '/', '', true, true);

            $this->redirect('login');
            exit();
        }

        $this->redirect('login');
        exit();
    }

}
