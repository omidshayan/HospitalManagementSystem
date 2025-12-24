<?php

namespace App;

class Admission extends App
{
    // Admission create
    public function admissionCreate()
    {
        $this->middleware(true, true, 'general', true);

        // داکترها
        $doctors = $this->db->select(
            'SELECT id, employee_name 
         FROM employees 
         WHERE position = ? AND `state` = ?',
            ['داکتر', 1]
        )->fetchAll();

        // تعداد پذیرش‌های امروز برای هر داکتر
        $todayAdmissions = $this->db->select(
            'SELECT doctor_id, COUNT(*) AS total
         FROM admissions
         WHERE DATE(admission_date) = CURDATE()
         GROUP BY doctor_id'
        )->fetchAll();

        // تبدیل به آرایه قابل استفاده
        $doctorQueues = [];
        foreach ($todayAdmissions as $row) {
            $doctorQueues[$row['doctor_id']] = $row['total'];
        }

        require_once(BASE_PATH . '/resources/views/app/admissions/admission-create.php');
    }


    // store employee
    public function admissionStore($request)
    {
        dd($request);
        $this->middleware(true, true, 'addDrug', true, $request, true);

        // check empty form
        if ($request['name'] == '' || $request['category_id'] == '' || $request['unit'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $existingDrug = $this->db->select('SELECT * FROM drugs WHERE `name` = ?', [$request['name']])->fetch();
        if ($existingDrug) {
            $this->flashMessage('error', _repeat);
        } else {

            $request = $this->validateInputs($request, ['image' => false]);

            // check image
            $this->handleImageUpload($request['image'], 'images/drugs');

            $this->db->insert('drugs', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // show drugs
    public function showDrugs()
    {
        $this->middleware(true, true, 'showDrugs');
        $drugs = $this->db->select('SELECT * FROM drugs ORDER BY id DESC')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/drugs/show-drugs.php');
        exit();
    }

    // edit drug page
    public function editDrug($id)
    {
        $this->middleware(true, true, 'general', true);

        $drug = $this->db->select('SELECT * FROM drugs WHERE id = ?', [$id])->fetch();
        $drugCategories = $this->db->select('SELECT * FROM drug_categories WHERE `status` = ?', [1])->fetchAll();
        $units = $this->db->select('SELECT * FROM units WHERE `status` = ?', [1])->fetchAll();
        if ($drug != null) {
            require_once(BASE_PATH . '/resources/views/app/drugs/edit-drug.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit employee store
    public function editDrugStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['name'] == '' || $request['category_id'] == '' || $request['unit'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $existDrug = $this->db->select(
            'SELECT id FROM drugs WHERE name = ? AND id != ? LIMIT 1',
            [$request['name'], $id]
        )->fetch();

        if ($existDrug) {
            $this->flashMessage('error', 'نام وارد شده قبلاً ثبت شده است.');
            return;
        }

        // check upload photo
        $this->updateImageUpload($request, 'image', 'drugs', 'drugs', $id);

        $this->db->update('drugs', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('drugs'));
    }

    // drug detiles page
    public function drugDetails($id)
    {
        $this->middleware(true, true, 'general');

        $drug = $this->db->select("
            SELECT 
                d.*, 
                c.cat_name,
                u.unit_name
            FROM drugs d
            LEFT JOIN drug_categories c ON d.category_id = c.id
            LEFT JOIN units u ON d.unit = u.id
            WHERE d.id = ?
            LIMIT 1
        ", [$id])->fetch();

        if ($drug) {
            require_once(BASE_PATH . '/resources/views/app/drugs/drug-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status drug
    public function changeDrugStatus($id)
    {
        $this->middleware(true, true, 'general');

        $drug = $this->db
            ->select('SELECT * FROM drugs WHERE id = ?', [$id])
            ->fetch();

        if (!$drug) {
            require_once BASE_PATH . '/404.php';
            exit;
        }

        $newState = ($drug['status'] == 1) ? 2 : 1;

        $this->db->update('drugs', $drug['id'], ['status'], [$newState]);
        $this->send_json_response(true, _success, $newState);
    }
}
