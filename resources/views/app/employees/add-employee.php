    <!-- start sidebar -->
    <?php
    $title = 'ثبت کارمند';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php'); ?>
    <!-- end sidebar -->

    <!-- Start content -->
    <div class="content">
        <div class="content-title">ثبت کارمند جدید</div>
        <!-- start page content -->
        <div class="box-container">
            <div class="insert">
                <form action="<?= url('employee-store') ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام و تخلص <?= _star ?> </div>
                            <input type="text" class="checkInput" name="employee_name" placeholder="نام و تخلص را وارد نمایید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">شماره <?= _star ?> </div>
                            <input type="number" class="checkInput" id="phone" name="phone" placeholder="شماره را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">رمزعبور<?= _star ?> </div>
                            <input type="password" class="checkInput" id="salary_price" name="password" placeholder="رمزعبور را وارد نمایید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">تخصص </div>
                            <input type="text" name="expertise" placeholder="تخصص را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">وظیفه</div>
                            <select name="position" id="mySelect" class="checkSelect">
                                <option selected disabled>انتخاب وظیفه</option>
                                <?php
                                foreach ($positions as $position) { ?>
                                    <option value="<?= $position['name'] ?>"><?= $position['name'] ?></option>
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
                            <div class="label-form mb5 fs14">انتخاب عکس</div>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                    <div id="imagePreview">
                        <img src="" class="img" alt="">
                    </div>

                    <div class="accordion-title color-orange">تعیین سطح دسترسی</div>
                    <div class="accordion-content">
                        <div class="child-accordioin">

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="prescriptionPrint">
                                    <span> صفحه چاپ نسخه‌ها</span>
                                    <input type="checkbox" name="prescriptionPrint" id="prescriptionPrint" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="showPatients">
                                    <span> نمایش مریضان</span>
                                    <input type="checkbox" name="showPatients" id="showPatients" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            
                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="showPatients">
                                    <span> مدیریت نسخه‌ها</span>
                                    <input type="checkbox" name="showPatients" id="showPatients" class="w20 p0 m0 h22">
                                </label>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ثبت" class="btn" />
                </form>
            </div>
        </div>
        <!-- end page content -->
    </div>
    <!-- End content -->

    <script>
        document.getElementById('phone').addEventListener('input', function() {
            document.getElementById('salary_price').value = this.value;
        });
    </script>
    <?php include_once('resources/views/layouts/footer.php') ?>