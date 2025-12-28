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
    ?>

    <!-- Start content -->
    <div class="content">
        <div class="content-title mb10">ثبت نسخه جدید</div>


        <!-- modal -->
        <button id="openModal-cont">ثبت نسخه جدید</button>

        <div class="modal-overlay-cont" id="modalOverlay-cont">
            <div class="modal-cont">
                <div class="colse-btn-modal">
                    <button class="close-btn-cont" id="closeModal-cont">✕</button>
                </div>

                <!-- modal data -->
                <form action="">

                    <div class="pre-main d-flex">

                        <div class="pre-body-right">

                            <!-- row 1 -->
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
                                    <ul class="search-back d-none text-left t84 p5" id="backResponse">
                                        <li class="res search-item text-left color" role="option"></li>
                                    </ul>
                                </div>

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
                                        <select name="drug_count" class="count-pre-select border-input nav-item" required>
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
                                            <option selected disabled>نوعیت دارو</option>
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

                                    <input type="submit" value="افزودن به نسخه" class="add-drug-pre bold cursor-p btn-pre nav-item">
                                    </div>

                                    <hr class="hr">

                                    <!-- prescription items -->
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
                                                    <tbody>
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
                                                    <a href="' . url('close-prescription-store/' . $prescription['id']) . '"
                                                    class="color btn p5-20 bg-success bold pa close-p"
                                                    id="closePrescriptionBtn">
                                                    <span class="heart-beat">❤</span>
                                                    بــسـتن نــسـخـه
                                                </a>' : '' ?>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>


                            </div>

                            <div class="pre-body-left">

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

                                                <div class="inputs d-flex">
                                                    <div class="one">
                                                        <div class="label-form  fs14"> نام مریض <?= _star ?></div>
                                                        <input type="text" name="user_name" id="patient_name" class="checkInput" placeholder="نام مریض را وارد نمائید">
                                                    </div>
                                                </div>
                                                <div class="inputs d-flex mb3">
                                                    <div class="one">
                                                        <div class="label-form fs14"> سن مریض <?= _star ?></div>
                                                        <input type="number" id="ageInput" class="checkInput" placeholder="سن مریض را وارد نمائید">
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
                                                <!-- end patient infos -->
                                            <?php }
                                            ?>


                                            <!-- bp ... -->
                                            <div class="accordion-title color-orange">مدیریت علائم حیاطی</div>
                                            <div class="accordion-content-pre w100">
                                                <div class="child-accordioin w90d">
                                                    <div class="insert dir-left mt5">
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
                                                    <div class="insert mt5">
                                                        <div class="one m-auto w97d mb3">
                                                            <textarea name="diagnosis" placeholder="تشخیص خود را وارد نمایید"></textarea>
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

                        </div>

                </form>

            </div>
        </div>
        <?php include_once('resources/views/scripts/modal.php'); ?>
        <!-- end modal -->




        <!-- type 2 -->
        <div class="d-flex alpha-container">

            <!-- patient infos -->
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

                            <div class="inputs d-flex">
                                <div class="one">
                                    <div class="label-form  fs14"> نام مریض <?= _star ?></div>
                                    <input type="text" name="user_name" id="patient_name" class="checkInput" placeholder="نام مریض را وارد نمائید">
                                </div>
                            </div>
                            <div class="inputs d-flex mb3">
                                <div class="one">
                                    <div class="label-form fs14"> سن مریض <?= _star ?></div>
                                    <input type="number" id="ageInput" class="checkInput" placeholder="سن مریض را وارد نمائید">
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
                            <!-- end patient infos -->
                        <?php }
                        ?>


                        <!-- bp ... -->
                        <div class="accordion-title color-orange">مدیریت علائم حیاطی</div>
                        <div class="accordion-content-pre w100">
                            <div class="child-accordioin w90d">
                                <div class="insert dir-left mt5">
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
                                <div class="insert mt5">
                                    <div class="one m-auto w97d mb3">
                                        <textarea name="diagnosis" placeholder="تشخیص خود را وارد نمایید"></textarea>
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

            <!-- select details drug -->
            <div class="drug-container">
                <form id="prescription_form" action="<?= url('drug-prescription-store') ?>" method="POST">
                    <div class="insert">

                        <!-- search box -->
                        <div class="inputs d-flex">
                            <div class="one">
                                <div class="label-form mb5 fs14">جستجوی دارو <?= _star ?> </div>
                                <input type="hidden" name="drug_id" id="item_id">
                                <input type="text"
                                    class=""
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
                            <?php
                            if ($count_drugActive) { ?>
                                <div class="one">
                                    <div class="label-form mb5 fs14"> تعداد دارو </div>
                                    <select name="drug_count" required>
                                        <?php for ($i = 1; $i <= $number['number']; $i++): ?>
                                            <option value="<?= $i ?>" <?= ($i == 1 ? 'selected' : '') ?>>
                                                <?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            <?php }
                            ?>
                            <?php
                            if ($intake_timeActive) { ?>
                                <div class="one">
                                    <div class="label-form mb5 fs14"> زمان مصرف </div>
                                    <select name="interval_time" required>
                                        <option selected disabled>زمان مصرف را انتخاب نمائید</option>
                                        <?php
                                        foreach ($intake_times as $intake_time) { ?>
                                            <option value="<?= $intake_time['intake_time'] ?>"><?= $intake_time['intake_time'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            <?php }
                            ?>
                        </div>

                        <div class="inputs d-flex">
                            <?php
                            if ($dosageActive) { ?>
                                <div class="one">
                                    <div class="label-form mb5 fs14" for="name">مقدار مصرف </div>
                                    <select name="dosage" required>
                                        <option selected disabled>مقدار مصرف در هر نوبت</option>
                                        <?php
                                        foreach ($dosage as $dos) { ?>
                                            <option value="<?= $dos['dosage'] ?>"><?= $dos['dosage'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            <?php }
                            ?>
                            <?php
                            if ($intake_instructionsActive) { ?>
                                <div class="one">
                                    <div class="label-form mb5 fs14" for="name">طریقه مصرف</div>
                                    <select name="usage_instruction" required>
                                        <option selected disabled>طریقه مصرف در هر نوبت</option>
                                        <?php
                                        foreach ($intakeInstructions as $intakeInstruction) { ?>
                                            <option value="<?= $intakeInstruction['intake_instructions'] ?>"><?= $intakeInstruction['intake_instructions'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            <?php }
                            ?>
                        </div>

                        <div class="inputs d-flex">
                            <?php
                            if ($companyActive) { ?>
                                <div class="one">
                                    <div class="label-form mb5 fs14">تولید کننده</div>
                                    <select name="company" required>
                                        <option selected disabled>تولید کننده یا نوع دارو را انتخاب نمائید</option>
                                        <?php
                                        foreach ($companies as $company) { ?>
                                            <option value="<?= $company['name'] ?>"><?= $company['name'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            <?php }
                            ?>

                            <?php
                            if ($descriptionActive) { ?>
                                <div class="one">
                                    <div class="label-form mb5 fs14">توضیحات اضافی</div>
                                    <textarea name="description" placeholder="توضیحات را وارد نمایید"></textarea>
                                </div>
                            <?php }
                            ?>

                        </div>

                        <!-- Recommended -->
                        <?php
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
                        ?>


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
                        <span><?= (!empty($drugList)) ? 'لیست دواها' : '' ?></span>
                        <?php
                        if (empty($drugList) && empty($recommended)) { ?>

                            <a href="<?= url('delete-prescription/' . $prescription['id']) ?>" class="color-red text-underline delete-prescription">حذف نسخه</a>
                        <?php }
                        ?>
                    </div>
                    <div>
                        <?= $drugList || $recommended ? '<a href="' . url('close-prescription-store/' . $prescription['id']) . '" class="color btn p5-20 bg-success bold pa close-p" id="closePrescriptionBtn">ثبت نسخه</a>' : '' ?>
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
                        <tbody>
                            <?php
                            $number = 1;
                            foreach ($drugList as $item) {
                            ?>
                                <tr>
                                    <td class="color-orange"><?= $number ?></td>
                                    <td><?= $item['drug_name'] ?></td>
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
                </div>
            </div>
        <?php }
        ?>

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

            birthYearTag.textContent = birthYear;
            birthYearInputField.value = birthYear;

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
                    if (e.key === 'ArrowRight') {
                        e.preventDefault();
                        if (isRTL) {
                            let prevIndex = (index - 1 + navItems.length) % navItems.length;
                            navItems[prevIndex].focus();
                        } else {
                            let nextIndex = (index + 1) % navItems.length;
                            navItems[nextIndex].focus();
                        }
                    } else if (e.key === 'ArrowLeft') {
                        e.preventDefault();
                        if (isRTL) {
                            let nextIndex = (index + 1) % navItems.length;
                            navItems[nextIndex].focus();
                        } else {
                            let prevIndex = (index - 1 + navItems.length) % navItems.length;
                            navItems[prevIndex].focus();
                        }
                    } else if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                        // باز کردن select در صورت وجود
                        if (item.tagName.toLowerCase() === 'select') {
                            e.preventDefault();
                            // تریگر باز شدن dropdown
                            const event = new MouseEvent('mousedown', {
                                bubbles: true
                            });
                            item.dispatchEvent(event);
                        }
                    }
                });
            });
        });
    </script>
    <?php include_once('resources/views/layouts/footer.php') ?>