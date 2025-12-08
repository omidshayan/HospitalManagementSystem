<?php
$title = 'نمایش نسخه‌ها';
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
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

    <!-- form print -->
    <div class="center bg-whith">
        <div class="item-print p10">

            <!-- patient infos -->
            <div class="p-patient-infos">
                <span>
                    <span class="fs14">نام مریض:</span>
                    <span class="bold"> حجی شیخ مندٌمر هراتی</span>
                </span>
                <span>
                    <span class="fs14">سن: </span>
                    <span class="bold">25</span>
                </span>

                <span>
                    <span class="fs14">تاریخ مراجعه: </span>
                    <span class="bold">1404/25/12</span>
                </span>
            </div>

            <!-- body pre... -->
            <div class="body-pre-print">

                <!-- drugs list -->
                <div class="p-drugs-print">
                    <div class="p-drugs-items">
                        <div>drug name</div>
                        <div>usage from</div>
                        <div>dosage</div>
                        <div>sadfdsfdsf</div>
                    </div>
                    <div class="p-drugs-items">
                        <div>drug name</div>
                        <div>usage from</div>
                        <div>dosage</div>
                        <div>sadfdsfdsf</div>
                    </div>
                </div>

                <div class="p-left-infos">

                    <!-- doctor infos -->
                    <div class="p-doctor-infos">
                        <h3>نام داکتر: رضا امینی</h3>
                        <span class="fs15">تخصص: فوق تخصص داخله</span>
                    </div>

                    <!-- infos -->
                    <div class="p-vital-signs mt50 fs12">
                        <div>BP</div>
                        <div>Pr</div>
                        <div>Rr</div>
                        <div>TEMP</div>
                        <div>Diagnose</div>
                    </div>

                </div>

            </div>



        </div>
    </div>



    <div class="center mt10" onclick="printReceipt()">
        print
    </div>

    <!-- print -->
    <script>
        function printReceipt() {
            if (window.chrome && window.chrome.webview) {
                window.chrome.webview.hostObjects.bridge.PrintHtml(document.body.innerHTML);
            } else {
                const original = document.body.innerHTML;
                const printArea = document.querySelector('.item-print').outerHTML;

                document.body.innerHTML = printArea;

                window.print();

                document.body.innerHTML = original;
            }
        }
    </script>


</div>
<!-- End content -->

<?php include_once('resources/views/layouts/footer.php') ?>