    <!-- start sidebar -->
    <?php
    $title = 'ثبت داروی جدید';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php'); ?>
    <!-- end sidebar -->

    <!-- Start content -->
    <div class="content">
        <div class="content-title">ثبت داروی جدید</div>
        <!-- start page content -->
        <div class="box-container">
            <div class="insert">
                <form action="<?= url('drug-store') ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14"> نام دارو <?= _star ?> </div>
                            <input type="text" class="checkInput" name="name" placeholder="نام دارو را وارد نمایید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14"> نام انحصاری </div>
                            <input type="text" class="checkInput" name="generic_name" placeholder="نام انحصاری دارو را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">انتخاب دسته بندی</div>
                            <select name="category_id" class="checkSelect">
                                <option selected disabled>دسته بندی را انتخاب نمائید</option>
                                <?php
                                foreach ($drugCategories as $drugCategory) { ?>
                                    <option value="<?= $drugCategory['id'] ?>"><?= $drugCategory['cat_name'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">انتخاب واحد شمارش</div>
                            <select name="unit" class="checkSelect">
                                <option selected disabled>واحد شمارش را انتخاب نمائید</option>
                                <?php
                                foreach ($units as $unit) { ?>
                                    <option value="<?= $unit['id'] ?>"><?= $unit['unit_name'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">قیمت </div>
                            <input type="text" name="price" value="" placeholder="قیمت دارو را وارد نمایید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">تولید کننده </div>
                            <input type="text" name="manufacturer" value="" placeholder="تولید کننده دارو را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات را وارد نمایید"></textarea>
                        </div>
                    </div>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب عکس دارو</div>
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