<?php

namespace App;

class Company extends App
{
    //  companies page
    public function companies()
    {
        $this->middleware(true, true, 'companies', true);
        $companies = $this->db->select('SELECT * FROM companies')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/companies/companies.php');
    }

    // store companies
    public function companyStore($request)
    {
        $this->middleware(true, true, 'companies', true, $request, true);

        if ($request['name'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $companies = $this->db->select('SELECT `name` FROM companies WHERE `name` = ?', [$request['name']])->fetch();

        if (!empty($companies['name'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('companies', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // companies page
    public function editCompany($id)
    {
        $this->middleware(true, true, 'general');

        $company = $this->db->select('SELECT * FROM companies WHERE `id` = ?', [$id])->fetch();
        if ($company != null) {
            require_once(BASE_PATH . '/resources/views/app/companies/edit-company.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit dosage store
    public function editDosageStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['dosage'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $dosage = $this->db->select('SELECT * FROM dosage WHERE `dosage` = ?', [$request['dosage']])->fetch();

        if ($dosage) {
            if ($dosage['id'] != $id) {
                $this->flashMessage('error', 'این مقدار مصرف ثبت شده است.');
                return;
            }
        }

        $this->db->update('dosage', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('dosage'));
    }

    // dosage Details detiles page
    public function dosageDetails($id)
    {
        $this->middleware(true, true, 'general');
        $dosage = $this->db->select('SELECT * FROM dosage WHERE `id` = ?', [$id])->fetch();
        if ($dosage != null) {
            require_once(BASE_PATH . '/resources/views/app/dosage/dosage-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status dosage
    public function changeStatusDosage($id)
    {
        $this->middleware(true, true, 'general');

        $dosage = $this->db->select('SELECT id, `status` FROM dosage WHERE id = ?', [$id])->fetch();
        if (!$dosage) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($dosage['status'] == 1) ? 2 : 1;

        $this->db->update('dosage', $id, ['status'], [$newStatus]);
        $this->send_json_response(true, _success, $newStatus);
    }
}
