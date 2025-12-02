    <!-- start sidebar -->
    <?php
    $title = 'ویرایش کارمند: ' . $employee['employee_name'];
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/show-img-modal.php');
    ?>
    <!-- end sidebar -->

    <!-- Start content -->
    <div class="content">
        <div class="content-title">ویرایش کارمند: <?= $employee['employee_name'] ?></div>
        <br />
        <!-- start page content -->
        <div class="box-container">
            <div class="insert">
                <form action="<?= url('edit-employee/store/' . $employee['id']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام و تخلص <?= _star ?> </div>
                            <input type="text" class="checkInput" name="employee_name" placeholder="نام و تخلص را وارد نمایید" maxlength="40" value="<?= $employee['employee_name'] ?>" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">نام پدر</div>
                            <input type="text" name="father_name" placeholder="نام پدر را وارد نمایید" maxlength="40" value="<?= $employee['father_name'] ?>" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">شماره <?= _star ?> </div>
                            <input type="number" class="checkInput" name="phone" placeholder="شماره را وارد نمایید" value="<?= $employee['phone'] ?>" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">رمزعبور</div>
                            <input type="password" name="password" placeholder="رمزعبور را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">مقدار معاش<?= _star ?> </div>
                            <input type="number" class="checkInput" value="<?= $employee['salary_price'] ?>" name="salary_price" placeholder="مقدار معاش را وارد نمایید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">وظیفه</div>
                            <select name="position" id="mySelect" class="checkSelect">
                                <?php foreach ($positions as $position) : ?>
                                    <option value="<?= $position['name'] ?>" <?= $position['name'] == $employee['position'] ? 'selected' : '' ?>>
                                        <?= $position['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات را وارد نمایید"><?= $employee['description'] ?></textarea>
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
                        <img src="<?= ($employee['image'] ? asset('public/images/employees/' . $employee['image']) : asset('public/assets/img/empty.png')) ?>" onclick="openModal('<?php echo asset('public/images/employees/' . $employee['image']); ?>')"
                            class="img cursor-p" alt="logo">
                    </div>
                    <div class="fs11">تصویر فعلی</div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ویــرایــش" class="btn bold" />
                </form>
            </div>
            <a href="<?= url('employees') ?>" class="color text-underline d-flex justify-center fs14">برگشت</a>
        </div>
        <!-- end page content -->

    </div>
    <!-- End content -->

    <?php include_once('resources/views/layouts/footer.php') ?>