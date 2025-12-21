<?php

namespace App;

class Prints extends App
{
    // show presctiption for print
    public function print()
    {
        $this->middleware(true, true, 'prescriptionPrint', true);

        // $prescription = $this->db->select(
        //     'SELECT p.*, 
        //         e.employee_name,
        //         e.expertise
        // FROM prescriptions p
        // JOIN employees e ON e.id = p.doctor_id
        // WHERE p.status = ?
        // ORDER BY p.id ASC
        // LIMIT 1',
        //     [2]
        // )->fetch();

        // $items = [];

        // if ($prescription) {
        //     $this->db->update('prescriptions', $prescription['id'], ['status'], [3]);

        //     $items = $this->db->select(
        //         'SELECT *
        //      FROM prescription_items
        //      WHERE prescription_id = ?
        //      ORDER BY id ASC',
        //         [$prescription['id']]
        //     )->fetchAll();
        // }

        $prescriptions = $this->db->select(
            'SELECT p.*, e.employee_name
         FROM prescriptions p
         JOIN employees e ON e.id = p.doctor_id
         WHERE p.status = ? ORDER BY id DESC',
            [3]
        )->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/prints/prescriptionsPrint.php');
    }

    public function getNextPrescription()
    {
        header('Content-Type: application/json; charset=utf-8');

        $prescription = $this->db->select(
            'SELECT p.*, e.employee_name, e.expertise
         FROM prescriptions p
         JOIN employees e ON e.id = p.doctor_id
         WHERE p.status = ?
         ORDER BY p.id ASC
         LIMIT 1',
            [2]
        )->fetch();

        if ($prescription) {

            // تغییر وضعیت نسخه
            $this->db->update('prescriptions', $prescription['id'], ['status'], [3]);

            // داروها
            $items = $this->db->select(
                'SELECT *
             FROM prescription_items
             WHERE prescription_id = ?
             ORDER BY id ASC',
                [$prescription['id']]
            )->fetchAll();

            // ✅ آزمایش‌ها
            $tests = $this->db->select(
                'SELECT r.id, t.test_name
             FROM recommended r
             JOIN tests t ON r.recommended = t.id
             WHERE r.prescription_id = ?',
                [$prescription['id']]
            )->fetchAll();

            echo json_encode([
                'success' => true,
                'prescription' => $prescription,
                'items' => $items,
                'tests' => $tests // ⭐ خیلی مهم
            ], JSON_UNESCAPED_UNICODE);

            exit;
        }

        echo json_encode(['success' => false]);
        exit;
    }

    // show presctiption for print
    public function prescriptionItemPrint($id)
    {
        $this->middleware(true, true, 'prescriptionPrint', true);

        $prescription = $this->db->select(
            'SELECT p.*, 
                e.employee_name,
                e.expertise
         FROM prescriptions p
         JOIN employees e ON e.id = p.doctor_id
         WHERE p.status = ? AND p.id = ?',
            [3, $id]
        )->fetch();
        // NOTE

        // NOTE
        $items = [];

        if ($prescription) {
            $items = $this->db->select(
                'SELECT *
         FROM prescription_items
         WHERE prescription_id = ?
         ORDER BY id ASC',
                [$prescription['id']]
            )->fetchAll();

            $tests = $this->db->select(
                'SELECT r.*, t.test_name
         FROM recommended r
         JOIN tests t ON r.recommended = t.id
         WHERE r.prescription_id = ?',
                [$prescription['id']]
            )->fetchAll();
        }

        require_once(BASE_PATH . '/resources/views/app/prints/prescriptionPrint.php');
    }





    // show presctiption for print
    public function printItem($id)
    {
        $this->middleware(true, true, 'prescriptionPrint', true);

        $prescription = $this->db->select(
            'SELECT p.*, 
                e.employee_name,
                e.expertise
         FROM prescriptions p
         JOIN employees e ON e.id = p.doctor_id
         WHERE p.id = ?',
            [$id]
        )->fetch();

        $items = [];

        if ($prescription) {
            $items = $this->db->select(
                'SELECT *
         FROM prescription_items
         WHERE prescription_id = ?
         ORDER BY id ASC',
                [$prescription['id']]
            )->fetchAll();

            $tests = $this->db->select(
                'SELECT r.*, t.test_name
         FROM recommended r
         JOIN tests t ON r.recommended = t.id
         WHERE r.prescription_id = ?',
                [$prescription['id']]
            )->fetchAll();
        }

        require_once(BASE_PATH . '/resources/views/app/prints/print-item.php');
    }
}
