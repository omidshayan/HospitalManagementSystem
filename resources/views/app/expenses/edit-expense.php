    <!-- start sidebar -->
    <?php
    $title = 'ویرایش مصرف: ' . $expense['title_expense'];
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/show-img-modal.php');
    ?>
    <!-- end sidebar -->

    <!-- Start content -->
    <div class="content">
        <div class="content-title"> ویرایش مصرفی: <?= $expense['title_expense'] ?>
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
                <form action="<?= url('edit-expense-store/' . $expense['id']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">عنوان مصرفی <?= _star ?> </div>
                            <input type="text" class="checkInput" value="<?= $expense['title_expense'] ?>" name="title_expense" placeholder="نام و تخلص را وارد نمایید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب دسته بندی <?= _star ?></div>
                            <select name="category" class="checkSelet">
                                <option disabled>لطفا دسته بندی را انتخاب نمایید</option>
                                <?php
                                foreach ($expenses_categories as $expenses_category) {
                                    $selected = ($expenses_category['id'] == $expense['category']) ? 'selected' : '';
                                ?>
                                    <option value="<?= $expenses_category['id'] ?>" <?= $selected ?>>
                                        <?= $expenses_category['cat_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">مبلغ هزینه <?= _star ?></div>
                            <input type="text" name="amount" class="checkInput" value="<?= $expense['amount'] ?>" placeholder="مبلغ را وارد نمایید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">پرداختی</div>
                            <input type="number" name="paid" value="<?= $expense['paid'] ?>" placeholder="مبلغ پرداختی را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب کارمند</div>
                            <select name="by_whom">
                                <option disabled>لطفا کارمند را انتخاب نمایید</option>
                                <?php
                                foreach ($employees as $employee) {
                                    $selected = ($employee['id'] == $expense['by_whom']) ? 'selected' : '';
                                ?>
                                    <option value="<?= $employee['id'] ?>" <?= $selected ?>>
                                        <?= $employee['employee_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات را وارد نمایید"><?= $expense['description'] ?></textarea>
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب عکس</div>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                    <div id="imagePreview">
                        <img src="" class="img" alt="">
                    </div>

                    <div>
                        <img src="<?= ($expense['image'] ? asset('public/images/expenses/' . $expense['image']) : asset('public/assets/img/empty.png')) ?>" onclick="openModal('<?php echo asset('public/images/expenses/' . $expense['image']); ?>')"
                            class="img cursor-p" alt="logo">
                    </div>
                    <div class="fs11">تصویر فعلی</div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ثبت" class="btn" />
                </form>
            </div>
            <a href="<?= url('expenses') ?>">
                <div class="color text-underline center p5">برگشت</div>
            </a>
        </div>
        <!-- end page content -->
    </div>
    <!-- End content -->

    <?php include_once('resources/views/layouts/footer.php') ?>