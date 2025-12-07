    <!-- start sidebar -->
    <?php
    $title = 'ویرایش دارو: ' . $drug['name'];
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/show-img-modal.php');
    ?>
    <!-- end sidebar -->

    <!-- Start content -->
    <div class="content">
        <div class="content-title">ویرایش دارو: <?= $drug['name'] ?></div>

        <!-- start page content -->
        <div class="box-container">
            <div class="insert">
                <form action="<?= url('edit-drug-store') ?>" method="POST" enctype="multipart/form-data">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14"> نام دارو <?= _star ?> </div>
                            <input type="text" class="checkInput" name="name" value="<?= $drug['name'] ?>" placeholder="نام دارو را وارد نمایید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14"> نام انحصاری </div>
                            <input type="text" name="generic_name" value="<?= $drug['generic_name'] ?>" placeholder="نام انحصاری دارو را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">انتخاب دسته بندی <?= _star ?></div>
                            <select name="category_id" id="mySelect" class="checkSelect">
                                <option value="" selected disabled>دسته‌بندی را انتخاب نمائید</option>
                                <?php foreach ($drugCategories as $item) :
                                    $catValue = isset($item['id']) ? $item['id'] : $item['category_id'] ?? $item['cat_name'];
                                    $isSelected = ((string)$catValue === (string)($drug['category_id'] ?? '')) ? ' selected' : '';
                                ?>
                                    <option value="<?= htmlspecialchars($catValue, ENT_QUOTES, 'UTF-8') ?>" <?= $isSelected ?>>
                                        <?= htmlspecialchars($item['cat_name'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14" for="name">انتخاب واحد شمارش <?= _star ?></div>
                            <select name="unit" class="checkSelect">
                                <?php foreach ($units as $unit):
                                    $isSelected = ((string)$unit['id'] === (string)($drug['unit'] ?? '')) ? ' selected' : '';
                                ?>
                                    <option value="<?= htmlspecialchars($unit['id'], ENT_QUOTES, 'UTF-8') ?>" <?= $isSelected ?>>
                                        <?= htmlspecialchars($unit['unit_name'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">تولید کننده </div>
                            <input type="text" name="manufacturer" value="<?= $drug['manufacturer'] ?>" placeholder="تولید کننده دارو را وارد نمایید" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات را وارد نمایید"><?= $drug['description'] ?></textarea>
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
                    <div>
                        <img src="<?= ($drug['image'] ? asset('public/images/drugs/' . $drug['image']) : asset('public/assets/img/empty.png')) ?>" onclick="openModal('<?php echo asset('public/images/drugs/' . $drug['image']); ?>')"
                            class="img cursor-p" alt="logo">
                    </div>
                    <div class="fs11">تصویر فعلی</div>

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <input type="submit" id="submit" value="ویــرایــش" class="btn" />
                </form>
            </div>
        </div>
        <!-- end page content -->

    </div>
    <!-- End content -->

    <?php include_once('resources/views/layouts/footer.php') ?>