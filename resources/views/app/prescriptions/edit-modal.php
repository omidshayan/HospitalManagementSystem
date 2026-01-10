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
                                                    <textarea name="diagnosis" placeholder="Enter Doctor's Diagnosis..."></textarea>
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
                                                    <textarea name="clinical_findings" placeholder="Enter Clinical Findings..."></textarea>
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
                                                    <textarea name="description" placeholder="توضیحات مریض را وارد نمایید"></textarea>
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