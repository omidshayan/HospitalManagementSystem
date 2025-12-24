    <!-- start sidebar -->
    <?php
    $title = 'پذیریش جدید';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/live-search-users.php');
    ?>
    <!-- end sidebar -->

    <!-- Start content -->
    <div class="content">
        <div class="content-title">پذیریش جدید
            <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
        </div>
        <?php
        $help_title = _help_title;
        $help_content = _help_desc;
        include_once('resources/views/helps/help.php');
        include_once('resources/views/scripts/search.php');
        ?>

        <!-- search box -->
        <div class=" flex-justify-align mb10">
            <div class="border search-database-s flex-justify-align">
                <a href="#" class="color search-icon-database-s">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-10 search-icon w17">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </a>
                <input type="text" class="p5 fs15 input w100" id="search_seller" placeholder="جستجوی مریض..." autofocus />
                <ul class="search-back t34 d-none" id="backResponseSeller">
                    <li class="resSel search-item color" role="option"></li>
                </ul>
            </div>
        </div>

        <!-- start page content -->
        <div class="box-container">
            <div class="insert">
                <form action="<?= url('admission/store') ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام و تخلص <?= _star ?> </div>
                            <input type="text" class="checkInput" name="user_name" placeholder="نام و تخلص را وارد نمایید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">سن <?= _star ?></div>
                            <input type="number" id="ageInput" class="checkInput" placeholder="سن مریض را وارد نمائید">
                            <input type="hidden" name="birth_year" id="birthYearInput">
                        </div>
                    </div>

                    <input type="hidden" name="user_id" id="user_id">

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام پدر</div>
                            <input type="text" name="father_name" placeholder="نام پدر را وارد نمایید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">شماره </div>
                            <input type="number" name="phone" placeholder="شماره را وارد نمایید" />
                        </div>
                    </div>
                    <div class="d-none">
                        <strong id="birthYear"></strong>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">آدرس</div>
                            <textarea name="address" placeholder="آدرس را وارد نمایید"></textarea>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات را وارد نمایید"></textarea>
                        </div>
                    </div>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب عکس</div>
                            <input type="file" id="image" name="image" accept="image/jpeg, image/png, image/gif">
                        </div>
                    </div>
                    <div id="imagePreview">
                        <img src="" class="img" alt="">
                    </div>


                    <!-- <div class="accordion-title color-orange mb5">اطلاعات تکمیلی</div>
                    <div class="accordion-content-pre">
                        <div class="child-accordioin">
                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">قد</div>
                                    <input type="text" placeholder="قد را وارد نمایید" maxlength="40" />
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">وزن </div>
                                    <input type="number" placeholder="وزن را وارد نمایید" />
                                </div>
                            </div>
                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">فشار خون</div>
                                    <input type="text" placeholder="فشار خون را وارد نمایید" maxlength="40" />
                                </div>
                                <div class="one">
                                    <div class="label-form mb5 fs14">نبض </div>
                                    <input type="number" placeholder="نبض را وارد نمایید" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-title color-orange">ثبت علائم حیاطی</div>
                    <div class="accordion-content-pre">
                        <div class="child-accordioin">
                            <div class="insert dir-left mt5">
                                <div class="one m-auto w97d mb3">
                                    <input type="text" placeholder=" Blood Pressure  ">
                                </div>
                                <div class="one m-auto w97d mb3">
                                    <input type="text" placeholder=" Pulse Rate  ">
                                </div>
                                <div class="one m-auto w97d mb3">
                                    <input type="text" placeholder=" Respiratory Rate  ">
                                </div>
                                <div class="one m-auto w97d mb3">
                                    <input type="text" placeholder=" Temperature  ">
                                </div>
                                <div class="one m-auto w97d mb3">
                                    <input type="text" placeholder=" Oxygen Saturation  ">
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ثبت" class="btn" />
                </form>
            </div>
        </div>
        <!-- end page content -->
    </div>
    <!-- End content -->

    <!-- // copy text in input name -->
    <script type="text/javascript">
        document.getElementById("search_seller").addEventListener("input", function() {
            document.querySelector("input[name='user_name']").value = this.value;
        });
    </script>

    <?php include_once('resources/views/layouts/footer.php') ?>