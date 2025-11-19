<!-- start sidebar -->
<?php
$title = 'جزئیات مصرفی: ' . $expense['title_expense'];
include_once('resources/views/layouts/header.php');
include_once('resources/views/scripts/change-status.php');
include_once('resources/views/scripts/show-img-modal.php');
?>
<!-- end sidebar -->
<div id="alert" class="alert" style="display: none;">حالم بده، با برنامه نویس مه تماس بگیر :(</div>

<!-- loading and overlay -->
<div class="overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>
<!-- Start content -->
<div class="content">
    <div class="content-title"> جزئیات مصرفی: <?= $expense['title_expense'] ?></div>
    <br />
    <!-- start page content -->
    <div class="box-container">

        <div class="accordion-title color-orange">مشخصات عمومی</div>
        <div class="accordion-content">
            <div class="child-accordioin">
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">عنوان مصرفی: </div>
                    <div class="info-detaile"><?= $expense['title_expense'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">هزینه: </div>
                    <div class="info-detaile"><?= $expense['amount'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">پرداختی: </div>
                    <div class="info-detaile"><?= $expense['paid'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">باقیمانده: </div>
                    <div class="info-detaile"><?= $expense['remainder'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">تاریخ: </div>
                    <div class="info-detaile"><?= jdate('Y/m/d', strtotime($expense['created_at'])) ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">دسته بندی: </div>
                    <div class="info-detaile"><?= $expense['created_at'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">خرید توسط: </div>
                    <div class="info-detaile"><?= $expense['by_whom'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">ثبت شده توسط: </div>
                    <div class="info-detaile"><?= $expense['who_it'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">توضیحات: </div>
                    <div class="info-detaile"><?= ($expense['description'] ? $expense['description'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p align-center">
                    <div class="title-detaile">عکس محصول</div>
                    <div class="info-detaile d-flex align-center">
                        <?= $expense['image']
                            ? '<img class="w50 cursor-p" src="' . asset('public/images/expenses/' . $expense['image']) . '" alt="logo" onclick="openModal(\'' . asset('public/images/expenses/' . $expense['image']) . '\')">'
                            : ' - - - - ' ?>
                    </div>
                </div>
                <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile"><a href="#" data-url="<?= url('change-status-expense') ?>" data-id="<?= $expense['id'] ?>" class="changeStatus color btn p5 w100 m10 center" id="submit">تغییر وضعیت</a></div>
                    <div class="info-detaile">
                        <div class="w100 m10 center status status-column" id="status"><?= ($expense['state'] == 1) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
                    </div>
                </div>
            </div>
        </div>

        <a href="<?= url('expenses') ?>">
            <div class="btn center p5">برگشت</div>
        </a>
    </div>
    <!-- end page content -->
</div>
<!-- End content -->
<!-- show password -->
<script>
    var passwordField = document.getElementById('passwordDisplay');
    var eyeIcon = document.getElementById('eyeIcon');
    var isMouseDown = false;

    function showPassword() {
        passwordField.innerHTML = '<?= $expense['password'] ?>';
        eyeIcon.innerHTML = '&#128064;';
        isMouseDown = true;
    }

    function hidePassword() {
        if (isMouseDown) {
            passwordField.innerHTML = '<?= str_repeat('*', strlen($expense['password'])) ?>';
            eyeIcon.innerHTML = '&#128065;';
            isMouseDown = false;
        }
    }
</script>
<?php include_once('resources/views/layouts/footer.php') ?>