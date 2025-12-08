    <?php
    $title = 'ثبت نسخه';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/search.php');
    ?>

    <!-- Start content -->
    <div class="content">
        <div class="content-title mb10">ثبت نسخه جدید</div>

        <div class="d-flex alpha-container">

            <!-- patient infos -->
            <div class="patient-container">
                <form action="<?= url('close-prescription-store/' . ($prescription['id'] ?? '')) ?>" method="post" id="prescriptionForm">
                    <div class="center fs14">اطلاعات بیمار</div>
                    <div class="insert">
                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form  fs14"> نام بیمار <?= _star ?></div>
                                <input type="text" name="user_name" id="patient_name" class="checkInput" placeholder="نام بیمار را وارد نمائید">
                            </div>
                        </div>
                        <div class="inputs d-flex mb3">
                            <div class="one">
                                <div class="label-form fs14"> سن بیمار <?= _star ?></div>
                                <input type="number" name="age" id="ageInput" class="checkInput" placeholder="سن بیمار را وارد نمائید">
                                <input type="hidden" name="birth_year" id="birthYearInput">
                            </div>
                        </div>
                        <div class="">
                            <span class="fs14">سال تولد: </span>
                            <strong id="birthYear"></strong>
                        </div>
                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form fs14"> نام پدر </div>
                                <input type="text" name="father_name" placeholder="نام پدر را وارد نمائید">
                            </div>
                        </div>

                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form fs14"> جنسیت </div>
                                <select name="gender">
                                    <option value="آقا">آقا</option>
                                    <option value="خانم">خانم</option>
                                </select>
                            </div>
                        </div>

                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form fs14"> شماره موبایل </div>
                                <input type="text" name="phone" placeholder="شماره موبایل را وارد نمائید">
                            </div>
                        </div>

                        <div class="accordion-title color-orange">علائم حیاطی</div>
                        <div class="accordion-content-pre">
                            <div class="child-accordioin">
                                <div class="insert">
                                    <div class="one">
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="center mt20">
                            <a id="checkPatientBtn" href="" target="_blank" class="p5-20 bg-success btn fs14 d-none">
                                استعلام بیمار
                            </a>
                        </div>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                </form>
            </div>

            <!-- select details drug -->
            <div class="drug-container">
                <form action="<?= url('drug-prescription-store') ?>" method="POST">
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
                                <div class="label-form mb5 fs14" for="name">مقدار مصرف هر نوبت</div>
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
                        <input type="submit" id="submit" value="افزودن به نسخه" class="btn bold" />
                    </div>
                </form>
            </div>

        </div>

        <!-- prescription items -->
        <?php
        if ($prescription) { ?>
            <div class="content-container mb30 mt20">
                <div class="mb10 fs14 d-flex justify-between">
                    <div class="mr30">
                        <span><?= ($drugList) ? 'لیست دواها' : 'لیست خالی است' ?></span>
                        <?php
                        if (empty($drugList)) { ?>
                            <a href="<?= url('delete-prescription/' . $prescription['id']) ?>" class="color-red text-underline delete-prescription">حذف نسخه</a>
                        <?php }
                        ?>
                    </div>
                    <div>
                        <?= $drugList ? '<a href="' . url('close-prescription-store/' . $prescription['id']) . '" class="color btn p5-20 bg-success bold pa close-p" id="closePrescriptionBtn">ثبت نسخه</a>' : '' ?>
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
                            <!-- <th>ویرایش</th> -->
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
                                <td><?= $item['description'] ?: '- - - -' ?></td>
                                <!-- <td>
                                    <a href="<?= url('edit-prescription-list/' . $item['id']) ?>" class="color-orange flex-justify-align">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" class="color-orange" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </a>
                                </td> -->

                                <td>
                                    <a href="<?= url('delete-prescription-list/' . $item['id']) ?>" class="delete-drug flex-justify-align">
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
                </table>
                <div class="flex-justify-align mt20 paginate-section">
                    <div class="table-info fs12">تعداد کل: <?= count($drugList) ?></div>
                </div>
            </div>
        <?php }
        ?>
    </div>

    <script>
        // check patient
        document.getElementById('patient_name').addEventListener('input', function() {
            const btn = document.getElementById('checkPatientBtn');
            const baseUrl = "<?= url('patient-inquiry') ?>";
            let value = encodeURIComponent(this.value.trim());

            if (this.value.length >= 3) {
                btn.classList.remove('d-none');
                btn.href = baseUrl + "?patient_name=" + value;
            } else {
                btn.classList.add('d-none');
                btn.href = baseUrl;
            }
        });

        // generate age
        function toEnglishDigits(str) {
            return str.replace(/[۰-۹]/g, d => "۰۱۲۳۴۵۶۷۸۹".indexOf(d));
        }

        function getCurrentPersianYear() {
            let today = new Date();
            let formatter = new Intl.DateTimeFormat('fa-AF', {
                year: 'numeric'
            });
            let persianYear = formatter.format(today);

            return parseInt(toEnglishDigits(persianYear));
        }

        document.getElementById('ageInput').addEventListener('input', function() {
            let age = parseInt(this.value);
            let birthYearTag = document.getElementById('birthYear');
            let birthYearInput = document.getElementById('birthYearInput');

            if (!age || age <= 0) {
                birthYearTag.textContent = '';
                birthYearInput.value = '';
                return;
            }

            let currentPersianYear = getCurrentPersianYear();
            let birthYear = currentPersianYear - age;

            birthYearTag.textContent = birthYear;

            birthYearInput.value = birthYear;
        });
    </script>

    <!-- confirm for delete -->
    <script>
        $(document).ready(function() {

            // close prescription
            document.getElementById('closePrescriptionBtn').addEventListener('click', function(e) {
                e.preventDefault();

                document.getElementById('prescriptionForm').requestSubmit(
                    document.getElementById('hiddenSubmit')
                );
            });

            document.querySelectorAll(".delete-drug").forEach(function(element) {
                element.addEventListener("click", function(event) {
                    let confirmDelete = confirm("آیا از حذف دارو اطمینان دارید؟");
                    if (!confirmDelete) {
                        event.preventDefault();
                    }
                });
            });

            document.querySelectorAll(".delete-prescription").forEach(function(element) {
                element.addEventListener("click", function(event) {
                    let confirmDelete = confirm("آیا از حذف نسخه اطمینان دارید؟");
                    if (!confirmDelete) {
                        event.preventDefault();
                    }
                });
            });

        });
    </script>

    <?php include_once('resources/views/layouts/footer.php') ?>