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

    // edit Company store
    public function editCompanyStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['name'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $company = $this->db->select('SELECT * FROM companies WHERE `name` = ?', [$request['name']])->fetch();

        if ($company) {
            if ($company['id'] != $id) {
                $this->flashMessage('error', 'این تولید کننده قبلا ثبت شده است.');
                return;
            }
        }

        $this->db->update('companies', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('companies'));
    }

    // company Details detiles page
    public function companyDetails($id)
    {
        $this->middleware(true, true, 'general');
        $company = $this->db->select('SELECT * FROM companies WHERE `id` = ?', [$id])->fetch();
        if ($company != null) {
            require_once(BASE_PATH . '/resources/views/app/companies/company-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status company
    public function changeStatusCompany($id)
    {
        $this->middleware(true, true, 'general');

        $company = $this->db->select('SELECT id, `status` FROM companies WHERE id = ?', [$id])->fetch();
        if (!$company) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($company['status'] == 1) ? 2 : 1;

        $this->db->update('companies', $id, ['status'], [$newStatus]);
        $this->send_json_response(true, _success, $newStatus);
    }
}
