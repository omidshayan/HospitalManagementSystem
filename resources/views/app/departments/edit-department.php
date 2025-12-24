<!-- start sidebar -->
<?php
$title = 'ویرایش  دپارمنت: ' . $department['name'];
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
?>
<!-- end sidebar -->

<!-- Start content -->
<div class="content">
    <div class="content-title"> ویرایش دپارمنت: <?= $department['name'] ?>
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
            <form id="myForm" action="<?= url('edit-department-store/' . $department['id']) ?>" method="POST">
                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14"><?= _name ?> <?= _star ?> </div>
                        <input type="text" name="name" class="checkInput" value="<?= $department['name'] ?>" placeholder="مقدار مصرف را وارد نمایید" autocomplete="off" />
                    </div>
                </div>
                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14">مسئول دپارتمنت <?= _star ?> </div>
                        <select name="manager_id" class="checkSelect">
                            <option disabled>لطفا مسئول دپارتمنت رو انتخاب نمائید</option>
                            <?php
                            foreach ($users as $user) { ?>
                                <option value="<?= $user['id'] ?>"
                                    <?= (isset($department['manager_id']) && $department['manager_id'] == $user['id']) ? 'selected' : '' ?>>
                                    <?= $user['employee_name'] ?>
                                </option>
                            <?php }
                            ?>
                        </select>

                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="submit" id="submit" value="ویــرایــش" class="btn bold" />
            </form>
        </div>
        <a href="<?= url('dosage') ?>" class="color text-underline d-flex justify-center fs14">برگشت</a>
    </div>
</div>
<!-- End content -->

<?php include_once('resources/views/layouts/footer.php') ?>