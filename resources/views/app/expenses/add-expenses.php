    <!-- start sidebar -->
    <?php
    $title = 'ثبت مصرف';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php'); ?>
    <!-- end sidebar -->

    <!-- Start content -->
    <div class="content">
        <div class="content-title">ثبت مصرفی جدید
            <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
        </div>
        <?php
        $help_title = 'راهنمای بخش مدیریت دروس';
        $help_content = 'در این قسمت ابتدا باید نام درس را وارد کنید، مثلا فتوشاپ ';
        include_once('resources/views/helps/help.php');
        ?>
        <br />
        <!-- start page content -->
        <div class="box-container">
            <div class="insert">
                <form action="<?= url('expense-store') ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">عنوان مصرفی <?= _star ?> </div>
                            <input type="text" class="checkInput" name="title_expense" placeholder="نام و تخلص را وارد نمایید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب دسته بندی <?= _star ?></div>
                            <select name="category" class="checkSelect">
                                <option selected disabled>لطفا دسته بندی را انتخاب نمایید</option>
                                <?php
                                foreach ($expenses_categories as $expenses_category) { ?>
                                    <option value="<?= $expenses_category['id'] ?>"><?= $expenses_category['cat_name'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">مبلغ هزینه <?= _star ?></div>
                            <input type="text" name="amount" class="checkInput" placeholder="مبلغ را وارد نمایید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">پرداختی</div>
                            <input type="number" name="paid" placeholder="مبلغ پرداختی را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب کارمند</div>
                            <select name="by_whom">
                                <option selected disabled>لطفا کارمند را انتخاب نمایید</option>
                                <?php
                                foreach ($by_whom_employees as $by_whom_employee) { ?>
                                    <option value="<?= $by_whom_employee['id'] ?>"><?= $by_whom_employee['employee_name'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات را وارد نمایید"></textarea>
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب فاکتور مصرفی</div>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                    <div id="imagePreview">
                        <img src="" class="img" alt="">
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ثبت" class="btn" />
                </form>
            </div>
        </div>
        <!-- end page content -->
    </div>
    <!-- End content -->

    <?php include_once('resources/views/layouts/footer.php') ?>