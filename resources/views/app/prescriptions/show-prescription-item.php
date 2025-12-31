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

        <?php include_once('resources/views/app/prescriptions/prescription-print.php'); ?>

    <?php endif; ?>

    <div class="center mt10 btn w120 color bold p20" onclick="printReceipt()">
        چاپ نسخه
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