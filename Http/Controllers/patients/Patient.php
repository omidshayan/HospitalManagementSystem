<?php

namespace App;

class Patient extends App
{

    // add employee page
    public function patients()
    {
        $this->middleware(true, true, 'showPatients', true);

        $user = $this->currentUser();

        if ($user['role'] === 'admin') {

            $users = $this->db
                ->select("SELECT u.*, COUNT(p.id) AS prescription_count FROM users u LEFT JOIN prescriptions p ON p.patient_id = u.id GROUP BY u.id ORDER BY u.id DESC")
                ->fetchAll();
        } else {

            $users = $this->db
                ->select("SELECT u.*, COUNT(p.id) AS prescription_count FROM users u LEFT JOIN prescriptions p ON p.patient_id = u.id WHERE u.doctor_id = ? GROUP BY u.id ORDER BY u.id DESC", $user['id'])
                ->fetchAll();
        }

        require_once(BASE_PATH . '/resources/views/app/users/show-users.php');
    }

    // live search
    public function liveSearchPatient($request)
    {
        $this->middleware(true, true, 'general');

        $keyword = '%' . $request['customer_name'] . '%';
        $branchId = $this->getBranchId();

        if ($branchId === 'ALL') {
            $sql = "SELECT * FROM products WHERE product_name LIKE ? LIMIT 20";
            $params = [$keyword];
        } else {
            $sql = "SELECT * FROM products WHERE product_name LIKE ? AND branch_id = ? LIMIT 20";
            $params = [$keyword, $branchId];
        }

        $infos = $this->db->select($sql, $params)->fetchAll();

        $response = [
            'status' => 'success',
            'items'  => $infos,
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }












    // store employee
    public function employeeStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);
        // check empty form
        if ($request['employee_name'] == '' || $request['password'] == '' || $request['phone'] == '' || !isset($request['position'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $existingEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();
        if ($existingEmployee) {
            $this->flashMessage('error', _phone_repeat);
        } else {
            if (!isset($request['password']) || strlen(trim($request['password'])) < 6) {
                $this->flashMessage('error', 'رمز عبور باید حداقل 6 کاراکتر داشته باشد.');
            }

            $request = $this->validateInputs($request, ['image' => false]);
            $request['password'] = $this->hash($request['password']);

            // check image
            $this->handleImageUpload($request['image'], 'images/employees');

            $this->db->insert('employees', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // edit employee page
    public function editEmployee($id)
    {
        $this->middleware(true, true, 'general', true);

        $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$id])->fetch();
        $positions = $this->db->select('SELECT * FROM positions')->fetchAll();
        $sections = $this->db->select('SELECT * FROM sections WHERE `section_id` IS NULL ORDER BY id ASC')->fetchAll();
        $permissions = $this->db->select('SELECT * FROM permissions WHERE employee_id = ?', [$id])->fetchAll();
        if ($employee != null) {
            require_once(BASE_PATH . '/resources/views/app/employees/edit-employee.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit employee store
    public function editEmployeeStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['employee_name'] == '' || $request['phone'] == '' || !isset($request['position'])) {
            $this->flashMessage('error', _emptyInputs);
        }

        $existEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();

        if ($existEmployee) {
            if ($existEmployee['id'] != $existEmployee['id']) {
                $this->flashMessage('error', 'شماره موبایل وارد شده قبلاً توسط کارمند دیگری ثبت شده است.');
                return;
            }
        }

        // check upload photo
        $max_file_size = 1048576;
        if (is_uploaded_file($request['image']['tmp_name'])) {
            if ($request['image']['size'] > $max_file_size) {
                $this->flashMessage('error', 'حجم عکس نباید بیشتر از 1 mb باشد');
            } else {
                $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$existEmployee['id']])->fetch();
                $this->removeImage('public/images/employees/' . $employee['image']);
                $request['image'] = $this->saveImage($request['image'], 'images/employees');
            }
        } else {
            unset($request['image']);
        }

        $this->db->update('employees', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('employees'));
    }

    // show employees
    public function showEmployees()
    {
        $this->middleware(true, true, 'general');
        $employees = $this->db->select('SELECT * FROM employees ORDER BY id DESC')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/employees/show-employees.php');
        exit();
    }

    // change status employee
    public function changeStatus($id)
    {
        $this->middleware(true, true, 'general');

        $employee = $this->db
            ->select('SELECT * FROM employees WHERE id = ?', [$id])
            ->fetch();

        if (!$employee) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newState = ($employee['state'] == 1) ? 2 : 1;

        $this->db->update('employees', $employee['id'], ['state'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }


    // employee detiles page
    public function employeeDetails($id)
    {
        $this->middleware(true, true, 'general');
        $employee = $this->db->select('SELECT * FROM employees WHERE id = ?', [$id])->fetch();
        if ($employee) {
            require_once(BASE_PATH . '/resources/views/app/employees/employee-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }
}
