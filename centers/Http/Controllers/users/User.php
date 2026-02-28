<?php

namespace App;

require_once 'Http/Controllers/App.php';

class User extends App
{
    // add User page
    public function addUser()
    {
        $this->middleware(true, true, 'addPatient', true);
        require_once(BASE_PATH . '/resources/views/app/users/add-user.php');
        exit();
    }

    // store user
    public function userStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['user_name'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $this->validateInputs($request, ['image' => false]);

        // check image
        $this->handleImageUpload($request['image'], 'images/users');

        $this->db->insert('users', array_keys($request), $request);

        $this->flashMessage('success', _success);
    }

    // edit user page
    public function editUser($id)
    {
        $this->middleware(true, true, 'general', true);

        $user = $this->db->select('SELECT * FROM users WHERE id = ?', [$id])->fetch();
        if ($user != null) {
            require_once(BASE_PATH . '/resources/views/app/users/edit-user.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit user store
    public function editUserStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['user_name'] == '' || $request['birth_year'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $request['birth_year'] = $this->getBirthYearFromAge($request['birth_year']);

        // $existUser = $this->db->select('SELECT * FROM users WHERE `phone` = ?', [$request['phone']])->fetch();

        // if ($existUser) {
        //     if ($existUser['id'] != $id) {
        //         $this->flashMessage('error', 'شماره موبایل وارد شده قبلاً توسط کارمند دیگری ثبت شده است.');
        //         return;
        //     }
        // }

        // check upload photo
        $this->handleImageUpdate($request, 'users', $id, 'image', 'images/users', $_FILES['image']);

        $this->db->update('users', $id, array_keys($request), $request);

        $this->flashMessageTo('success', _success, url('patients'));
    }

    // user detiles page
    public function userDetails($id)
    {
        $this->middleware(true, true, 'general');
        $user = $this->db->select('SELECT * FROM users WHERE id = ?', [$id])->fetch();
        if ($user != null) {

            $prescriptions = $this->db->select(
                'SELECT p.*, e.employee_name AS doctor_name 
                FROM prescriptions p
                LEFT JOIN employees e ON p.doctor_id = e.id
                WHERE p.patient_id = ?',
                [$id]
            )->fetchAll();

            require_once(BASE_PATH . '/resources/views/app/users/user-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status user
    public function changeStatusUser($id)
    {
        $this->middleware(true, true, 'general');

        $user = $this->db
            ->select('SELECT * FROM users WHERE id = ?', [$id])
            ->fetch();

        if (!$user) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newState = ($user['status'] == 1) ? 2 : 1;

        $this->db->update('users', $user['id'], ['status'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }

    // search page
    public function searchPage()
    {
        $this->middleware(true, true, 'general', true);
        require_once(BASE_PATH . '/resources/views/app/users/search.php');
        exit();
    }

    // user search details
    public function searchUserDetails($request)
    {
        $this->middleware(true, true, 'students', true);

        $usre = $this->db->select("SELECT * FROM users WHERE `name` LIKE ?", ['%' . $request['customer_name'] . '%'])->fetchAll();

        $response = [
            'status' => 'success',
            'items' => $usre,
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // live search
    public function searchUser($request)
    {
        $this->middleware(true, true, 'general', true);

        $infos = $this->db->select("SELECT * FROM users WHERE user_name LIKE ?", ['%' . $request['customer_name'] . '%'])->fetchAll();

        $response = [
            'status' => 'success',
            'items' => $infos,
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}
