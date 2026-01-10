<?php

namespace App;

require_once 'Http/Controllers/App.php';

class Profile extends App
{
    // profile page
    public function profile()
    {
        $this->middleware(true, true, 'general', true);
        $id = $this->currentUser();
        $profile = $this->db->select('SELECT * FROM employees WHERE id = ?', [$id['id']])->fetch();

        $today = date('Y-m-d');
        $sevenDaysAgo = date('Y-m-d', strtotime('-6 days'));

        $prescriptionsLast7Days = $this->db->select("
            SELECT DATE(created_at) as date, COUNT(*) as count
            FROM prescriptions
            WHERE doctor_id = ? AND DATE(created_at) BETWEEN ? AND ?
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at) ASC
        ", [$id['id'], $sevenDaysAgo, $today])->fetchAll();

        $dates = [];
        for ($i = 6; $i >= 0; $i--) {
            $dates[] = date('Y-m-d', strtotime("-$i days"));
        }

        $data = array_fill_keys($dates, 0);

        foreach ($prescriptionsLast7Days as $row) {
            $data[$row['date']] = (int)$row['count'];
        }

        $totalPrescriptions = $this->db->select("
                SELECT COUNT(*) as total
                FROM prescriptions
                WHERE doctor_id = ?
            ", [$id['id']])->fetchColumn();

        require_once(BASE_PATH . '/resources/views/app/profile/profile.php');
    }

    // change password
    public function changePasswordStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request);
        $id = $this->currentUser();

        if (!isset($id['id']) || !isset($id['name'])) {
            $this->redirect('login');
            exit();
        } else {
            if (empty($request['oldPassword']) || empty($request['newPassword']) || empty($request['newPasswordR'])) {
                $this->flashMessage('error', 'لطفا تمام قسمت های ضروری را وارد نمائید!');
            }
            if (strlen($request['newPassword']) < 6) {
                $this->flashMessage('error', 'تعداد کاراکترهای رمزعبور حداقل باید 6 کاراکتر باشد!');
            }

            if ($request['newPassword'] === $request['newPasswordR']) {
                $usre_id = $id['id'];
                $request = $this->validateInputs($request);
                $user = $this->db->select('SELECT * FROM employees WHERE id =?', [$usre_id])->fetch();
                if (
                    $user && password_verify($request['oldPassword'], $user['password'])
                ) {
                    $request['newPassword'] = $this->hash($request['newPassword']);
                    $this->db->update('employees', $usre_id, ['password'], [$request['newPassword']]);
                    $this->flashMessage('success', 'رمزعبور شما با موفقیت تغییر کرد');
                } else {
                    $this->flashMessage('error', 'رمزعبور فعلی درست نمی باشد!');
                }
            } else {
                $this->flashMessage('error', 'رمزعبور وارد شده با تکرار آن درست نمی باشد!');
            }
        }
    }

    // edit profile store
    public function changeProfileInfosStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['employee_name'] == '' || $request['phone'] == '') {
            $this->flashMessage('error', _emptyInputs);
            return;
        }

        $existEmployee = $this->db->select('SELECT * FROM employees WHERE `phone` = ?', [$request['phone']])->fetch();
        if ($existEmployee && $existEmployee['id'] != $id) {
            $this->flashMessage('error', 'شماره موبایل وارد شده قبلاً توسط کارمند دیگری ثبت شده است.');
            return;
        }

        $infos = [
            'employee_name' => $request['employee_name'],
            'phone' => $request['phone'],
        ];
        $this->db->update('employees', $id, array_keys($infos), $infos);
        $this->flashMessage('success', _success);
    }
}
