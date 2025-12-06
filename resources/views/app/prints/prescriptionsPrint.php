<?php
$title = 'نمایش نسخه‌ها';
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
include_once('resources/views/app/prints/script.php');
?>

<div class="content">
    <div class="content-title">نمایش نسخه‌ها
        <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
    </div>


    <!-- show employees -->
    <div class="box-container">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام داکتر</th>
                    <th>نام بیمار</th>
                    <th>تاریخ ثبت</th>
                    <th>جزئیات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $perPage = 10;
                $data = paginate($prescriptions, $perPage);
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $number = ($currentPage - 1) * $perPage + 1;
                foreach ($data as $item) {
                ?>
                    <tr>
                        <td class="color-orange"><?= $number ?></td>
                        <td><?= $item['employee_name'] ?></td>
                        <td><?= $item['patient_name'] ?? '- - - -' ?></td>
                        <td><?= jdate('Y/m/d', strtotime($item['created_at'])) ?></td>
                        <td>
                            <a href="<?= url('employee-details/' . $item['id']) ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" class="color-orange" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php
                    $number++;
                }
                ?>
            </tbody>
        </table>
        <div class="flex-justify-align mt20 paginate-section">
            <div class="table-info fs14">تعداد کل: <?= count($prescriptions) ?></div>
            <?php
            if (count($prescriptions) == null) { ?>
                <div class="center fs14 color-red">
                    <i class="fa fa-comment"></i>
                    <?= 'اطلاعاتی ثبت نشده است' ?>
                </div>
            <?php } else {
                if (count($prescriptions) > 10) {
                    echo paginateView($prescriptions, 10);
                }
            }
            ?>
        </div>
    </div>
    <!-- end page content -->

    <div class="form-container" id="print">

        <!-- check phone -->
        <?php
        $phones = array_filter([
            $invoice_infos['phone1'] ?? '',
            $invoice_infos['phone2'] ?? '',
            $invoice_infos['phone3'] ?? '',
            $invoice_infos['phone4'] ?? '',
        ]);
        ?>
        <!-- top header -->
        <div class="top-inv d-flex align-center">
            <div class="top-inv-text center">
                <h2 class="color-print"></h2>
                <div class="color-print fs14">تولید کننده رنگ های روغنی، پلاستیکی، و مایع رنگ</div>
                <div class="color-print fs12">
                    <span><?= implode(' - ', array_map([$this, 'convertEnNumber'], $phones)) ?></span>
                </div>
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
                <div class="fs15 color-print bold">شماره فاکتور: <?= '555' ?></div>
                <div class="fs15 color-print">تاریخ: 44444</div>
                <div class="fs15 color-print">توسط: ali</div>
            </div>
        </div>
        <hr class="hr">

    </div>
    <button>🖨️ چاپ فرم</button>

</div>
<!-- End content -->

<?php include_once('resources/views/layouts/footer.php') ?>