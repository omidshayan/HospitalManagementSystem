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

    // print invoice
    public function print()
    {
        dd('ok');
        $this->middleware(true, true, 'general', true);
        $branchId = $this->getBranchId();

        $factor_infos = $this->db->select('SELECT * FROM factor_settings WHERE branch_id = ?', [$branchId])->fetch();

        if (!$branchId) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        require_once(BASE_PATH . '/resources/views/app/prints/invoice.php');
    }
}
