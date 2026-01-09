<?php
$title = 'چاپ نسخه: ' . $prescription['patient_name'];
include_once('resources/views/layouts/print-layout.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
?>

<div class="content">
    <div class="mb50">
        <a href="<?= url('prescriptions') ?>" class="btn p20 color bold">لیست تمام نسخه‌ها</a>
    </div>
    <div class="content-title mb20 mt20">چاپ نسخه: <?= $prescription['patient_name'] ?>
        <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
    </div>

    <!-- form print -->
    <?php if (!empty($prescription)) : ?>

        
        <?php include_once('resources/views/app/prescriptions/prescription-print.php'); ?>

        <script>
            window.onload = function() {
                setTimeout(() => {
                    printReceipt();
                }, 200);
            };
        </script>
    <?php endif; ?>

    <div class="center mt10 btn w120 color bold p20" onclick="printReceipt()">
        چاپ مجدد
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