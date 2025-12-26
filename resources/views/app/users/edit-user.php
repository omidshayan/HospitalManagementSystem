    <!-- start sidebar -->
    <?php
    $title = 'ویرایش کاربر: ' . $user['user_name'];
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    ?>
    <!-- end sidebar -->

    <!-- Start content -->
    <div class="content">
        <div class="content-title">ویرایش کاربر: <?= $user['user_name'] ?></div>

        <!-- start page content -->
        <div class="box-container">
            <div class="insert">
                <form action="<?= url('edit-user/store/' . $user['id']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام و تخلص <?= _star ?> </div>
                            <input type="text" class="checkInput" name="user_name" placeholder="نام و تخلص را وارد نمایید" maxlength="40" value="<?= $user['user_name'] ?>" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">سن <?= _star ?></div>
                            <input type="number" name="birth_year" id="ageInput" value="<?= $this->getAge($user['birth_year']) ?>" class="checkInput" placeholder="سن مریض را وارد نمائید">
                        </div>

                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام پدر</div>
                            <input type="text" name="father_name" placeholder="نام پدر را وارد نمایید" maxlength="40" value="<?= $user['father_name'] ?>" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">شماره </div>
                            <input type="number" name="phone" placeholder="شماره را وارد نمایید" value="<?= $user['phone'] ?>" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">آدرس</div>
                            <textarea name="address" placeholder="توضیحات را وارد نمایید"><?= $user['address'] ?></textarea>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات را وارد نمایید"><?= $user['description'] ?></textarea>
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
                        <img src="<?= ($user['image'] ? asset('public/images/users/' . $user['image']) : asset('public/assets/img/empty.png')) ?>" class="img" alt="user image">
                    </div>
                    <div class="fs11">تصویر فعلی</div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="<?= _edit_btn ?>" class="btn" />
                </form>
            </div>
            <a href="<?= url('patients') ?>" class="color text-underline d-flex justify-center fs14">برگشت</a>
        </div>
        <!-- end page content -->

    </div>
    <!-- End content -->

    <?php include_once('resources/views/layouts/footer.php') ?>