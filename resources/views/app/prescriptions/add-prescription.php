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

        <form action="<?= url('drug-prescription-store') ?>" method="POST">
            <!-- select details drug -->
            <div class="content-container">
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
                </div>
            </div>
        </form>

        <!-- prescription items -->
        <?php
        if ($prescription) { ?>
            <div class="content-container mb30 mt20">
                <div class="mb10 fs14 d-flex">
                    <div class="mr30 bold"> نسخه بیمار: <span><?= ($prescription['patient_name']) ? $prescription['patient_name'] : 'ثبت نشده' ?></span></div>
                    <div class="mr30 bold">
                        <span><?= isset($total_debt['debtor']) ? 'حساب قبلی: ' . number_format($total_debt['debtor']) : '' ?></span>
                    </div>
                </div>
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دارو</th>
                            <th>تعداد</th>
                            <th>زمان مصرف</th>
                            <th>مقدار | واحد</th>
                            <th>طریقه مصرف</th>
                            <th>توضیحات</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $number = 1;
                        foreach ($drugList as $item) {
                        ?>
                            <tr>
                                <td class="color-orange"><?= $number ?></td>
                                <td><?= $item['drug_name'] ?></td>
                                <td><?= $item['drug_count'] ?? 1 ?></td>
                                <td><?= $item['interval_time'] ?></td>
                                <td><?= $item['dosage'] ?></td>
                                <td><?= $item['usage_instruction'] ?></td>
                                <td><?= $item['description'] ?></td>
                                <td>
                                    <a href="<?= url('edit-prescription-list/' . $item['id']) ?>" class="color-orange flex-justify-align">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" class="color-orange" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </a>
                                </td>

                                <td>
                                    <a href="<?= url('delete-prescription-list/' . $item['id']) ?>" class="delete-product flex-justify-align">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512">
                                            <path fill="#ff0000" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $number++;
                        }
                        ?>
                    </tbody>
                    <tbody></tbody>
                </table>
                <div class="flex-justify-align mt20 paginate-section">
                    <div class="table-info fs12">تعداد کل: <?= count($drugList) ?></div>
                </div>
            </div>
        <?php }
        ?>


    </div>

    <?php include_once('resources/views/layouts/footer.php') ?>