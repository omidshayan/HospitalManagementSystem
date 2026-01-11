    <?php
    $title = 'ویرایش نسخه: ' . $prescription['patient_name'];
    include_once('resources/views/layouts/header.php');
    include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/search.php');
    include_once('resources/views/scripts/toggle-item.php');

    $age = $this->getAge($prescription['birth_year']);
    $admissionStatus = isset($_SESSION['settings']['admission']) && $_SESSION['settings']['admission'] == 1;

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
        <div class="content-title mb10">ویرایش نسخه: <?= $prescription['patient_name'] ?></div>

        <!-- modal -->
        <button id="openModal-cont" class="addBtn">ثبت نسخه جدید</button>

        <div class="modal-overlay-cont" id="modalOverlay-cont">
            <div class="modal-cont border">

                <div class="colse-btn-modal">
                    <button class="close-btn-cont" id="closeModal-cont">✕</button>
                </div>

                <!-- modal data -->

                <!-- select new drug -->
                <form id="prescription_form" action="<?= url('edit-drug-prescription-store/' . ($prescription['id'] ?? '')) ?>" method="POST">

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
                                        data-target="#drug_type">
                                        <!-- &times; -->
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
                                        data-target="#count_drug">
                                        <!-- &times; -->
                                    </a>
                                </div>
                                <select name="drug_count" class="border-input nav-item">
                                    <option value="" selected disabled>تعداد دارو</option>
                                    <?php for ($i = 1; $i <= $number['number']; $i++): ?>
                                        <option value="<?= $i ?>">
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
                                        data-target="#company">
                                        <!-- &times; -->
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
                                        data-target="#intake_time">
                                        <!-- &times; -->
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
                                        data-target="#dosage">
                                        <!-- &times; -->
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
                                        data-target="#intake_instructions">
                                        <!-- &times; -->
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
                                        data-target="#description"">
                                        <!-- &times; -->
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
                <!-- end select new drug -->

                <!-- drug list and user infos CLOSE -->
                <div class="pre-main d-flex">



                    <!-- drug list -->
                    <div class="pre-body-right">
                        <?php
                        if ($prescription) { ?>
                            <div class="content-create-pre mb30 mt20">
                                <div class="mb10 fs14 d-flex justify-between">
                                    <div class="mr30">
                                        <span><?= (!empty($drugList)) ? 'لیست دواها' : '' ?></span>
                                        <?php
                                        if (empty($drugList) && empty($recommended)) { ?>

                                            <a href="<?= url('delete-prescription/' . $prescription['id']) ?>" class="color-red text-underline delete-prescription">حذف نسخه</a>
                                        <?php }
                                        ?>
                                    </div>
                                </div>

                                <?php
                                if (!empty($drugList)) { ?>
                                    <table class="fl-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>نام دارو</th>
                                                <th>تعداد</th>
                                                <th>تولید کننده</th>
                                                <th>زمان مصرف</th>
                                                <th>مقدار | واحد</th>
                                                <th>طریقه مصرف</th>
                                                <th>توضیحات</th>
                                                <th>حذف</th>
                                            </tr>
                                        </thead>
                                        <tbody id="drugListBody">
                                            <?php
                                            $number = 1;
                                            foreach ($drugList as $item) {
                                            ?>
                                                <tr>
                                                    <td class="color-orange"><?= $number ?></td>
                                                    <td class="fs18"><?= $item['drug_name'] ?></td>
                                                    <td><?= $item['drug_count'] ?: '- - - -' ?></td>
                                                    <td><?= $item['company'] ?: '- - - -' ?></td>
                                                    <td><?= ($item['interval_time']) ?: '- - - -' ?></td>
                                                    <td><?= ($item['dosage']) ?: '- - - -' ?></td>
                                                    <td><?= ($item['usage_instruction']) ?: '- - - -' ?></td>
                                                    <td><?= $item['description'] ?: '- - - -' ?></td>
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
                                <?php }
                                ?>


                                <?php
                                if (!empty($recommended)) { ?>

                                    <div class="p5">لیست آزمایشات</div>
                                    <table class="fl-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>نام آزمایش</th>
                                                <th>حذف</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $number = 1;
                                            foreach ($recommended as $item) {
                                            ?>
                                                <tr>
                                                    <td class="color-orange"><?= $number ?></td>
                                                    <td><?= $item['test_name'] ?></td>
                                                    <td>
                                                        <a href="<?= url('delete-test-list/' . $item['recommended_id']) ?>" class="delete-drug flex-justify-align">
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
                                <?php }
                                ?>

                                <div class="flex-justify-align mt20 paginate-section">
                                    <div class="table-info fs12">تعداد کل: <?= count($drugList) + count($recommended) ?></div>
                                    <?= $drugList || $recommended ? '
                                    <a href="' . url('edit-close-prescription-store/' . $prescription['id']) . '"
                                    class="color btn p5-20 bg-success bold pa close-p"
                                    id="closePrescriptionBtn">
                                    <span class="heart-beat">❤</span>
                                    ویــرایــش نــسـخـه
                                    </a>' : '' ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="color-red fs14 center mt50 bg-success p10">نسخه خالی است</div>
                        <?php }
                        ?>
                    </div>

                    <!-- end drug list -->



                    <!-- user infos -->
                    <div class="pre-body-left mt20">
                        <div class="patient-container">
                            <form action="<?= url('edit-close-prescription-store/' . ($prescription['id'] ?? '')) ?>" method="post" id="prescriptionForm">
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
                                                <input type="text" name="user_name" value="<?= $user['user_name'] ?>" id="patient_name" class="checkInput" placeholder="Enter the patient's name...">
                                            </div>
                                        </div>
                                        <div class="inputs d-flex m6">
                                            <div class="one">
                                                <div class="label-form fs14 rtl"> سن مریض <?= _star ?>
                                                    <span class="fs14"></span>
                                                    <strong id="birthYear"> </strong>
                                                </div>
                                                <input type="number" id="ageInput" value="<?= $age ?>" class="checkInput" placeholder="Enter the patient's age...">
                                                <input type="hidden" name="birth_year" id="birthYearInput">
                                            </div>
                                        </div>

                                        <div class="inputs d-flex">
                                            <div class="one d-flex">
                                                <div class="radio-group">

                                                    <label class="radio-label" for="woman">
                                                        <input
                                                            type="radio"
                                                            id="woman"
                                                            name="gender"
                                                            value="خانم"
                                                            class="radio-select"
                                                            <?= ($user['gender'] ?? '') === 'خانم' ? 'checked' : '' ?>>
                                                        خانم
                                                    </label>

                                                    <label class="radio-label" for="man">
                                                        <input
                                                            type="radio"
                                                            id="man"
                                                            name="gender"
                                                            value="آقا"
                                                            class="radio-select"
                                                            <?= ($user['gender'] ?? '') === 'آقا' ? 'checked' : '' ?>>
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
                                                    <input type="text" name="bp" value="<?= $prescription['bp'] ?>" placeholder=" Blood Pressure  ">
                                                </div>
                                                <div class="one m-auto w97d mb3">
                                                    <input type="text" name="pr" value="<?= $prescription['pr'] ?>" placeholder=" Pulse Rate  ">
                                                </div>
                                                <div class="one m-auto w97d mb3">
                                                    <input type="text" name="rr" value="<?= $prescription['rr'] ?>" placeholder=" Respiratory Rate  ">
                                                </div>
                                                <div class="one m-auto w97d mb3">
                                                    <input type="text" name="temp" value="<?= $prescription['temp'] ?>" placeholder=" Temperature  ">
                                                </div>
                                                <div class="one m-auto w97d mb3">
                                                    <input type="text" name="spo2" value="<?= $prescription['spo2'] ?>" placeholder=" Oxygen Saturation  ">
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
                                                    <textarea name="diagnosis" placeholder="Enter Doctor's Diagnosis..."><?= htmlspecialchars($prescription['diagnosis'] ?? '') ?></textarea>
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
                                                    <textarea name="clinical_findings" placeholder="Enter Clinical Findings..."><?= $prescription['clinical_findings'] ?></textarea>
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
                                                    <input type="text" name="phone" value="<?= $user['phone'] ?>" placeholder="شماره موبایل را وارد نمائید">
                                                </div>
                                            </div>

                                            <div class="inputs m6">
                                                <div class="one">
                                                    <div class="label-form fs14"> نام پدر </div>
                                                    <input type="text" name="father_name" value="<?= $user['father_name'] ?>" placeholder="نام پدر را وارد نمائید">
                                                </div>
                                            </div>

                                            <div class="insert m6">
                                                <div class="one m-auto w97d mb3">
                                                    <div class="label-form fs14"> توضیحات </div>
                                                    <textarea name="description" placeholder="توضیحات مریض را وارد نمایید"><?= $user['description'] ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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

    </div>

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

    <!-- move in tags -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navItems = Array.from(document.querySelectorAll('.nav-item'));
            const isRTL = getComputedStyle(document.body).direction === 'ltr';

            navItems.forEach((item, index) => {
                item.addEventListener('keydown', (e) => {

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

                    if (
                        item.tagName.toLowerCase() === 'select' &&
                        e.key === 'ArrowDown'
                    ) {
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