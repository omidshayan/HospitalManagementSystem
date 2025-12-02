<!-- start sidebar -->
<?php
$title = 'ویرایش دسته بندی: ' . $drug_categories['cat_name'];
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
?>
<!-- end sidebar -->

<!-- Start content -->
<div class="content">
    <div class="content-title"> ویرایش دسته بندی: <?= $drug_categories['cat_name'] ?>
        <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
    </div>
    <?php
    $help_title = 'راهنمای بخش مدیریت دروس';
    $help_content = 'در این قسمت ابتدا باید نام درس را وارد کنید، مثلا فتوشاپ ';
    include_once('resources/views/helps/help.php');
    ?>

    <div class="box-container">
        <div class="insert">
            <form id="myForm" action="<?= url('drug-cat-store') ?>" method="POST">
                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14"> نام دسته بندی <?= _star ?> </div>
                        <input type="text" name="cat_name" class="checkInput" value="<?= $drug_categories['cat_name'] ?>" placeholder="نام دسته بندی را وارد نمایید" autocomplete="off" />
                    </div>
                    <div class="one">
                        <div class="label-form mb5 fs14">توضیحات</div>
                        <textarea name="description" id="" placeholder="لطفا توضیحات را بنویسید..."><?= $drug_categories['description'] ?></textarea>
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