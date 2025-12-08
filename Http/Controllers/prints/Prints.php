<?php

namespace App;

class Prints extends App
{
    // management of years page
    public function prescriptionPrint($id)
    {
        $this->middleware(true, true, 'general', true);

        $sale_invoice_print = $this->db->select(
            'SELECT 
            si.*,
            u.user_name,
            u.address,
            u.phone,
            ca.balance AS account_balance
         FROM invoices si
         LEFT JOIN users u ON u.id = si.user_id
         LEFT JOIN account_balances ca ON ca.user_id = si.user_id AND ca.branch_id = si.branch_id
         WHERE si.id = ?',
            [$id]
        )->fetch();

        require_once(BASE_PATH . '/resources/views/app/sales/add-sale.php');
    }

    // show presctiption for print
    public function print()
    {
        $this->middleware(true, true, 'general', true);

        $prescription = $this->db->select(
            'SELECT p.*, e.employee_name
            FROM prescriptions p
            JOIN employees e ON e.id = p.doctor_id
            WHERE p.status = ?
            ORDER BY p.id ASC
            LIMIT 1',
                    [2]
             )->fetch();


        $prescriptions = $this->db->select(
            'SELECT p.*, e.employee_name
             FROM prescriptions p
             JOIN employees e ON e.id = p.doctor_id
             WHERE p.status = ?',
            [2]
        )->fetchAll();

        require_once(BASE_PATH . '/resources/views/app/prints/prescriptionsPrint.php');
    }

    // print invoice
    public function autoPrint()
    {
        dd('tuo');
        $this->middleware(true, true, 'general', true);

        $prescription = $this->db->select('SELECT * FROM prescriptions WHERE `status` = ?', [2])->fetch();

        if (!$prescription) {
            require_once BASE_PATH . '/404.php';
            exit();
        }

        $factor_infos = $this->db->select('SELECT * FROM prescription_settings')->fetch();

        require_once(BASE_PATH . '/resources/views/app/prints/prescription.php');
    }
}
