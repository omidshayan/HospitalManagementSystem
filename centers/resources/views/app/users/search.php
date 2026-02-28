    <!-- start sidebar -->
    <?php
    $title = 'خرید محصول جدید';
    include_once('resources/views/layouts/header.php');
    include_once('resources/views/scripts/live-search-user.php');
    include_once('public/alerts/toastr.php');
    include_once('public/alerts/check-inputs.php');
    ?>
    <!-- end sidebar -->

    <div class="overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <!-- Start content -->
    <div class="content">
        <div class="content-title"> خرید محصول جدید
            <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
        </div>
        <?php
        $help_title = _help_title;
        $help_content = _help_desc;
        include_once('resources/views/helps/help.php');
        ?>

        <div class="producInfos">
            <h5 class="d-none product-name">نام: <span></span></h5>
        </div>

        <!-- start page content -->
        <div class="search-content scroll-not">
            <div class="insert">
                <form action="<?= url('product-inventory-store') ?>" method="POST" enctype="multipart/form-data" id="myForm">

                    <!-- search users -->
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">جستجوی کاربر <?= _star ?> </div>
                            <?php $user = $user ?? ['id' => '', 'user_name' => '']; ?>

                            <input type="hidden" name="user_id" id="user_id" value="<?= !empty($user['id']) ? $user['id'] : '' ?>">

                            <input
                                type="text"
                                class="liveSearchInput"
                                value="<?= !empty($user['user_name']) ? $user['user_name'] : '' ?>"
                                placeholder="نام کاربر را جستجو نمایید"
                                autocomplete="off"
                                data-url="<?= url('live-search') ?>"
                                data-param="customer_name"
                                data-target-hidden="#user_id"
                                data-target-list="#backResponseSearch" />
                        </div>

                        <ul class="search-back d-none" id="backResponseSearch"></ul>
                    </div>



                    <div class="d-none my-form">
                        <!-- search purcharc -->

                        <div class="title-line m-auto">
                            <span class="color-tow fs14">تعداد کارتن / بسته - عدد / دانه‌ای</span>
                            <hr class="hr">
                        </div>

                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form mb5 fs14">تعداد بسته / کارتن </div>
                                <input type="number" value="0" id="packageCount" class="checkInputGroup" name="package_qty" placeholder="تعداد بسته یا کارتن را وارد نمایید" maxlength="40" />
                            </div>
                            <div class="one">
                                <div class="label-form mb5 fs14">تعداد عدد / دانه </div>
                                <input type="number" id="unitCount" class="checkInputGroup" value="0" name="unit_qty" placeholder="تعداد عدد یا دانه را وارد نمایید" maxlength="40" />
                            </div>
                        </div>
                        <span class="quantity"> تعداد عددی: </span>


                        <div class="title-line m-auto">
                            <span class="color-tow fs14">قیمت محصول</span>
                            <hr class="hr">
                        </div>

                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form mb5 fs14">قیمت خرید هر بسته / واحد <?= _star ?> </div>
                                <input type="text" class="checkInput" name="package_price_buy" placeholder="نام محصول را وارد نمایید" maxlength="40" />
                            </div>
                            <div class="one">
                                <div class="label-form mb5 fs14">قیمت فروش هر بسته / واحد <?= _star ?> </div>
                                <input type="text" class="checkInput" name="package_price_sell" placeholder="نام محصول را وارد نمایید" maxlength="40" />
                            </div>
                        </div>

                        <div class="inputs d-flex mb30">
                            <div class="one">
                                <div class="label-form mb5 fs14">قیمت خرید هر دانه / عدد <?= _star ?> </div>
                                <input type="text" class="" name="unit_price_buy" placeholder="نام محصول را وارد نمایید" maxlength="40" />
                            </div>
                            <div class="one">
                                <div class="label-form mb5 fs14">قیمت فروش هر دانه / عدد <?= _star ?> </div>
                                <input type="text" class="" name="unit_price_sell" placeholder="نام محصول را وارد نمایید" maxlength="40" />
                            </div>
                        </div>

                        <div class="title-line m-auto">
                            <span class="color-tow fs14 color-green">اطلاعات تکمیلی</span>
                            <hr class="hr">
                        </div>

                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form mb5 fs14">قیمت کل </div>
                                <input type="text" class="all_price" name="item_total_price" placeholder="قیمت کل" readonly />
                            </div>
                            <div class="one">
                                <div class="label-form mb5 fs14">تخفیف به این محصول</div>
                                <input type="text" name="discount" class="discount" placeholder="تخفیف را وارد نمائید" />
                            </div>
                        </div>

                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                        <input type="hidden" name="quantity_in_pack" value="" />
                        <input type="hidden" name="quantity" value="" />
                        <input type="submit" id="submit" value="ثبت" class="btn" />

                    </div>

                </form>
            </div>
        </div>
        <!-- end page content -->

    </div>

    <!-- date -->
    <script>
        $(document).ready(function() {

            $(".start").pDatepicker({
                format: 'YYYY-MM-DD',
                autoClose: true,
                toolbox: {
                    calendarSwitch: {
                        enabled: true
                    }
                },
                observer: true,
                altField: '.dateStart'
            });
        });
    </script>

    <?php include_once('resources/views/layouts/footer.php') ?>