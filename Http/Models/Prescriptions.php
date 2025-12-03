<?php

namespace Models\Prescriptions;

use App\App;

class Prescriptions extends App
{
    //////////////////// buy invoice ////////////////
    // get calendar type
    public function getInvoiceDetails($id, $type)
    {
        $invoice = $this->db->select('SELECT * FROM invoices WHERE id = ?', [$id])->fetch();

        if ($invoice) {
            $seller = $this->db->select('SELECT id, user_name FROM users WHERE id = ?', [$invoice['user_id']])->fetch();

            if ($seller) {
                $invoice['seller_id'] = $seller['id'];
                $invoice['seller_name'] = $seller['user_name'];
            } else {
                $invoice['seller_id'] = null;
                $invoice['seller_name'] = 'عمومی';
            }

            return $invoice;
        } else {
            require_once BASE_PATH . '/404.php';
            exit();
        }
    }

    // get buy invoice items
    public function getBuyInvoiceItems($invoice_id)
    {
        return $invoice = $this->db->select('SELECT * FROM invoice_items WHERE invoice_id = ?', [$invoice_id])->fetchAll();
    }

    // get buy invoice item /////////////////// ok /////////////////////
    public function getPrescriptionItem($prescription_id, $drug_id)
    {
        return $drug_item = $this->db->select('SELECT * FROM prescription_items WHERE prescription_id = ? AND drug_id = ?', [$prescription_id, $drug_id])->fetch();
    }

    // get calendar type
    public function getInventoryItem($product_id, $selling_price)
    {
        $inventory = $this->db->select('SELECT * FROM inventory WHERE product_id = ? AND selling_price = ?', [$product_id, $selling_price])->fetch();
        return $inventory;
    }

    // get invoice items
    public function getInvoiceItems($invoice_id)
    {
        return $invoice = $this->db->select('SELECT * FROM invoice_items WHERE invoice_id = ?', [$invoice_id])->fetchAll();
    }

    // check invoice but ///////////////// ok ///////////////////
    public function InvoiceConfirm($prescription_info)
    {
        $invoice_type = $prescription_info['type'];

        $prescription = $this->db->select('SELECT id FROM prescriptions WHERE `type` = ? AND `status` = ?', [$invoice_type, 1])->fetch();

        if ($prescription) {
            $this->db->update('prescriptions', $prescription['id'], array_keys($prescription_info), $prescription_info);
            return $prescription['id'];
        } else {
            $this->db->insert('prescriptions', array_keys($prescription_info), $prescription_info);

            $lastId = $this->db->lastInsertId();

            return $lastId;
        }
    }

    // get quantity in package, query from products
    public function quantityInPackage($product_id)
    {
        $product = $this->db->select('SELECT quantity_in_pack FROM products WHERE id = ?', [$product_id])->fetch();
        return $product ? $product['quantity_in_pack'] : 1;
    }

    // get prescription  /////////////////////// ok ///////////////////
    public function getPrescription($id)
    {
        return $prescription = $this->db->select('SELECT * FROM prescriptions WHERE id = ?', [$id])->fetch();
    }

    //////////////////////////////////////  sale invoice //////////////////////////////////


    // check quantity product for add sale invoice
    public function productCheckQuantity($product_id, $quantity, $branchId)
    {
        $inventory = $this->db->select('SELECT id, quantity FROM inventory WHERE branch_id = ? AND product_id = ?', [$branchId, $product_id])->fetch();
        if (!$inventory) {
            require_once BASE_PATH . '/404.php';
            exit();
        }

        if (intval($inventory['quantity']) >= intval($quantity)) {
            $new_quantity = $inventory['quantity'] - $quantity;
            $this->db->update('inventory', $inventory['id'], ['quantity'], [$new_quantity]);
            return;
        }

        $invoice_any_situation = $this->db->select('SELECT invoice_any_situation FROM settings')->fetch();
        if ($invoice_any_situation['invoice_any_situation'] == 2) {
            $this->flashMessage('error', 'موجودی محصول کم است!');
        } else {
            $new_quantity = $inventory['quantity'] - $quantity;
            $this->db->update('inventory', $inventory['id'], ['quantity'], [$new_quantity]);
            return;
        }
    }

    ////////////// seller infos ///////////////
    public function getSellerFinancialInfos($seller_id)
    {
        $seller = $this->db->select('SELECT * FROM users WHERE id = ?', [$seller_id])->fetch();
        if ($seller) {
            $financial_seller = $this->db->select('SELECT * FROM sales_transactions WHERE seller_id = ?', [$seller['id']])->fetchAll();
            return $financial_seller;
        } else {
            return 1;
        }
    }

    // generate invoice number
    public function generateInvoiceNo($type, $invoiceId = null)
    {
        $typeCode = '';
        switch ($type) {
            case 1:
                $typeCode = 'S';
                break;
            case 2:
                $typeCode = 'P';
                break;
            case 3:
                $typeCode = 'RS';
                break;
            case 4:
                $typeCode = 'RP';
                break;
            default:
                $typeCode = 'X';
        }

        $today = date('ymd');

        if (!$invoiceId) {
            $invoiceId = '0000';
        }

        return $typeCode . $today . '-' . $invoiceId;
    }

    /////////////////////////////////////////// return buy invoce /////////////////////////////////////////!SECTION

    // add new buy transaction and update user account in database
    public function addNewReturnBuyTransaction($data)
    {
        $user = $this->db->select('SELECT * FROM users WHERE id = ?', [$data['user_id']])->fetch();
        if (!$user) {
            throw new \Exception('کاربر یافت نشد');
        }

        $exist_accounts = $this->db->select('SELECT * FROM account_balances WHERE user_id = ?', [$user['id']])->fetch();
        if ($exist_accounts) {
            $creditor = $exist_accounts['creditor'];
            $total_purchases = $exist_accounts['total_purchase_amount'];
            $total_paid_to_user = $exist_accounts['total_paid_to_user'];
            $total_purchase_discount = $exist_accounts['total_purchase_discount'];

            $update_account = [
                'total_purchase_amount' => $data['total_purchase_amount'] + $total_purchases,
                'total_paid_to_user' => $data['total_paid_to_user'] + $total_paid_to_user,
                'total_purchase_discount' => $data['total_purchase_discount'] + $total_purchase_discount,
                'creditor' => $data['creditor'] + $creditor,
            ];

            $updated = $this->db->update('account_balances', $exist_accounts['id'], array_keys($update_account), $update_account);
            if (!$updated) {
                throw new \Exception('خطا در بروزرسانی حساب کاربر');
            }
        } else {
            $add_account = [
                'user_id'   => $user['id'],
                'total_purchase_amount' => $data['total_purchase_amount'],
                'total_paid_to_user' => $data['total_paid_to_user'],
                'total_purchase_discount' => $data['total_purchase_discount'],
                'creditor' => $data['creditor'],
            ];
            $inserted = $this->db->insert('account_balances', array_keys($add_account), $add_account);
            if (!$inserted) {
                throw new \Exception('خطا در افزودن حساب جدید به کاربر');
            }
        }

        // add new record for transaction
        $buy_transactions = [
            'seller_id' => $user['id'],
            'buy_ref_id' => $data['buy_ref_id'],
            'buy_total_price' => $data['total_purchase_amount'],
            'buy_paid_amount' => $data['total_paid_to_user'],
            'buy_remaining' => $data['creditor'],
            'buy_discount' => $data['total_purchase_discount'],
            'buy_date' => $data['buy_date'],
            'buy_year' => $data['year'],
            'buy_month' => $data['month'],
            'who_it' => $data['who_it'],
        ];

        $insertedTransaction = $this->db->insert('buy_transactions', array_keys($buy_transactions), $buy_transactions);
        if (!$insertedTransaction) {
            throw new \Exception('خطا در ثبت تراکنش خرید');
        }
    }
}
