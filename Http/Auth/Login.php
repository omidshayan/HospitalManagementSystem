<?php

namespace Auth;

require_once 'Http/Auth/Auth.php';

use Auth\Auth;
use database\Database;

class Login extends Auth
{
    // login page
    public function login()
    {
        if ((isset($_SESSION['er_em_id']) && $_SESSION['er_em_id'] != '') || isset($_SESSION['er_em_name']) && $_SESSION['er_em_name'] != '') {
            $this->redirect('/');
            exit();
        } else {
            require_once(BASE_PATH . '/resources/views/auth/login.php');
            exit();
        }
    }

    public function checkLogin($request)
    {
        if ($request['phone'] == '' || $request['password'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $db = DataBase::getInstance();
        $user = $db->select("SELECT * FROM `employees` WHERE phone = ? ", [$request['phone']])->fetch();
        if (
            $user != null && $user > 0
        ) {
            if (password_verify($request['password'], $user['password'])) {

                if ($user['state'] == 1 && $user['role'] == 1) {
                    $_SESSION['af_em_id'] = $user['id'];
                    $_SESSION['af_em_name'] = $user['employee_name'];
                    $_SESSION['af_em_image'] = $user['image'];
                    $_SESSION['branch_id'] = $user['branch_id'];
                    $permissions = $db->select('SELECT `section_name` FROM `permissions` WHERE employee_id = ?', [$user['id']])->fetchAll();
                    $_SESSION['permissions'] = array_column($permissions, 'section_name');
                    $rand = md5(rand(0, 999999999));
                    $expiry = time() + (86400 * 30 * 6);
                    $db->update('employees', $user['id'], ['remember_token', 'expire_remember_token'], [$rand, 2]);

                    if (isset($request['remember_me']) && $request['remember_me'] == 'on') {
                        setcookie("af_user", $rand, [
                            'expires' => $expiry,
                            'path' => '/',
                            'secure' => true,
                            'httponly' => true,
                            'samesite' => 'Strict'
                        ]);
                    }

                    $this->redirect('/');
                    exit();
                } elseif ($user['state'] == 1 && $user['role'] == 2 && $user['role'] !== 1) {
                    $_SESSION['af_em_id'] = $user['id'];
                    $_SESSION['af_em_name'] = $user['employee_name'];
                    $_SESSION['admin'] = 'admin';
                    $_SESSION['role'] = 2;
                    $permissions = $db->select('SELECT `en_name` FROM `sections`')->fetchAll();
                    $_SESSION['permissions'] = array_column($permissions, 'en_name');
                    $rand = md5(rand(0, 999999999));
                    $expiry = time() + (86400 * 30 * 6);
                    $db->update('employees', $user['id'], ['remember_token', 'expire_remember_token'], [$rand, 2]);

                    if (isset($request['remember_me']) && $request['remember_me'] == 'on') {
                        setcookie("af_user", $rand, [
                            'expires' => $expiry,
                            'path' => '/',
                            'secure' => true,
                            'httponly' => true,
                            'samesite' => 'Strict'
                        ]);
                    }

                    $this->redirect('/');
                    exit();
                } else {
                    $this->flashMessage('error', 'کارمندی یافت نشد');
                }
            } else {
                $this->flashMessage('error', 'کارمندی یافت نشد');
            }
        } else {
            $this->flashMessage('error', 'کارمندی یافت نشد');
        }
    }

    public function userCheck()
    {
        $db = DataBase::getInstance();
        if (isset($_COOKIE['af_user'])) {
            $remember_token = $db->select('SELECT * FROM `employees` WHERE remember_token = ?', [$_COOKIE['af_user']])->fetch();
            if ($remember_token != null && $remember_token > 0 && $remember_token['expire_remember_token'] == 1) {
                $_SESSION['af_em_id'] = $remember_token['id'];
                $_SESSION['af_em_name'] = $remember_token['employee_name'];
                $_SESSION['af_em_image'] = $remember_token['image'];
                $permissions = $db->select('SELECT `section_name` FROM `permissions` WHERE employee_id = ?', [$remember_token['id']])->fetchAll();
            } elseif ($remember_token['state'] == 1 && $remember_token['state'] != 0 && $remember_token['role'] == 2 && $remember_token['role'] !== 1) {
                $_SESSION['af_em_id'] = $remember_token['id'];
                $_SESSION['af_em_name'] = $remember_token['employee_name'];
                $_SESSION['admin'] = 'admin';
                $_SESSION['role'] = 2;
                $permissions = $db->select('SELECT `en_name` FROM `sections`')->fetchAll();
                $_SESSION['permissions'] = array_column($permissions, 'en_name');
            }
        } else {
            $this->redirect('login');
            exit();
        }
    }
    //end check admin

    // check admin
    public function checkUser()
    {
        if (isset($_SESSION['user'])) {
            $db = DataBase::getInstance();
            $user = $db->select('SELECT * FROM al_users WHERE id = ?', [$_SESSION['user']])->fetch();
            if ($user != null) {
                if ($user['role'] != 1) {
                    $this->redirect('login');
                    exit();
                }
            } else {
                $this->redirect('login');
                exit();
            }
        } else {
            $this->redirect('login');
            exit();
        }
    }
}
