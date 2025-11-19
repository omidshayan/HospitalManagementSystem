<?php

namespace Models\Reports;

use App\App;

class Reports extends App
{
    // update daily reports
    public function updateDailyReports($data)
    {
        $today = date('Y-m-d');

        $branch_id   = (int)$data['branch_id'];
        $type        = (int)$data['type'];
        $total_price = (float)($data['total_price'] ?? 0);
        $paid_amount = (float)($data['paid_amount'] ?? 0);
        $discount    = (float)($data['discount'] ?? 0);

        $new_debt     = $total_price - $paid_amount - $discount;
        $new_creditor = $total_price - $paid_amount - $discount;

        $day = $this->db->select(
            'SELECT * FROM daily_reports WHERE report_date = ? AND branch_id = ?',
            [$today, $branch_id]
        )->fetch();

        $update = [
            'total_purchases'           => 0,
            'total_sales'               => 0,
            'total_payments'            => 0,
            'total_received'            => 0,
            'total_discount_sales'      => 0,
            'total_purchase_discounts'  => 0,
            'total_purchase_return'    => 0,
            'total_sales_return'        => 0,
            'total_debts'               => 0,
            'total_creditor'           => 0,
            'total_expenses'            => 0,
            'invoice_count'             => 1,
        ];

        switch ($type) {
            case 1: // sale
                $update['total_sales'] += $total_price;
                $update['total_received'] += $paid_amount;
                $update['total_discount_sales'] += $discount;
                $update['total_creditor'] += $new_creditor;
                break;

            case 2: // purchase
                $update['total_purchases'] += $total_price;
                $update['total_payments']  += $paid_amount;
                $update['total_purchase_discounts'] += $discount;
                $update['total_debts'] += $new_debt;
                break;

            case 3: // return sale
                $update['total_sales_return'] += $total_price;
                $update['total_payments'] += $paid_amount;
                $update['total_creditor'] -= $new_creditor;
                break;

            case 4: // purchase return
                $update['total_purchase_return'] += $total_price;
                $update['total_received'] += $paid_amount;
                $update['total_debts'] -= $new_debt;
                break;

            default:
                throw new \Exception('نوع تراکنش نامعتبر است (updateDailyReports)');
        }

        if ($day) {
            foreach ($update as $key => $val) {
                if (isset($day[$key])) {
                    $update[$key] += $day[$key];
                }
            }

            $this->db->update('daily_reports', $day['id'], array_keys($update), $update);
        } else {
            $update['branch_id']   = $branch_id;
            $update['report_date'] = $today;

            $this->db->insert('daily_reports', array_keys($update), $update);
        }
    }
}
