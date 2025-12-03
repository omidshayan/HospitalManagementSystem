    <?php
    $title = 'ثبت نسخه';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php'); ?>

    <!-- Start content -->
    <div class="content">
        <div class="content-title">ثبت نسخه جدید</div>
        <!-- start page content -->

        <div class="search-content scroll-not">
            <div class="insert">
                <form action="<?= url('product-sale-store') ?>" method="POST" id="myForm" enctype="multipart/form-data">

                    <!-- search product -->
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">جستجوی محصول <?= _star ?> </div>
                            <input type="hidden" id="product_id">
                            <div id="user_details"></div>
                            <input type="text" class="checkInput" name="product_name" id="product_name" placeholder="نام محصول را جستجو نمایید" autocomplete="off" autofocus />
                        </div>
                        <ul class="search-back d-none" id="backResponse">
                            <li class="res search-item color" role="option"></li>
                        </ul>
                    </div>

                    <div class="d-none my-form">

                        <!-- search seller -->
                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form mb5 fs14">جستجوی مشتری <?= _star ?> </div>
                                <?php
                                $seller = $seller ?? ['id' => '', 'user_name' => 'عمومی'];
                                ?>
                                <input type="hidden" name="seller_id" id="seller_id" value="<?= !empty($seller['id']) ? $seller['id'] : '' ?>">
                                <div id="user_details"></div>
                                <input type="text" class="checkInput" name="search_seller" value="<?= !empty($seller['user_name']) ? $seller['user_name'] : 'عمومی' ?>" id="search_seller" placeholder="نام مشتری را جستجو نمایید" autocomplete="off" />
                            </div>
                            <ul class="search-back d-none" id="backResponseSeller">
                                <li class="resSel search-item color" role="option"></li>
                            </ul>
                        </div>


                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form mb5 fs14">تعداد <span class="pro_type color-green fs18 checkInputGroup"></span> </div>
                                <input type="number" name="package_qty" placeholder="تعداد را وارد نمایید" maxlength="40" />
                            </div>
                            <div class="one">
                                <div class="label-form mb5 fs14">تعداد <span class="uni_type color-green fs18 checkInputGroup"></span> </div>
                                <input type="number" name="unit_qty" placeholder="تعداد عدد یا دانه را وارد نمایید" maxlength="40" />
                            </div>
                        </div>
                        <span class="quantity"> تعداد عددی: </span>

                        <div class="title-line m-auto">
                            <span class="color-tow fs14">قیمت محصول</span>
                            <hr class="hr">
                        </div>

                        <div class="inputs d-flex mb30">
                            <div class="one">
                                <div class="label-form mb5 fs14">قیمت فروش هر <span class="color-green pro_type"></span></div>
                                <input type="text" class="checkInput" name="package_price_sell" placeholder="نام محصول را وارد نمایید" maxlength="40" />
                            </div>
                            <div class="one">
                                <div class="label-form mb5 fs14">قیمت فروش هر <span class="color-green uni_type"></span></div>
                                <input type="text" class="checkInput-not" name="unit_price_sell" placeholder="نام محصول را وارد نمایید" maxlength="40" />
                            </div>
                        </div>

                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form mb5 fs14">قیمت خرید هر <span class="color-green pro_type"></span></div>
                                <input class="cursor-not" type="password" name="package_price_buy" readonly id="package_price_buy" placeholder="نام محصول را وارد نمایید" maxlength="40" />
                                <span class="show-eye cursor-p" onclick="togglePasswordVisibility()">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path fill="#878787" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="one">
                                <div class="label-form mb5 fs14">قیمت خرید هر <span class="color-green uni_type"></span></div>
                                <input class="cursor-not" type="password" name="unit_price_buy" readonly id="unit_price_buy" placeholder="نام محصول را وارد نمایید" maxlength="40" />
                            </div>
                        </div>

                        <div class="title-line m-auto">
                            <span class="color-tow fs14 color-tow">اطلاعات تکمیلی</span>
                            <hr class="hr">
                        </div>

                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form mb5 fs14">قیمت کل </div>
                                <input type="text" class="all_price" name="item_total_price" placeholder="قیمت کل" readonly />
                            </div>
                            <!-- <div class="one">
                                <div class="label-form mb5 fs14">تخفیف به این محصول</div>
                                <input type="text" name="discount" class="discount" placeholder="تخفیف را وارد نمائید" />
                            </div> -->
                        </div>

                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                        <input type="hidden" name="quantity_in_pack" value="" />
                        <input type="hidden" name="sale_invoice" value="<?= (!empty($sale_invoice['id'])) ? $sale_invoice['id'] : '' ?>" />
                        <input type="hidden" name="quantity" value="" />
                        <input type="hidden" name="product_id" />
                        <input type="submit" id="submit" value="ثبت" class="btn" />

                    </div>
                </form>
            </div>
        </div>



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