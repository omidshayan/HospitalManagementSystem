    <?php
    $title = 'ثبت داروی جدید';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/search-items.php');
    ?>

    <!-- Start content -->
    <div class="content">
        <div class="content-title">ثبت داروی جدید</div>
        <!-- start page content -->

        <!-- search box -->
        <div class=" flex-justify-align mb10">
            <div class="border search-database-s flex-justify-align">
                <a href="#" class="color search-icon-database-s">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-10 search-icon w17">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </a>
                <input
                    type="text"
                    class="p5 fs15 input w100 live-search"
                    placeholder="جستجوی مریض..."
                    autofocus
                    id="search_seller"
                    data-search-url="<?= url('search-drug') ?>"
                    data-request-key="drug_name"

                    data-display-keys="name"

                    data-value-key="name"
                    data-id-key="id"

                    data-target-id="#user_id"
                    data-target-name="#patient_name" />

                <ul class="search-back t34 d-none live-search-result">
                    <li class="resSel search-item color" role="option"></li>
                </ul>
            </div>
        </div>

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
                            <input type="text" name="generic_name" placeholder="نام انحصاری دارو را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">انتخاب دسته بندی <?= _star ?></div>
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
                            <select name="unit">
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
                            <div class="label-form mb5 fs14">تولید کننده </div>
                            <input type="text" name="manufacturer" value="" placeholder="تولید کننده دارو را وارد نمایید" />
                        </div>
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

    <!-- copy text search -->
    <script type="text/javascript">
        document.getElementById("search_seller").addEventListener("input", function() {
            document.querySelector("input[name='name']").value = this.value;
        });
    </script>

    <?php include_once('resources/views/layouts/footer.php') ?>