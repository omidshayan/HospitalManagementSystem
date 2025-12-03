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


        <div class="search-content scroll-not">
            <div class="insert">
                <form action="<?= url('product-inventory-store') ?>" method="POST" enctype="multipart/form-data" id="myForm">

                    <!-- search product -->
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">جستجوی محصول <?= _star ?> </div>
                            <input type="hidden" name="product_id" id="item_id">
                            <input type="text"
                                class="checkInput"
                                name="product_name"
                                id="item_name"
                                placeholder="نام محصول را جستجو نمایید"
                                autocomplete="off"
                                autofocus
                                data-search-url="<?= url('search-product-purchase') ?>"
                                data-item-info-url="<?= url('get-product-infos') ?>" />
                        </div>
                        <ul class="search-back d-none" id="backResponse">
                            <li class="res search-item color" role="option"></li>
                        </ul>
                    </div>

                    <!-- table -->
                    <div class="d-none my-form">
                        <!-- search purcharc -->
                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form mb5 fs14">جستجوی فروشنده <?= _star ?> </div>
                                <?php
                                $seller = $seller ?? ['id' => '', 'user_name' => ''];
                                ?>
                                <input type="hidden" name="seller_id" id="seller_id" value="<?= !empty($seller['id']) ? $seller['id'] : '' ?>">
                                <div id="user_details"></div>
                                <input type="text" class="checkInput" name="search_seller" id="search_seller" value="<?= !empty($user['user_name']) ? $user['user_name'] : '' ?>" placeholder="نام فروشنده را جستجو نمایید" autocomplete="off" />
                            </div>
                            <ul class="search-back d-none" id="backResponseSeller">
                                <li class="resSel search-item color" role="option"></li>
                            </ul>

                        </div>

                        <div class="title-line m-auto">
                            <span class="color-tow fs14">تعداد <span class="packageType"></span> / <span class="unitType"></span></span> - تعداد در هر <span class="packageType"></span>: <span class="qip"></span>
                            <hr class="hr">
                        </div>

                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form mb5 fs14">تعداد <span class="packageType"></span> </div>
                                <input type="number" id="packageCount" class="checkInputGroup" name="package_qty" placeholder="تعداد بسته یا کارتن را وارد نمایید" maxlength="40" />
                            </div>
                            <div class="one">
                                <div class="label-form mb5 fs14">تعداد <span class="unitType"></span> </div>
                                <input type="number" id="unitCount" class="checkInputGroup" name="unit_qty" placeholder="تعداد عدد یا دانه را وارد نمایید" maxlength="40" />
                            </div>
                        </div>
                        <span class="quantity"></span>

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
                                <input type="text" name="unit_price_buy" disabled />
                            </div>
                            <div class="one">
                                <div class="label-form mb5 fs14">قیمت فروش هر دانه / عدد <?= _star ?> </div>
                                <input type="text" name="unit_price_sell" disabled />
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

                        <?php
                        if ($expire_date['expiration_date'] == 1) { ?>
                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form mb5 fs14">تاریخ انقضا</div>
                                    <input type="hidden" class="d-none dateExpire date-server" name="expiration_date" autofocus>
                                    <input type="text" data-jdp class="expire_date cursor-p checkInput date-view" />
                                </div>
                            </div>
                        <?php }
                        ?>

                        <!-- <div class="title-line m-auto">
                            <span class="color-tow fs14 color-orange">جزئیات پرداخت</span>
                            <hr class="hr">
                        </div> -->

                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                        <input type="hidden" name="quantity_in_pack" value="" />
                        <input type="hidden" name="quantity" value="" />
                        <input type="submit" id="submit" value="ثبت" class="btn" />

                    </div>

                </form>
            </div>
        </div>




        <div class="box-container">
            <div class="insert">

                <form action="<?= url('employee-store') ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14"> تعداد دارو </div>
                            <select name="frequency" required>
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="1">4</option>
                                <option value="1">5</option>
                                <option value="1">6</option>
                                <option value="1">7</option>
                                <option value="1">8</option>
                                <option value="1">9</option>
                                <option value="1">10</option>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14"> زمان مصرف </div>
                            <select name="frequency" required>
                                <option value="4">بعد از غذا</option>
                                <option value="4">قبل از غذا</option>
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
                            <select name="frequency" required>
                                <option value="1">یک قاشق</option>
                                <option value="1">دو قاشق</option>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">طریقه مصرف</div>
                            <select name="frequency" required>
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