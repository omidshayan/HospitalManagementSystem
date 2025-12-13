<?php
$title = 'نمایش نسخه: ' . $prescription['patient_name'];
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
?>


<div class="content">
    <div class="content-title">نمایش نسخه: <?= $prescription['patient_name'] ?>
        <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
    </div>


    <!-- form print -->
    <?php if (!empty($prescription)) : ?>

        <div class="center bg-whith">
            <div class="item-print p10">

                <!-- patient infos -->
                <div class="p-patient-infos">
                    <span>
                        <span class="fs14">نام مریض:</span>
                        <span class="bold"> <?= $prescription['patient_name'] ?></span>
                    </span>
                    <span>
                        <span class="fs14">سن: </span>
                        <span class="bold"><?= $this->convertEnNumber($this->getAge($prescription['birth_year'])) ?></span>
                    </span>

                    <span>
                        <span class="fs14">تاریخ مراجعه: </span>
                        <span class="bold"><?= jdate('Y/m/d', strtotime($prescription['created_at'])) ?></span>
                    </span>
                </div>

                <!-- body pre... -->
                <div class="body-pre-print">

                    <!-- drugs list -->
                    <div class="p-drugs-print pr">

                        <table class="pa t0 w100">
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
                                <?php
                                foreach ($items as $item) { ?>

                                    <div class="p-drugs-items">
                                        <tr class="p-color-item fs14 center">
                                            <td><?= $item['usage_instruction'] ?></td>
                                            <td><?= $item['dosage'] ?></td>
                                            <td><?= $item['interval_time'] ?></td>
                                            <td><?= $this->convertEnNumber($item['drug_count']) ?></td>
                                            <td class="p5 drug-name-en"> <?= $item['drug_name'] ?></td>
                                        </tr>
                                    </div>

                                <?php }
                                ?>
                            </tbody>
                        </table>

                        <div class="fs14"><?= $prescription['diagnosis'] ?></div>

                    </div>

                    <!-- left infos -->
                    <div class="p-left-infos border-r">

                        <!-- doctor infos -->
                        <div class="p-doctor-infos">
                            <h3>نام داکتر: <?= $prescription['employee_name'] ?></h3>
                            <span class="fs14 bold">تخصص: <?= $prescription['expertise'] ?></span>
                            <hr class="hrp">
                        </div>

                        <!-- infos -->
                        <div class="p-vital-signs fs12">
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['bp'] ?></span>
                                <span>BP</span>
                            </div>
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['pr'] ?></span>
                                <span>Pr</span>
                            </div>
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['rr'] ?></span>
                                <span>Rr</span>
                            </div>
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['temp'] ?></span>
                                <span>TEMP</span>
                            </div>
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['spo2'] ?></span>
                                <span>SPO₂</span>
                            </div>
                        </div>

                        <!-- Recommended -->
                        <ul class="p-recommended fs12">
                            <?php
                            if (!empty($tests)) {
                                foreach ($tests as $test) { ?>
                                    <li class="ol"><?= $test['test_name'] ?> </li>
                            <?php }
                            }
                            ?>
                        </ul>

                    </div>

                </div>

            </div>
        </div>

    <?php endif; ?>

    <!-- <div class="center mt10 btn w120 color bold p20" onclick="printReceipt()">
        چاپ مجدد
    </div> -->

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