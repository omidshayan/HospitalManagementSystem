<?php
$title = 'جزئیات دارو: ' . $drug['name'];
include_once('resources/views/layouts/header.php');
include_once('resources/views/scripts/change-status.php');
include_once('resources/views/scripts/show-img-modal.php');
?>

<div id="alert" class="alert" style="display: none;">مشکل در تغییر وضعیت، لطفا با برنامه نویس تماس بگیرید!</div>

<!-- loading and overlay -->
<div class="overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>
<!-- Start content -->
<div class="content">
    <div class="content-title"> جزئیات دارو : <?= $drug['name'] ?></div>
    <!-- start page content -->
    <div class="box-container">

        <div class="accordion-title color-orange">مشخصات عمومی</div>
        <div class="accordion-content">
            <div class="child-accordioin">
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نام: </div>
                    <div class="info-detaile"><?= $drug['name'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نام انحصاری: </div>
                    <div class="info-detaile"><?= ($drug['generic_name'] ? $drug['generic_name'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">دسته بندی: </div>
                    <div class="info-detaile"><?= $drug['cat_name'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">واحد شمارش: </div>
                    <div class="info-detaile"><?= $drug['unit_name'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">تولید کننده: </div>
                    <div class="info-detaile"><?= ($drug['manufacturer'] ? $drug['manufacturer'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">تاریخ ثبت: </div>
                    <div class="info-detaile"><?= jdate('Y/m/d', strtotime($drug['created_at'])) ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">توضیحات: </div>
                    <div class="info-detaile"><?= ($drug['description'] ? $drug['description'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">ثبت شده توسط: </div>
                    <div class="info-detaile"><?= $drug['who_it'] ?></div>
                </div>

                <div class="detailes-culomn d-flex cursor-p align-center">
                    <div class="title-detaile">عکس دارو</div>
                    <div class="info-detaile d-flex align-center">
                        <?= $drug['image']
                            ? '<img class="w50 cursor-p" src="' . asset('public/images/drugs/' . $drug['image']) . '" alt="logo" onclick="openModal(\'' . asset('public/images/drugs/' . $drug['image']) . '\')">'
                            : ' - - - - ' ?>
                    </div>
                </div>

                <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile">
                        <a href="" data-url="<?= url('change-status-drug') ?>" data-id="<?= $drug['id'] ?>" class="changeStatus color btn p5 w100 m10 center" id="submit">تغییر وضعیت</a>
                    </div>
                    <div class="info-detaile">
                        <div class="w100 m10 center status status-column" id="status"><?= ($drug['status'] == 1) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
                    </div>
                </div>

            </div>
        </div>

        <a href="<?= url('drugs') ?>">
            <div class="btn center p5">برگشت</div>
        </a>
    </div>
    <!-- end page content -->
</div>
<!-- End content -->

<?php include_once('resources/views/layouts/footer.php') ?>