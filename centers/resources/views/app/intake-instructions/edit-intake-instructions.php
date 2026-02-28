<?php
$title = 'ویرایش  طریقه مصرف: ' . $intakeInstructions['intake_instructions'];
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
?>

<!-- Start content -->
<div class="content">
    <div class="content-title"> ویرایش طریقه مصرف: <?= $intakeInstructions['intake_instructions'] ?>
        <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
    </div>
    <?php
    $help_title = 'راهنمای بخش مدیریت دروس';
    $help_content = 'در این قسمت ابتدا باید نام درس را وارد کنید، مثلا فتوشاپ ';
    include_once('resources/views/helps/help.php');
    ?>
    <!-- start page content -->
    <div class="mini-container">
        <div class="insert">
            <form id="myForm" action="<?= url('edit-intake-instructions-store/' . $intakeInstructions['id']) ?>" method="POST">
                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14">طریقه مصرف <?= _star ?> </div>
                        <input type="text" name="intake_instructions" class="checkInput" value="<?= $intakeInstructions['intake_instructions'] ?>" placeholder="طریقه مصرف را وارد نمایید" autocomplete="off" />
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="submit" id="submit" value="ویــرایــش" class="btn bold" />
            </form>
        </div>
        <a href="<?= url('intake-instructions') ?>" class="color text-underline d-flex justify-center fs14">برگشت</a>
    </div>
</div>
<!-- End content -->

<?php include_once('resources/views/layouts/footer.php') ?>