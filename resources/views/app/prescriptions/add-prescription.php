    <?php
    $title = 'ثبت نسخه';
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/search.php');
    include_once('resources/views/scripts/toggle-item.php');
    $count_drugActive = isset($_SESSION['settings']['count_drug']) && $_SESSION['settings']['count_drug'] == 1;
    $intake_timeActive = isset($_SESSION['settings']['intake_time']) && $_SESSION['settings']['intake_time'] == 1;
    $dosageActive = isset($_SESSION['settings']['dosage']) && $_SESSION['settings']['dosage'] == 1;
    $companyActive = isset($_SESSION['settings']['company']) && $_SESSION['settings']['company'] == 1;
    $descriptionActive = isset($_SESSION['settings']['description']) && $_SESSION['settings']['description'] == 1;
    $intake_instructionsActive = isset($_SESSION['settings']['intake_instructions']) && $_SESSION['settings']['intake_instructions'] == 1;
    $testsActive = isset($_SESSION['settings']['tests']) && $_SESSION['settings']['tests'] == 1;
    $drugType = isset($_SESSION['settings']['drug_type']) && $_SESSION['settings']['drug_type'] == 1;
    ?>

    <!-- Start content -->
    <div class="content">
        <div class="content-title mb10">مدیریت نسخه‌ها</div>

        <!-- modal -->
        <button id="openModal-cont" class="addBtn">ثبت نسخه جدید</button>

        <div class="modal-overlay-cont" id="modalOverlay-cont">
            <div class="modal-cont border">

                <div class="colse-btn-modal">
                    <button class="close-btn-cont" id="closeModal-cont">✕</button>
                </div>

                <!-- modal data -->
                <form id="prescription_form" action="<?= url('drug-prescription-store') ?>" method="POST">

                    <!-- select deug -->
                    <div class="inputs-pre">

                        <!-- search box -->
                        <div class="search-box-pre">
                            <div class="input-pre">
                                <div class="label-form mb5 fs14 text-left">جستجوی دارو <?= _star ?> <span class="close-btn"></span></div>
                                <input type="hidden" name="drug_id" id="item_id">
                                <input type="text"
                                    class="border-input search-input-pre nav-item"
                                    name="drug_name"
                                    id="item_name"
                                    placeholder="Search for the name of the drug"
                                    autocomplete="off"
                                    autofocus
                                    data-search-url="<?= url('search-product-purchase') ?>" />
                            </div>
                            <ul class="search-back d-none text-left t84 p5 wwww" id="backResponse">
                                <li class="res search-item text-left color" role="option"></li>
                            </ul>
                        </div>

                        <!-- drug type -->
                        <?php
                        if ($drugType) { ?>
                            <div class="input-pre count-pre input-wrapper">
                                <div class="label-form mb5 fs14 text-left"> نوع دارو
                                    <a href="javascript:void(0)" class="close-btn toggle-item"
                                        data-url="change-status-drug-type-active"
                                        data-target="#drug_type">&times;
                                    </a>
                                </div>
                                <select name="drug_type" class="border-input nav-item" required>
                                    <option selected disabled>نوع دارو</option>
                                    <?php
                                    foreach ($drugTypes as $drugType) { ?>
                                        <option id="<?= $drugType['drug_type'] ?>"><?= $drugType['drug_type'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        <?php }
                        ?>

                        <!-- count -->
                        <?php
                        if ($count_drugActive) { ?>
                            <div class="input-pre count-pre input-wrapper">
                                <div class="label-form mb5 fs14 text-left"> تعداد دارو
                                    <a href="javascript:void(0)" class="close-btn toggle-item"
                                        data-url="change-status-count-drug"
                                        data-target="#count_drug">&times;
                                    </a>
                                </div>
                                <select name="drug_count" class="border-input nav-item" required>
                                    <option selected disabled>تعداد دارو</option>
                                    <?php for ($i = 1; $i <= $number['number']; $i++): ?>
                                        <option value="<?= $i ?>" <?= ($i == 1 ? 'selected' : '') ?>>
                                            <?= $i ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        <?php }
                        ?>

                        <!-- company drug -->
                        <?php
                        if ($companyActive) { ?>
                            <div class="input-pre other-select-p input-wrapper">
                                <div class="label-form mb5 fs14 text-left">تولید کننده
                                    <a href="javascript:void(0)" class="close-btn toggle-item"
                                        data-url="change-status-company-active"
                                        data-target="#company">&times;
                                    </a>
                                </div>
                                <select name="company" class="other-select-p-item border-input nav-item" required>
                                    <option selected disabled>تولید کننده</option>
                                    <?php
                                    foreach ($companies as $company) { ?>
                                        <option value="<?= $company['name'] ?>"><?= $company['name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        <?php }
                        ?>

                        <!-- use time -->
                        <?php
                        if ($intake_timeActive) { ?>
                            <div class="input-pre other-select-p input-wrapper">
                                <div class="label-form mb5 fs14 text-left"> زمان مصرف
                                    <a href="javascript:void(0)" class="close-btn toggle-item"
                                        data-url="change-status-intake-time"
                                        data-target="#intake_time">&times;
                                    </a>
                                </div>
                                <select name=" interval_time" class="other-select-p-item border-input nav-item" required>
                                    <option selected disabled>زمان مصرف </option>
                                    <?php
                                    foreach ($intake_times as $intake_time) { ?>
                                        <option value="<?= $intake_time['intake_time'] ?>"><?= $intake_time['intake_time'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        <?php }
                        ?>

                        <!-- dosage -->
                        <?php
                        if ($dosageActive) { ?>
                            <div class="input-pre other-select-p input-wrapper">
                                <div class="label-form mb5 fs14 text-left" for="name">مقدار مصرف
                                    <a href="javascript:void(0)" class="close-btn toggle-item"
                                        data-url="change-status-dosage"
                                        data-target="#dosage">&times;
                                    </a>
                                </div>
                                <select name=" dosage" required class="other-select-p-item border-input nav-item">
                                    <option selected disabled>مقدار مصرف </option>
                                    <?php
                                    foreach ($dosage as $dos) { ?>
                                        <option value="<?= $dos['dosage'] ?>"><?= $dos['dosage'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        <?php }
                        ?>

                        <!-- usage instaruction -->
                        <?php
                        if ($intake_instructionsActive) { ?>
                            <div class="input-pre other-select-p input-wrapper">
                                <div class="label-form mb5 fs14 text-left" for="name">طریقه مصرف
                                    <a href="javascript:void(0)" class="close-btn toggle-item"
                                        data-url="change-status-intake-instructions"
                                        data-target="#intake_instructions">&times;
                                    </a>
                                </div>
                                <select name="usage_instruction" required class="other-select-p-item border-input nav-item">
                                    <option selected disabled>طریقه مصرف </option>
                                    <?php
                                    foreach ($intakeInstructions as $intakeInstruction) { ?>
                                        <option value="<?= $intakeInstruction['intake_instructions'] ?>"><?= $intakeInstruction['intake_instructions'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        <?php }
                        ?>

                        <!-- descripton -->
                        <?php
                        if ($descriptionActive) { ?>
                            <div class="input-pre desc-pre input-wrapper">
                                <div class="label-form mb5 fs14 text-left">توضیحات اضافی
                                    <a href="javascript:void(0)" class="close-btn toggle-item"
                                        data-url="change-status-description-active"
                                        data-target="#description"">&times;
                                    </a>
                                </div>
                                <textarea rows=" 2" name="description" class="border-input desc-prescription nav-item" placeholder="Drug description  "></textarea>
                                </div>
                            <?php }
                            ?>

                            </div>

                            <input type="submit" value="افزودن دارو به نسخه" class="add-drug-pre bold cursor-p btn-pre border">
                            <!-- end select drug -->

                            <hr class="hr">
                </form>

                <!-- drug list and user infos CLOSE -->
                <div class="pre-main d-flex">

                    <!-- drug list -->
                    <?php include_once('resources/views/app/prescriptions/drug-list.php'); ?>
                    <!-- end drug list -->

                    <!-- user infos -->
                    <div class="pre-body-left mt20">
                        <div class="patient-container">
                            <form action="<?= url('close-prescription-store/' . ($prescription['id'] ?? '')) ?>" method="post" id="prescriptionForm">
                                <div class="center fs14 mb10">اطلاعات مریض</div>
                                <div class="insert">
                                    <?php
                                    $admissionStatus = isset($_SESSION['settings']['admission']) && $_SESSION['settings']['admission'] == 1;
                                    if ($admissionStatus) {
                                        $currentPatientId = null;
                                        foreach ($patients as $p) {
                                            if ($p['status'] == 1) {
                                                $currentPatientId = $p['id'];
                                                break;
                                            }
                                        }
                                    ?>
                                        <select name="admission_id" id="admissionSelect" class="mb20">
                                            <?php if (empty($patients)): ?>
                                                <option value="" disabled selected>
                                                    مریضی ثبت نشده است
                                                </option>
                                            <?php else: ?>
                                                <?php foreach ($patients as $patient): ?>
                                                    <option
                                                        class="<?= ($patient['status'] == 2) ? 'fs14 color-green' : '' ?>"
                                                        value="<?= $patient['id'] ?>"
                                                        data-name-add="<?= htmlspecialchars($patient['user_name'] ?? '') ?>"
                                                        data-age-add="<?= $patient['age'] ?? '' ?>"
                                                        <?= ($patient['id'] == $currentPatientId) ? 'selected' : '' ?>>

                                                        <?= $patient['queue_number'] ?>
                                                        - <?= $patient['user_name'] ?? 'نامشخص' ?>
                                                        - (<?= $patient['age'] ?? '—' ?> ساله)

                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>

                                        <!-- btn -->
                                        <?php if (!empty($patients)): ?>
                                            <div class="center mb20">
                                                <a href="<?= url('patient-inquiry') ?>"
                                                    target="_blank"
                                                    id="patientInquiryBtn"
                                                    class="p5-20 bg-success btn fs14">
                                                    استعلام مریض
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                    <?php } else { ?>

                                        <div class="inputs d-flex m6">
                                            <div class="one">
                                                <div class="label-form  fs14 rtl"> نام مریض <?= _star ?></div>
                                                <input type="text" name="user_name" id="patient_name" class="checkInput" placeholder="نام مریض را وارد نمائید">
                                            </div>
                                        </div>
                                        <div class="inputs d-flex m6">
                                            <div class="one">
                                                <div class="label-form fs14 rtl"> سن مریض <?= _star ?>
                                                    <span class="fs14"></span>
                                                    <strong id="birthYear"> </strong>
                                                </div>
                                                <input type="number" id="ageInput" class="checkInput" placeholder="سن مریض را وارد نمائید">
                                                <input type="hidden" name="birth_year" id="birthYearInput">
                                            </div>
                                        </div>

                                        <div class="inputs d-flex">
                                            <div class="one d-flex">
                                                <div class="radio-group">
                                                    <label class="radio-label" for="woman">
                                                        <input type="radio" id="woman" name="gender" value="خانم" class="radio-select">
                                                        خانم
                                                    </label>

                                                    <label class="radio-label" for="man">
                                                        <input type="radio" id="man" name="gender" checked value="آقا" class="radio-select">
                                                        آقا
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- end patient infos -->
                                    <?php }
                                    ?>

                                    <!-- bp ... -->
                                    <div class="accordion-title color-orange">مدیریت علائم حیاطی</div>
                                    <div class="accordion-content-pre w100">
                                        <div class="child-accordioin w90d">
                                            <div class="insert dir-left mt5 ml-10">
                                                <div class="one m-auto w97d mb3">
                                                    <input type="text" name="bp" placeholder=" Blood Pressure  ">
                                                </div>
                                                <div class="one m-auto w97d mb3">
                                                    <input type="text" name="pr" placeholder=" Pulse Rate  ">
                                                </div>
                                                <div class="one m-auto w97d mb3">
                                                    <input type="text" name="rr" placeholder=" Respiratory Rate  ">
                                                </div>
                                                <div class="one m-auto w97d mb3">
                                                    <input type="text" name="temp" placeholder=" Temperature  ">
                                                </div>
                                                <div class="one m-auto w97d mb3">
                                                    <input type="text" name="spo2" placeholder=" Oxygen Saturation  ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- diagnosis -->
                                    <div class="accordion-title color-orange">تشخیص داکتر</div>
                                    <div class="accordion-content-pre w100">
                                        <div class="child-accordioin w90d">
                                            <div class="insert mt5 ml-10">
                                                <div class="one m-auto w100 mb3">
                                                    <textarea name="diagnosis" placeholder="تشخیص خود را وارد نمایید"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Clinical Findings -->
                                    <div class="accordion-title color-orange">یافته‌های کلینیکی</div>
                                    <div class="accordion-content-pre w100">
                                        <div class="child-accordioin w90d">
                                            <div class="insert mt5 ml-10">
                                                <div class="one m-auto w100 mb3">
                                                    <textarea name="diagnosis" placeholder="Enter Clinical Findings..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- diagnosis -->
                                    <div class="accordion-title color-orange">ثبت اطلاعات بیشتر مریض</div>
                                    <div class="accordion-content-pre w100">
                                        <div class="child-accordioin">

                                            <div class="inputs m6">
                                                <div class="one">
                                                    <div class="label-form fs14"> شماره موبایل </div>
                                                    <input type="text" name="phone" placeholder="شماره موبایل را وارد نمائید">
                                                </div>
                                            </div>

                                            <div class="inputs m6">
                                                <div class="one">
                                                    <div class="label-form fs14"> نام پدر </div>
                                                    <input type="text" name="father_name" placeholder="نام پدر را وارد نمائید">
                                                </div>
                                            </div>

                                            <div class="insert m6">
                                                <div class="one m-auto w97d mb3">
                                                    <div class="label-form fs14"> توضیحات </div>
                                                    <textarea name="diagnosis" placeholder="توضیحات مریض را وارد نمایید"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <?php
                                            if ($testsActive) { ?>
                                        <div class="accordion-title color-orange w89d">معاینات / آزمایشات توصیه شده</div>
                                        <div class="accordion-content-pre w89d">
                                            <div class="child-accordioin">
                                                <div class="insert mt5">
                                                    <div class="one m-auto mb3">
                                                        <select id="recommended_select">
                                                            <option value="" selected disabled>انتخاب آیتم</option>
                                                            <?php
                                                            foreach ($tests as $test) { ?>
                                                                <option value="<?= $test['id'] ?>"><?= $test['test_name'] ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                        <button type="button" class="btn w80 p5" onclick="addRecommended()">افزودن</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="recommended-box color">
                                            <ul id="recommended_list" class="color"></ul>
                                        </div>
                                    <?php }
                                    ?> -->

                                    <div class="center mt20">
                                        <a id="checkPatientBtn" href="" target="_blank" class="p5-20 bg-success btn fs14 d-none">
                                            استعلام مریض
                                        </a>
                                    </div>

                                </div>
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                            </form>
                        </div>
                    </div>
                    <!-- end user infos -->

                </div>
                <!-- end drug list and user infos CLOSE-->

            </div>
        </div>
        <?php include_once('resources/views/scripts/modal.php'); ?>
        <!-- end modal -->

        <!-- prescriptions -->
        <div class="box-container">
            <div class="mb5 fs14"> نسخه‌های امروز</div>
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام داکتر</th>
                        <th>نام مریض</th>
                        <th>تاریخ ثبت</th>
                        <th>چاپ</th>
                        <th>ویرایش</th>
                        <th>جزئیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $perPage = 10;
                    $data = paginate($prescriptions, $perPage);
                    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $number = ($currentPage - 1) * $perPage + 1;
                    foreach ($data as $item) {
                    ?>
                        <tr>
                            <td class="color-orange"><?= $number ?></td>
                            <td><?= $item['employee_name'] ?></td>
                            <td><?= $item['patient_name'] ?? '- - - -' ?></td>
                            <td><?= jdate('Y/m/d', strtotime($item['created_at'])) ?></td>
                            <td><a href="<?= url('print-item/' . $item['id']) ?>" target="_blank" class="text-underline color">چاپ</a></td>

                            <td>
                                <a href="<?= url('edit-prescription/' . $item['id']) ?>" class="color-orange">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" class="color-orange" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a href="<?= url('show-prescription-item/' . $item['id']) ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" class="color-orange" />
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
                <div class="table-info fs14">تعداد کل: <?= count($prescriptions) ?></div>
                <?php
                if (count($prescriptions) == null) { ?>
                    <div class="center center color-red fs14">
                        <i class="fa fa-comment"></i>
                        <?= 'اطلاعاتی ثبت نشده است' ?>
                    </div>
                <?php } else {
                    if (count($prescriptions) > 10) {
                        echo paginateView($prescriptions, 10);
                    }
                }
                ?>
            </div>
        </div>

    </div>

    <?php
    if (isset($_SESSION['flash_id'])) {
        $id = $_SESSION['flash_id'];
        unset($_SESSION['flash_id']);
        $url = url('print-item/' . $id);
    ?>
        <script>
            window.open('<?php echo $url; ?>', '_blank');
        </script>
    <?php
    }
    ?>

    <!-- estelam -->
    <script>
        const patientName = document.getElementById('patient_name');
        const ageInput = document.getElementById('ageInput');
        const birthYearInput = document.getElementById('birthYearInput');
        const btn = document.getElementById('checkPatientBtn');
        const baseUrl = "<?= url('patient-inquiry') ?>";

        function checkInputs() {
            let nameVal = patientName.value.trim();
            let ageVal = ageInput.value.trim();
            let birthYear = birthYearInput.value.trim();
            let encodedName = encodeURIComponent(nameVal);

            if (nameVal.length >= 3 && ageVal !== "" && birthYear !== "") {

                btn.href = `${baseUrl}?patient_name=${encodedName}&birth_year=${birthYear}`;

                btn.classList.remove('d-none');
            } else {
                btn.classList.add('d-none');
                btn.href = baseUrl;
            }
        }

        patientName.addEventListener('input', checkInputs);
        ageInput.addEventListener('input', checkInputs);


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

        ageInput.addEventListener('input', function() {
            let age = parseInt(this.value);
            let birthYearTag = document.getElementById('birthYear');
            let birthYearInputField = document.getElementById('birthYearInput');

            if (!age || age <= 0) {
                birthYearTag.textContent = '';
                birthYearInputField.value = '';
                checkInputs();
                return;
            }

            let currentPersianYear = getCurrentPersianYear();
            let birthYear = currentPersianYear - age;

            birthYearTag.textContent = ' سال تولد : ' + birthYear;
            birthYearInputField.value = '' + birthYear;

            checkInputs();
        });
    </script>

    <!-- admission -->
    <script>
        const admissionSelect = document.getElementById('admissionSelect');
        const patientInquiryBtn = document.getElementById('patientInquiryBtn');
        const baseUrl1 = patientInquiryBtn.getAttribute('href');

        function updateInquiryLink() {
            const selectedOption = admissionSelect.options[admissionSelect.selectedIndex];
            const patientName = selectedOption.getAttribute('data-name-add') || '';
            const patientAge = selectedOption.getAttribute('data-age-add') || '';

            const encodedName = encodeURIComponent(patientName);
            const encodedAge = encodeURIComponent(patientAge);

            patientInquiryBtn.href = `${baseUrl1}?patient_name=${encodedName}&birth_year=${encodedAge}`;
        }

        updateInquiryLink();
        admissionSelect.addEventListener('change', updateInquiryLink);
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

    <!-- select recommender -->
    <script>
        function addRecommended() {
            const select = document.getElementById('recommended_select');
            const value = select.value;
            if (!value) {
                alert('لطفاً یک مورد را انتخاب کنید');
                return;
            }

            const text = select.options[select.selectedIndex].text;

            // جلوگیری از تکراری
            if (document.getElementById('rec_' + value)) {
                alert('این مورد قبلاً اضافه شده');
                return;
            }

            const li = document.createElement('li');
            li.id = 'rec_' + value;
            li.innerHTML = `
                            ${text}
                            <input type="hidden" name="recommended[]" value="${value}">
                            <button type="button" onclick="this.parentElement.remove()" class="color-red cursor-p">✖</button>
                            `;

            document.getElementById('recommended_list').appendChild(li);
        }
    </script>

    <!-- validation input and select -->
    <script>
        document.getElementById('prescription_form').addEventListener('submit', function(e) {

            const drugId = document.getElementById('item_id').value;
            const hasDrug = drugId !== '';
            const hasRecommended = document.querySelectorAll('input[name="recommended[]"]').length > 0;

            if (!hasDrug && !hasRecommended) {
                e.preventDefault();
                document.getElementById('item_name').classList.add('checkInput');
                return false;
            }

            if (hasRecommended && !hasDrug) {
                document.getElementById('item_name').classList.remove('checkInput');
            }
        });
    </script>

    <!-- move in tags -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navItems = Array.from(document.querySelectorAll('.nav-item'));
            const isRTL = getComputedStyle(document.body).direction === 'ltr';

            navItems.forEach((item, index) => {
                item.addEventListener('keydown', (e) => {

                    // حرکت چپ و راست
                    if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
                        e.preventDefault();

                        let nextIndex;
                        if (e.key === 'ArrowRight') {
                            nextIndex = isRTL ?
                                (index - 1 + navItems.length) % navItems.length :
                                (index + 1) % navItems.length;
                        } else {
                            nextIndex = isRTL ?
                                (index + 1) % navItems.length :
                                (index - 1 + navItems.length) % navItems.length;
                        }

                        navItems[nextIndex].focus();
                    }

                    // باز شدن select با ArrowDown
                    if (
                        item.tagName.toLowerCase() === 'select' &&
                        e.key === 'ArrowDown'
                    ) {
                        // اجازه بده رفتار پیش‌فرض اجرا شود
                        // فقط جلوی جابجایی بین navItems را بگیر
                        return;
                    }
                });
            });
        });
    </script>

    <!-- btn move -->
    <script>
        const btnMove = document.querySelector('.add-drug-pre');
        const form = btnMove.closest('form');

        const storageKey = 'addDrugPrePosition';

        window.addEventListener('DOMContentLoaded', () => {
            const savedPos = localStorage.getItem(storageKey);
            if (savedPos) {
                const pos = JSON.parse(savedPos);
                btnMove.style.left = pos.left;
                btnMove.style.top = pos.top;
            }
        });

        let isDragging = false;
        let startX, startY;

        btnMove.addEventListener('mousedown', (event) => {
            event.preventDefault();

            const rect = btnMove.getBoundingClientRect();
            const container = document.querySelector('.modal-cont');
            const containerRect = container.getBoundingClientRect();

            const offsetX = event.clientX - rect.left;
            const offsetY = event.clientY - rect.top;

            startX = event.clientX;
            startY = event.clientY;
            isDragging = false;

            function onMouseMove(e) {
                const moveX = Math.abs(e.clientX - startX);
                const moveY = Math.abs(e.clientY - startY);

                if (moveX > 5 || moveY > 5) {
                    isDragging = true;
                }

                let newLeft = e.clientX - offsetX - containerRect.left;
                let newTop = e.clientY - offsetY - containerRect.top;

                if (newLeft < 0) newLeft = 0;
                if (newTop < 0) newTop = 0;

                const maxLeft = container.clientWidth - btnMove.offsetWidth;
                const maxTop = container.clientHeight - btnMove.offsetHeight;

                if (newLeft > maxLeft) newLeft = maxLeft;
                if (newTop > maxTop) newTop = maxTop;

                btnMove.style.left = newLeft + 'px';
                btnMove.style.top = newTop + 'px';
            }

            function onMouseUp() {
                document.removeEventListener('mousemove', onMouseMove);
                document.removeEventListener('mouseup', onMouseUp);

                if (isDragging) {
                    localStorage.setItem(storageKey, JSON.stringify({
                        left: btnMove.style.left,
                        top: btnMove.style.top
                    }));
                }
            }

            document.addEventListener('mousemove', onMouseMove);
            document.addEventListener('mouseup', onMouseUp);
        });

        btnMove.addEventListener('click', (event) => {
            if (isDragging) {
                event.preventDefault();
                event.stopImmediatePropagation();
            }
        });

        btnMove.ondragstart = () => false;
    </script>

    <!-- move container -->
    <script>
        const slider = document.querySelector('.inputs-pre');

        let isDown = false;
        let startXx;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startXx = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });

        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startXx) * 2;
            slider.scrollLeft = scrollLeft - walk;
        });
    </script>

    <?php include_once('resources/views/layouts/footer.php') ?>