<!-- start sidebar -->
<?php
$title = 'تنظیمات عمومی';
include_once('resources/views/layouts/header.php');
include_once('public/alerts/error.php');
include_once('resources/views/scripts/activeNotActive.php');
?>
<!-- end sidebar -->
<style>
    .m-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 25px;
    }

    .m-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .m-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 25px;
    }

    .m-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 3.5px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.m-slider {
        background-color: #4CAF50;
    }

    input:checked+.m-slider:before {
        transform: translateX(24px);
    }
</style>

<div id="alert" class="alert" style="display: none;"><?= _error_programmer ?></div>
<!-- loading and overlay -->
<div class="overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>

<!-- Start content -->
<div class="content">
    <div class="content-title"> تنظیمات عمومی
    </div>

    <!-- change allow sell status invoce -->
    <div class="mini-container">
        <div class="allow-invoice d-flex justify-between">
            <span>
                چاپ نسخه در پنل داکتر
                <span id="sellStatus" class="status-text <?= ($settings['single_drug'] == 1) ? 'color-green' : 'color-orange' ?>">
                    (<?= ($settings['single_drug'] == 1) ? 'فعال' : 'غیر فعال' ?>)
                </span>
                <span class="tool-c">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"
                        width="16" height="16" fill="currentColor"
                        style="vertical-align: middle;" class="cursor-p">
                        <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM169.8 165.3c7.9-22.3 29.1-37.3 52.8-37.3l58.3 0c34.9 0 63.1 28.3 63.1 63.1c0 22.6-12.1 43.5-31.7 54.8L280 264.4c-.2 13-10.9 23.6-24 23.6c-13.3 0-24-10.7-24-24l0-13.5c0-8.6 4.6-16.5 12.1-20.8l44.3-25.4c4.7-2.7 7.6-7.7 7.6-13.1c0-8.4-6.8-15.1-15.1-15.1l-58.3 0c-3.4 0-6.4 2.1-7.5 5.3l-.4 1.2c-4.4 12.5-18.2 19-30.6 14.6s-19-18.2-14.6-30.6l.4-1.2zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                    </svg>
                    <div class="tool-t">
                        با غیر فعال کردن این قسمت، بعد از ثبت نسخه، نسخه توسط پنل داکتر چاپ می شود.
                        <div class="tool-arrow"></div>
                    </div>
                </span>
            </span>
            <label class="m-switch">
                <input
                    type="checkbox"
                    class="setting-toggle"
                    data-url="change-status-pre-print"
                    data-target="#sellStatus"
                    data-true-text="(فعال)"
                    data-false-text="(غیر فعال)"
                    data-true-class="color-green"
                    data-false-class="color-orange"
                    <?= ($settings['single_drug'] == 1) ? 'checked' : '' ?>>
                <span class="m-slider"></span>
            </label>
        </div>
    </div>

</div>
<!-- End content -->

<?php include_once('resources/views/layouts/footer.php') ?>