<!-- start sidebar -->
<?php
$title = 'ویرایش  تولید کننده: ' . $company['name'];
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
?>
<!-- end sidebar -->

<!-- Start content -->
<div class="content">
    <div class="content-title"> ویرایش تولید کننده: <?= $company['name'] ?>
        <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
    </div>
    <?php
    $help_title = 'عنوان بخش';
    $help_content = 'در این قسمت راهنما قرار میگیرد ';
    include_once('resources/views/helps/help.php');
    ?>
    <!-- start page content -->
    <div class="mini-container">
        <div class="insert">
            <form id="myForm" action="<?= url('edit-company-store/' . $company['id']) ?>" method="POST">
                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14">نام / تولید کننده <?= _star ?> </div>
                        <input type="text" name="name" class="checkInput" value="<?= $company['name'] ?>" placeholder="نام کشور یا تولید کننده را وارد نمایید" autocomplete="off" />
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="submit" id="submit" value="ویــرایــش" class="btn bold" />
            </form>
        </div>
        <a href="<?= url('companies') ?>" class="color text-underline d-flex justify-center fs14">برگشت</a>
    </div>
</div>
<!-- End content -->

<?php include_once('resources/views/layouts/footer.php') ?>