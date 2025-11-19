<?php

namespace Models\Transaction;

use App\App;

class Transaction extends App
{
    // add new transactions
    public function addNewTransaction($data)
    {
        if (empty($data['user_id']) || (int)$data['user_id'] === 0) {
            $data['user_id'] = 1;
        }

        $user = $this->db->select('SELECT * FROM users WHERE id = ?', [$data['user_id']])->fetch();
        if (!$user) {
            throw new \Exception('User not found (addNewTransaction)');
        }

        // دریافت آخرین بالانس کاربر
        $lastBalance = $this->db
            ->select('SELECT balance FROM users_transactions WHERE user_id = ? ORDER BY id DESC LIMIT 1', [$data['user_id']])
            ->fetchColumn();

        if ($lastBalance === false) {
            $lastBalance = 0;
        }

        // محاسبه مبلغ خالص تراکنش
        $total = isset($data['total_price']) ? (float)$data['total_price'] : 0;
        $discount = isset($data['discount']) ? (float)$data['discount'] : 0;
        $paid = isset($data['paid_amount']) ? (float)$data['paid_amount'] : 0;

        // مبلغ خالص نهایی
        $netAmount = $total - $discount - $paid;
        $type = (int)$data['transaction_type'];
        $newBalance = $lastBalance;

        // اعمال منطق بر اساس نوع تراکنش
        switch ($type) {
            case 1: // فروش به مشتری → مشتری بدهکار می‌شود
                $newBalance = $lastBalance - $netAmount;
                break;

            case 2: // خرید از مشتری → فروشگاه طلبکار می‌شود
                $newBalance = $lastBalance + $netAmount;
                break;

            case 3: // برگشت از فروش → بدهی مشتری کم می‌شود
                $newBalance = $lastBalance + $netAmount;
                break;

            case 4: // برگشت از خرید → طلب فروشگاه کم می‌شود
                $newBalance = $lastBalance - $netAmount;
                break;

            case 5: // دریافت پول از مشتری → بدهی مشتری کم می‌شود
                $newBalance = $lastBalance + $paid; // در این نوع paid_amount ملاک است
                break;

            case 6: // پرداخت پول به کاربر → طلب فروشگاه کم می‌شود
                $newBalance = $lastBalance - $paid; // در این نوع paid_amount ملاک است
                break;

            default:
                throw new \Exception('Unknown transaction type: ' . $type);
        }

        $data['balance'] = $newBalance;

        $this->db->insert('users_transactions', array_keys($data), $data);
    }

    // update account balance
    public function updateAccountBalance($data)
    {
        if (empty($data['user_id']) || (int)$data['user_id'] === 0) {
            $data['user_id'] = 1;
        }

        $branch_id    = (int)$data['branch_id'];
        $account = $this->db->select('SELECT * FROM account_balances WHERE user_id = ? AND branch_id = ?', [$data['user_id'], $branch_id])->fetch();
        if (!$account) {
            throw new \Exception('کاربر یافت نشد!');
        }

        $balance                 = (float)$account['balance']; // update in all types
        $total_sales             = (float)$account['total_sales']; // update in type 2
        $total_purchase          = (float)$account['total_purchase']; // update in type 1
        $total_sales_returns     = (float)$account['total_sales_returns']; // update in type 4 
        $total_purchase_returns  = (float)$account['total_purchase_returns']; // update in type 3
        $total_payments          = (float)$account['total_payments']; // update in type 1  
        $total_receipts          = (float)$account['total_receipts']; // update in type 2 
        $total_discount_sales    = (float)$account['total_discount_sales']; // update in type 2 
        $total_discount_purchase = (float)$account['total_discount_purchase']; // update in type 1 

        // data defualt
        $total_price  = (float)($data['total_price'] ?? 0);
        $paid_amount  = (float)($data['paid_amount'] ?? 0);
        $discount     = (float)($data['discount'] ?? 0);


        switch ($data['type']) {
            case 1: // (purchase)
                $total_purchase          += $total_price;
                $total_payments          += $paid_amount;
                $total_discount_purchase += $discount;
                $balance                 -= ($total_price - $paid_amount - $discount);
                $update = [
                    'branch_id'             => $branch_id,
                    'total_purchase'        => $total_purchase,
                    'total_payments'        => $total_payments,
                    'total_discount_purchase' => $total_discount_purchase,
                    'balance'               => $balance,
                ];
                break;

            case 2: // (sale)
                $total_sales          += $total_price;
                $total_receipts       += $paid_amount;
                $total_discount_sales += $discount;
                $balance              += ($total_price - $paid_amount - $discount);
                $update = [
                    'branch_id'            => $branch_id,
                    'total_sales'          => $total_sales,
                    'total_receipts'       => $total_receipts,
                    'total_discount_sales' => $total_discount_sales,
                    'balance'              => $balance,
                ];
                break;

            case 3: // (purchase return)
                $total_purchase_returns += $total_price;
                $total_receipts         += $paid_amount;
                $balance                += ($total_price - $paid_amount);
                $update = [
                    'branch_id'              => $branch_id,
                    'total_purchase_returns' => $total_purchase_returns,
                    'total_receipts'         => $total_receipts,
                    'balance'                => $balance,
                ];
                break;

            case 4: // (sale return)
                $total_sales_returns += $total_price;
                $total_payments     += $paid_amount;
                $balance            -= ($total_price - $paid_amount - $discount);
                $update = [
                    'branch_id'          => $branch_id,
                    'total_sales_returns' => $total_sales_returns,
                    'total_payments'     => $total_payments,
                    'balance'            => $balance,
                ];
                break;

            default:
                throw new \Exception('نوع تراکنش نامعتبر است (updateAccountBalance)');
        }

        $update['user_id'] = $data['user_id'];
        $update['last_transaction_at'] = date('Y-m-d');

        $this->db->update(
            'account_balances',
            $account['id'],
            array_keys($update),
            $update
        );
    }
}
