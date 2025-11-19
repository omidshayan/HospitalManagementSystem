<!-- start sidebar -->
<?php
$title = 'جزئیات کاربر: ' . $user['name'];
include_once('resources/views/layouts/header.php');
include_once('resources/views/scripts/change-status.php');
?>
<!-- end sidebar -->
<div id="alert" class="alert" style="display: none;">حالم بده، با برنامه نویس مه تماس بگیر :(</div>

<!-- loading and overlay -->
<div class="overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>
<!-- Start content -->


<div class="content">

    <div class="content-title d-flex justify-between">
        <span class="" id="openModalBtn"> <span class="content-title"> جزئیات کارمند : <?= $user['name'] ?></span>
        </span>
    </div>

    <!-- start page content -->
    <div class="box-container">

        <div class="accordion-title color-orange">مشخصات عمومی</div>
        <div class="accordion-content">
            <div class="child-accordioin">
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نام</div>
                    <div class="info-detaile"><?= $user['name'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نام پدر</div>
                    <div class="info-detaile"><?= ($user['father_name'] ? $user['father_name'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">شماره</div>
                    <div class="info-detaile"><?= $user['phone'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">آدرس</div>
                    <div class="info-detaile"><?= ($user['address'] ? $user['address'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">توضیحات</div>
                    <div class="info-detaile"><?= ($user['description'] ? $user['description'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">تاریخ ثبت</div>
                    <div class="info-detaile"><?= jdate('Y/m/d', strtotime($user['created_at'])) ?></div>
                </div>
                <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile">عکس</div>
                    <div class="info-detaile">
                        <?= ($user['image'] ? '<a href="' . asset('public/images/users/' . $user['image']) . '" target="_blank"><img src="' . asset('public/images/users/' . $user['image']) . '" class="w50" alt=""></a>' : '- - - - ') ?>
                    </div>
                </div>
                <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile"><a href="#" data-url="<?= url('change-status-user') ?>" data-id="<?= $user['id'] ?>" class="changeStatus color btn p5 w100 m10 center" id="submit">تغییر وضعیت</a></div>
                    <div class="info-detaile">
                        <div class="w100 m10 center status status-column" id="status"><?= ($user['state'] == 1) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-title color-orange">مشخصات مالی</div>
        <div class="accordion-content">
            <div class="child-accordioin">
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نام</div>
                    <div class="info-detaile"><?= $user['name'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نام پدر</div>
                    <div class="info-detaile"><?= ($user['father_name'] ? $user['father_name'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">شماره</div>
                    <div class="info-detaile"><?= $user['phone'] ?></div>
                </div>
            </div>
        </div>

        <a href="<?= url('users') ?>">
            <div class="btn center p5">برگشت</div>
        </a>
    </div>
    <!-- end page content -->
</div>
<!-- End content -->

<?php include_once('resources/views/layouts/footer.php') ?>