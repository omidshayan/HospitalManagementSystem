<div class="form-container" id="print">

<!-- top header -->
<div class="top-inv d-flex align-center">
    <div class="top-inv-text center">
        <h2 class="color-print">صنایع رنگ و رزین سازی افغان فیضی</h2>
        <div class="color-print fs14">تولید کننده رنگ های روغنی، پلاستیکی، و مایع رنگ</div>
        <div class="color-print fs12"><span>0799999999</span> - <span>0799999999</span> - <span>0799999999</span> - <span>0799999999</span></div>
    </div>
    <div class="top-inv-logo">
        <img src="<?= asset('public/assets/img/logo.png') ?>" class="" alt="logo">
    </div>
</div>
<hr class="hr">

<!-- invoice infos -->
<div class="d-flex justify-between">
    <div class="top-desc-one mt5">
        <div class="fs15 color-print">نام خریدار: <?= (isset($sale_invoice_print['user_name']) && $sale_invoice_print) ? $sale_invoice_print['user_name'] : 'عمومی' ?></div>
        <div class="fs15 color-print">شماره موبایل: <?= htmlspecialchars($sale_invoice_print['phone'] ?? '- - - -', ENT_QUOTES, 'UTF-8') ?></div>
        <div class="fs14 color-print">آدرس: <?= htmlspecialchars($sale_invoice_print['address'] ?? '- - - -', ENT_QUOTES, 'UTF-8') ?></div>
    </div>
    <div class="top-desc-one mt5 d-flex align-center">
        <div class="fs15 color-print"><svg id="barcode"></svg></div>
    </div>
    <div class="top-desc-one mt5">
        <div class="fs15 color-print bold">شماره فاکتور: <?= $this->to_farsi_number($sale_invoice_print['id']) ?></div>
        <div class="fs15 color-print">تاریخ: <?= jdate('Y/m/d', $sale_invoice_print['sale_invoice_date']) ?></div>
        <div class="fs15 color-print">توسط: <?= $_SESSION['sk_em_name'] ?></div>
    </div>
</div>
<hr class="hr">

<!-- products details -->
<table class="table-print w100 color-print center mt15">
    <thead>
        <tr class="fs14">
            <th class="w20 fs11">شماره</th>
            <th class="w300">نام محصول</th>
            <th>تعداد بسته</th>
            <th>تعداد جز</th>
            <th>تعداد کل</th>
            <th>قیمت واحد</th>
            <th class="fs11">تخفیف</th>
            <th>قیمت کل</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $total_price = 0;
        if (!empty($invoice_data) && is_array($invoice_data)) {
            $number = 1;
            foreach ($invoice_data as $item) {
                $total_price += $item['item_total_price'];
        ?>
                <tr>
                    <td><?= $this->to_farsi_number($number) ?></td>
                    <td class="w300"><?= $this->to_farsi_number($item['product_name']) ?></td>
                    <td class="w80"><?= $this->to_farsi_number($item['package_qty']) ?> <span class="fs12"><?= $item['package_type'] ?></span></td>
                    <td class="w80"><?= $this->to_farsi_number($item['unit_qty']) ?> <span class="fs12"><?= $item['unit_type'] ?></span></td>
                    <td class="w80"><?= $this->to_farsi_number($item['quantity']) ?> <span class="fs12"><?= $item['unit_type'] ?></span></td>
                    <td class="w80"><?= $this->to_farsi_number(number_format($item['unit_price_sell'])) ?></td>
                    <td><?= $this->to_farsi_number(0) ?></td>
                    <td class="w80"><?= $this->to_farsi_number(number_format($item['item_total_price'])) ?></td>
                </tr>
        <?php
                $number++;
            }
        }
        ?>
    </tbody>
</table>

<!-- amount details -->
<table class="table-print w100 color-print center mt5">
    <thead>
        <tr>
            <th colspan="4">مبلغ کل</th>
        </tr>
    </thead>
    <tbody>
        <tr class="fs15">
            <?php if ($total_price > 0) : ?>
                <td colspan="1" class="text-right bold w300"><?= $this->number_to_dari_words($total_price) ?> <span class="fs11">افغانی</span></td>
                <td colspan="1" class="w200 bold"><?= $this->to_farsi_number(number_format($total_price)) ?> افغانی</td>
            <?php endif; ?>
        </tr>
        <tr class="fs15">
            <td class="bold">پرداختی: <?= ($sale_invoice_print['sale_paid_amount']) ? $this->to_farsi_number(number_format($sale_invoice_print['sale_paid_amount'])) . _afghani : $this->to_farsi_number(0) ?></td>
            <td class="bold">باقیمانده: <?= ($sale_invoice_print['remaining_amount']) ? $this->to_farsi_number(number_format($sale_invoice_print['remaining_amount'])) . _afghani : $this->to_farsi_number(0) ?></td>
        </tr>

    </tbody>
</table>

<!-- seller details -->
<?php
if ($sale_invoice_print['user_name']) { ?>
    <table class="table-print w100 color-print center mt5">
        <thead>
            <tr>
                <th colspan="4">جزئیات مالی شما</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            <tr class="fs15">
                <td class="bold">مانده از حساب قبلی:
                    <span><?= isset($sale_invoice_print['debtor']) ? $this->to_farsi_number(number_format($sale_invoice_print['debtor'])) . _afghani : 0 ?></span>
                </td>
                <td class="bold">مانده از این فاکتور: <span><?= $this->to_farsi_number(number_format($sale_invoice_print['remaining_amount'])) ?> <?= _afghani ?></span></td>
                <td class="bold">مجموع بدهی</td>
                <td class="bold"><?= $this->to_farsi_number(number_format($sale_invoice_print['remaining_amount'] + $sale_invoice_print['debtor'])) ?> <?= _afghani ?></td>
            </tr>
        </tbody>
        </tbody>
    </table>
<?php }
?>

<div class="d-flex justify-between">
    <div class="fs12 center mt5 color-print">آدرس: افغانستان-هرات، جاده بانک خون، رو به روی اتاق های تجارت</div>
    <div class="fs12 center mt5 color-print">www.faizipaint.com - E-Mail: info@faizipaint.com</div>
</div>
</div>