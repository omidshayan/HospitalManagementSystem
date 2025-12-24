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
                            <div class="label-form mb5 fs14">ایمیل </div>
                            <input type="text" name="email" placeholder="ایمیل را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات را وارد نمایید"></textarea>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">آدرس</div>
                            <textarea name="address" placeholder="آدرس را وارد نمایید"></textarea>
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
                                    <span> چاپ خودکار نسخه‌ها</span>
                                    <input type="checkbox" name="prescriptionPrint" id="prescriptionPrint" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="addPatient">
                                    <span> ثبت مریض</span>
                                    <input type="checkbox" name="addPatient" id="addPatient" class="w20 p0 m0 h22">
                                </label>
                            </div>
                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="showPatients">
                                    <span> نمایش مریضان</span>
                                    <input type="checkbox" name="showPatients" id="showPatients" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="addPrescription">
                                    <span> ثبت نسخه</span>
                                    <input type="checkbox" name="addPrescription" id="addPrescription" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="showPrescription">
                                    <span> نمایش نسخه‌ها</span>
                                    <input type="checkbox" name="showPrescription" id="showPrescription" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="addEmployee">
                                    <span> ثبت کارمند جدید</span>
                                    <input type="checkbox" name="addEmployee" id="addEmployee" class="w20 p0 m0 h22">
                                </label>
                            </div>
                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="showEmployees">
                                    <span> نمایش کارمندان</span>
                                    <input type="checkbox" name="showEmployees" id="showEmployees" class="w20 p0 m0 h22">
                                </label>
                            </div>
                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="positions">
                                    <span> مدیریت وظایف کارمندان</span>
                                    <input type="checkbox" name="positions" id="positions" class="w20 p0 m0 h22">
                                </label>
                            </div>


                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="parentAdmission">
                                    <span>پذیرش</span>
                                    <input type="checkbox" name="parentAdmission" id="parentAdmission" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="addAdmission">
                                    <span> پذیرش مریض</span>
                                    <input type="checkbox" name="addAdmission" id="addAdmission" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="admissions">
                                    <span> لیست پذیرش‌ها</span>
                                    <input type="checkbox" name="admissions" id="admissions" class="w20 p0 m0 h22">
                                </label>
                            </div>


                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="addDrug">
                                    <span> ثبت دارو</span>
                                    <input type="checkbox" name="addDrug" id="addDrug" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="showDrugs">
                                    <span> نمایش داروها</span>
                                    <input type="checkbox" name="showDrugs" id="showDrugs" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="catDrug">
                                    <span> مدیریت دسته بندی‌های دارو</span>
                                    <input type="checkbox" name="catDrug" id="catDrug" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="unitDrug">
                                    <span> مدیریت واحد شمارش</span>
                                    <input type="checkbox" name="unitDrug" id="unitDrug" class="w20 p0 m0 h22">
                                </label>
                            </div>

                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="numberDrugs">
                                    <span> مدیریت تعداد دارو</span>
                                    <input type="checkbox" name="numberDrugs" id="numberDrugs" class="w20 p0 m0 h22">
                                </label>
                            </div>
                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="intakeTime">
                                    <span> مدیریت زمان مصرف</span>
                                    <input type="checkbox" name="intakeTime" id="intakeTime" class="w20 p0 m0 h22">
                                </label>
                            </div>
                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="dosage">
                                    <span> مدیریت مقدار مصرف</span>
                                    <input type="checkbox" name="dosage" id="dosage" class="w20 p0 m0 h22">
                                </label>
                            </div>
                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="intakeInstructions">
                                    <span> مدیریت طریقه مصرف</span>
                                    <input type="checkbox" name="intakeInstructions" id="intakeInstructions" class="w20 p0 m0 h22">
                                </label>
                            </div>
                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="tests">
                                    <span> مدیریت آزمایشات</span>
                                    <input type="checkbox" name="tests" id="tests" class="w20 p0 m0 h22">
                                </label>
                            </div>
                            <div class="detailes-culomn d-flex cursor-p h30 align-center">
                                <label class="title-detaile d-flex justify-between w100 h30 align-center cursor-p" for="settingPrescription">
                                    <span> تنظیمات نسخه</span>
                                    <input type="checkbox" name="settingPrescription" id="settingPrescription" class="w20 p0 m0 h22">
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