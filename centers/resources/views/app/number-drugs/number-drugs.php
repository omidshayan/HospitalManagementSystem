<!-- start sidebar -->
<?php
$title = 'مدیریت تعداد دارو';
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
?>
<!-- end sidebar -->

<!-- Start content -->
<div class="content">
    <div class="content-title"> مدیریت تعداد دارو
        <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
    </div>
    <?php
    $help_title = 'مدیریت عدد';
    $help_content = ' ';
    include_once('resources/views/helps/help.php');
    ?>
    <!-- start page content -->
    <div class="mini-container">
        <div class="insert">
            <form id="myForm" action="<?=url('number-drugs-store')?>" method="POST">
                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14">تعداد <?= _star ?> </div>
                        <input type="text" name="number" class="checkInput" value="<?= $numberDrugs['number'] ?>" placeholder="عدد مورد نظر را وارد نمائید" autocomplete="off" />
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="submit" id="submit" value="ثــبــت" class="btn bold" />
            </form>
        </div>
    </div>

</div>
<!-- End content -->

<?php include_once('resources/views/layouts/footer.php') ?>