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


    <!-- show -->
    <div class="box-container">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام داکتر</th>
                    <th>نام مریض</th>
                    <th>تاریخ ثبت</th>
                    <th>جزئیات</th>
                    <th>چاپ</th>
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
                        <td><a href="<?= url('prescription-item-print/' . $item['id']) ?>" target="_blank" class="color text-underline">چاپ</a></td>
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

    <div class="btn w150 color bold center p10" id="checkPrescriptions">برسی دستی نسخه‌ها</div>

    <div id="printContainer" class="center bg-whith">
        <!-- نسخه در اینجا نمایش داده می‌شود -->
    </div>

    <script>
        const PRESC_URL = "<?= url('getNextPrescription') ?>";

        let isPrinting = false;

        function convertEnNumber(number) {
            const en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            const fa = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            return number.toString().split('').map(n => fa[en.indexOf(n)] || n).join('');
        }

        function getAge(birthYear) {
            const now = new Date();
            return now.getFullYear() - parseInt(birthYear);
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const y = date.getFullYear();
            const m = ('0' + (date.getMonth() + 1)).slice(-2);
            const d = ('0' + date.getDate()).slice(-2);
            return `${y}/${m}/${d}`;
        }

        function renderPrescription(prescription, items) {
            return `
        <div class="item-print p10">
            <div class="p-patient-infos">
                <span>
                    <span class="fs14">نام مریض:</span>
                    <span class="bold">${prescription.patient_name}</span>
                </span>
                <span>
                    <span class="fs14">سن: </span>
                    <span class="bold">${convertEnNumber(getAge(prescription.birth_year))}</span>
                </span>
                <span>
                    <span class="fs14">تاریخ مراجعه: </span>
                    <span class="bold">${formatDate(prescription.created_at)}</span>
                </span>
            </div>

            <div class="body-pre-print">
                <div class="p-drugs-print">
                    <table>
                        <thead>
                            <tr class="fs12 p-color-title">
                                <th class="w80 p5">طریقه مصرف</th>
                                <th class="w120">مقدار مصرف هر نوبت</th>
                                <th class="w80">زمان مصرف</th>
                                <th class="">تعداد</th>
                                <th class="">نام دارو</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${items.map(item => `
                                <tr class="p-color-item fs14 center">
                                    <td>${item.usage_instruction}</td>
                                    <td>${item.dosage}</td>
                                    <td>${item.interval_time}</td>
                                    <td>${convertEnNumber(item.drug_count)}</td>
                                    <td class="p5 drug-name-en">${item.drug_name}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>

                <div class="p-left-infos border-r">
                    <div class="p-doctor-infos">
                        <h3>نام داکتر: ${prescription.employee_name}</h3>
                        <span class="fs14 bold">تخصص: ${prescription.expertise}</span>
                    </div>

                    <div class="p-vital-signs fs12">
                        <div class="d-flex justify-between pr8">
                            <span>${prescription.bp}</span><span>BP</span>
                        </div>
                        <div class="d-flex justify-between pr8">
                            <span>${prescription.pr}</span><span>Pr</span>
                        </div>
                        <div class="d-flex justify-between pr8">
                            <span>${prescription.rr}</span><span>Rr</span>
                        </div>
                        <div class="d-flex justify-between pr8">
                            <span>${prescription.temp}</span><span>TEMP</span>
                        </div>
                        <div class="d-flex justify-between pr8">
                            <span>${prescription.spo2}</span><span>SPO₂</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        }

        function printReceipt() {
            if (window.chrome && window.chrome.webview) {
                window.chrome.webview.hostObjects.bridge.PrintHtml(document.getElementById('printContainer').innerHTML);
            } else {
                const original = document.body.innerHTML;
                const printArea = document.getElementById('printContainer').innerHTML;
                document.body.innerHTML = printArea;
                window.print();
                document.body.innerHTML = original;
            }
        }

        async function checkForPrescription() {
            if (isPrinting) return;

            try {
                const res = await fetch(PRESC_URL);
                const text = await res.text();
                const data = JSON.parse(text);

                if (data.success) {
                    isPrinting = true;
                    document.getElementById('printContainer').innerHTML = renderPrescription(data.prescription, data.items);
                    printReceipt();

                    setTimeout(() => {
                        isPrinting = false;
                    }, 3000);
                }
            } catch (e) {
                console.error("Error fetching prescription:", e);
            }
        }

        // اجرا اول صفحه
        checkForPrescription();

        // چک هر 30 ثانیه
        setInterval(checkForPrescription, 2000);

        // دکمه بررسی دستی
        document.getElementById('checkPrescriptions').addEventListener('click', checkForPrescription);
    </script>




</div>
<!-- End content -->

<?php include_once('resources/views/layouts/footer.php') ?>