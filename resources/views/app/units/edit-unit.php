    <?php
    $title = 'ویرایش واحد: ' . $unit['unit_name'];
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/error.php');
    ?>

    <!-- Start content -->
    <div class="content">
        <div class="content-title">ویرایش واحد: <?= $unit['unit_name'] ?></div>
        <!-- start page content -->

        <div class="box-container">
            <div class="insert">
                <form id="myForm" action="unit-store" method="POST">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام واحد <?= _star ?> </div>
                            <input type="text" name="unit_name" class="checkInput" value="<?= $unit['unit_name'] ?>" placeholder="نام واحد شمارش را وارد نمایید" autocomplete="off" />
                        </div>
                    </div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="submit" id="submit" value="ثــبــت" class="btn bold" />
                </form>
            </div>
            <a href="<?= url('units') ?>" class="color text-underline d-flex justify-center fs14">برگشت</a>
        </div>

        <!-- end page content -->
    </div>
    <!-- End content -->

    <?php include_once('resources/views/layouts/footer.php') ?>