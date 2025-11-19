<?php

namespace Auth;

use Auth\Auth;
use database\Database;

class Logout extends Auth
{
    public function logout()
    {
        $db = DataBase::getInstance();
        if (isset($_SESSION['er_em_id'])) {
            // به‌روزرسانی وضعیت توکن در دیتابیس
            $db->update('employees', $_SESSION['er_em_id'], ['expire_remember_token', 'remember_token'], [0, null]);
            unset($_SESSION['er_em_id']);
            unset($_SESSION['er_em_name']);
            unset($_SESSION['er_em_image']);
            unset($_SESSION['permissions']);
            unset($_SESSION['admin']);

            session_destroy();

            // حذف کوکی‌ها
            $expiry = time() - 3600; // یک ساعت پیش
            setcookie("er_em_co", '', $expiry, '/', '', true, true); // حذف کوکی

            // هدایت به صفحه لاگین
            $this->redirect('login');
            exit();
        }

        // در صورت عدم وجود سشن، هدایت به صفحه لاگین
        $this->redirect('login');
        exit();
    }

}
