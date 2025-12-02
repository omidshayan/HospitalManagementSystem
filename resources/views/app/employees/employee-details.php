<!-- start sidebar -->
<?php
$title = 'جزئیات کارمند: ' . $employee['employee_name'];
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
    <div class="content-title"> جزئیات کارمند : <?= $employee['employee_name'] ?></div>
    <br />
    <!-- start page content -->
    <div class="box-container">

        <div class="accordion-title color-orange">مشخصات عمومی</div>
        <div class="accordion-content">
            <div class="child-accordioin">
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نام: </div>
                    <div class="info-detaile"><?= $employee['employee_name'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">ایمیل: </div>
                    <div class="info-detaile"><?= ($employee['father_name'] ? $employee['father_name'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">شماره: </div>
                    <div class="info-detaile"><?= $employee['phone'] ?></div>
                </div>
                <!-- <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile">رمزعبور: </div>
                    <div class="info-detaile" id="passwordDisplay"><?= str_repeat('*', strlen($employee['password'])) ?></div>
                    <div class="eye-icon" onmousedown="showPassword()" onmouseup="hidePassword()">
                        <span id="eyeIcon" style="font-size: 18px;">&#128065;</span>
                    </div>
                </div> -->
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">وظیفه: </div>
                    <div class="info-detaile"><?= $employee['position'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">تاریخ ثبت: </div>
                    <div class="info-detaile"><?= jdate('Y/m/d', strtotime($employee['created_at'])) ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">آدرس: </div>
                    <div class="info-detaile"><?= ($employee['address'] ? $employee['address'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">توضیحات: </div>
                    <div class="info-detaile"><?= ($employee['description'] ? $employee['description'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">ثبت شده توسط: </div>
                    <div class="info-detaile"><?= $employee['who_it'] ?></div>
                </div>

                <div class="detailes-culomn d-flex cursor-p align-center">
                    <div class="title-detaile">عکس کارمند</div>
                    <div class="info-detaile d-flex align-center">
                        <?= $employee['image']
                            ? '<img class="w50 cursor-p" src="' . asset('public/images/employees/' . $employee['image']) . '" alt="logo" onclick="openModal(\'' . asset('public/images/employees/' . $employee['image']) . '\')">'
                            : ' - - - - ' ?>
                    </div>
                </div>

                <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile">
                        <a href="" data-url="<?= url('change-status-employee') ?>" data-id="<?= $employee['id'] ?>" class="changeStatus color btn p5 w100 m10 center" id="submit">تغییر وضعیت</a>
                    </div>
                    <div class="info-detaile">
                        <div class="w100 m10 center status status-column" id="status"><?= ($employee['state'] == 1) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- <div class="accordion-title color-orange">اطلاعات مالی و معاش</div>
        <div class="accordion-content">
            <div class="child-accordioin">
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نوع حضور: </div>
                    <div class="info-detaile">
                        <?php if ($employee['agreement_type'] == 1) {
                            echo 'پارت تایم';
                        } elseif ($employee['agreement_type'] == 2) {
                            echo 'فول تایم';
                        } else {
                            echo 'قراردادی';
                        } ?>
                    </div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نوع معاش: </div>
                    <div class="info-detaile"><?= ($employee['type_salary'] == 1) ? 'ساعتی' : 'ماهوار' ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">مقدار معاش: </div>
                    <div class="info-detaile"><?= $employee['salary_price'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">کل دریافتی: </div>
                    <div class="info-detaile"><?= $employee['salary_price'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">طلبکار: </div>
                    <div class="info-detaile"><?= $employee['salary_price'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">بدهکار: </div>
                    <div class="info-detaile"><?= $employee['salary_price'] ?></div>
                </div>
            </div>
        </div> -->

        <a href="<?= url('employees') ?>">
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
        passwordField.innerHTML = '<?= $employee['password'] ?>';
        eyeIcon.innerHTML = '&#128064;';
        isMouseDown = true;
    }

    function hidePassword() {
        if (isMouseDown) {
            passwordField.innerHTML = '<?= str_repeat('*', strlen($employee['password'])) ?>';
            eyeIcon.innerHTML = '&#128065;';
            isMouseDown = false;
        }
    }
</script>
<?php include_once('resources/views/layouts/footer.php') ?>