    <!-- start sidebar -->
    <?php
    $title = 'ثبت نسخه';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php'); ?>
    <!-- end sidebar -->

    <!-- Start content -->
    <div class="content">
        <div class="content-title">ثبت نسخه جدید</div>
        <!-- start page content -->
        <div class="box-container">
            <div class="insert">

                <!-- search product -->
                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14">جستجوی دارو <?= _star ?> </div>
                        <input type="hidden" id="product_id">
                        <div id="user_details"></div>
                        <input type="text" class="checkInput" name="product_name" id="product_name" placeholder="نام دارو را جستجو نمایید" autocomplete="off" autofocus />
                    </div>
                    <ul class="search-back d-none" id="backResponse">
                        <li class="res search-item color" role="option"></li>
                    </ul>
                </div>
                <br>


                <form action="<?= url('employee-store') ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14"> طریقه مصرف </div>
                            <select name="frequency" required>
                                <option value="1">هر 1 ساعت</option>
                                <option value="1">هر 2 ساعت</option>
                                <option value="1">هر 3 ساعت</option>
                                <option value="1">هر 4 ساعت</option>
                                <option value="2">دو بار در روز</option>
                                <option value="1">یک بار در روز</option>
                                <option value="2">دو بار در روز</option>
                                <option value="3">سه بار در روز</option>
                                <option value="4">چهار بار در روز</option>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">مقدار مصرف در هر نوبت</div>
                            <select name="frequency" required>
                                <option value="1">یک قاشق</option>
                                <option value="1">دو قاشق</option>
                            </select>
                        </div>
                    </div>
                    <div class="inputs d-flex">

                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">زمان مصرف نسبت به غذا</div>
                            <select name="food_relation">
                                <option value="before">قبل از غذا</option>
                                <option value="after">بعد از غذا</option>
                                <option value="with">همزمان با غذا</option>
                                <option value="none">بدون توجه به غذا</option>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">مدت زمان مصرف </div>
                            <select name="duration_unit">
                                <option value="day">دو روز</option>
                                <option value="week">سه روز</option>
                                <option value="month">چهار روز</option>
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