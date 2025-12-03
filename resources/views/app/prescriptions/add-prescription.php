    <?php
    $title = 'ثبت نسخه';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/search.php');
    ?>

    <!-- Start content -->
    <div class="content">
        <div class="content-title">ثبت نسخه جدید</div>
        <!-- start page content -->


        <form action="<?= url('drug-prescription-store') ?>" method="POST">

            <!-- select details drug -->
            <div class="box-container">
                <div class="insert">

                    <!-- search box -->
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">جستجوی دارو <?= _star ?> </div>
                            <input type="hidden" name="drug_id" id="item_id">
                            <input type="text"
                                class="checkInput"
                                name="drug_name"
                                id="item_name"
                                placeholder="نام دارو را جستجو نمایید"
                                autocomplete="off"
                                autofocus
                                data-search-url="<?= url('search-product-purchase') ?>" />
                        </div>
                        <ul class="search-back d-none" id="backResponse">
                            <li class="res search-item color" role="option"></li>
                        </ul>
                    </div>
                    <br>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14"> تعداد دارو </div>
                            <select name="drug_count" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14"> زمان مصرف </div>
                            <select name="interval_time" required>
                                <option value="بعد از غذا">بعد از غذا</option>
                                <option value="قبل از غذا">قبل از غذا</option>
                                <option value="1">هر 1 ساعت</option>
                                <option value="1">هر 2 ساعت</option>
                                <option value="1">هر 3 ساعت</option>
                                <option value="1">هر 4 ساعت</option>
                                <option value="2">دو بار در روز</option>
                                <option value="1">یک بار در روز</option>
                                <option value="4">چهار بار در روز</option>
                            </select>
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">مقدار / واحد مصرف در هر نوبت</div>
                            <select name="dosage" required>
                                <option value="1">یک قاشق</option>
                                <option value="1">دو قاشق</option>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">طریقه مصرف</div>
                            <select name="usage_instruction" required>
                                <option value="1">خوراکی</option>
                                <option value="1">دو قاشق</option>
                            </select>
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات اضافی</div>
                            <textarea name="description" placeholder="توضیحات را وارد نمایید"></textarea>
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

    <?php include_once('resources/views/layouts/footer.php') ?>