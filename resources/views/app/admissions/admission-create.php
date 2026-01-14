    <?php
    $title = 'پذیریش جدید';
    include_once('resources/views/layouts/header.php');
    // include_once('public/alerts/check-inputs.php');
    include_once('public/alerts/toastr.php');
    include_once('resources/views/scripts/live-search-users.php');
    ?>

    <!-- Start content -->
    <div class="content">
        <div class="content-title">پذیریش جدید
            <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
        </div>
        <?php
        $help_title = _help_title;
        $help_content = _help_desc;
        include_once('resources/views/helps/help.php');
        include_once('resources/views/scripts/search.php');
        ?>

        <!-- search box -->
        <!-- <div class=" flex-justify-align mb10">
            <div class="border search-database-s flex-justify-align">
                <a href="#" class="color search-icon-database-s">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-10 search-icon w17">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </a>
                <input type="text" class="p5 fs15 input w100" id="search_seller" placeholder="جستجوی مریض..." autofocus />
                <ul class="search-back t34 d-none" id="backResponseSeller">
                    <li class="resSel search-item color" role="option"></li>
                </ul>
            </div>
        </div> -->

        <div class=" flex-justify-align mb10">
            <div class="border search-database-s flex-justify-align">
                <a href="#" class="color search-icon-database-s">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-10 search-icon w17">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </a>
                <input
                    type="text"
                    class="p5 fs15 input w100 live-search"
                    placeholder="جستجوی مریض..."
                    autofocus
                    id="search_seller"
                    data-search-url="<?= url('search-em') ?>"
                    data-request-key="customer_name"

                    data-display-keys="user_name,birth_year,phone"

                    data-value-key="user_name"
                    data-id-key="id"

                    data-target-id="#user_id"
                    data-target-name="#patient_name" />

                <ul class="search-back t34 d-none live-search-result">
                    <li class="resSel search-item color" role="option"></li>
                </ul>
            </div>
        </div>

        <!-- start page content -->
        <div class="box-container">
            <div class="insert">
                <form action="<?= url('admission/store') ?>" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="patient_name" id="patient_name">

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام و تخلص <?= _star ?> </div>
                            <input type="text" class="checkInput" name="user_name" placeholder="نام و تخلص را وارد نمایید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">سن <?= _star ?></div>
                            <input type="number" id="ageInput" name="age" class="checkInput" placeholder="سن مریض را وارد نمائید">
                            <input type="hidden" name="birth_year" id="birthYearInput">
                        </div>
                    </div>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام پدر</div>
                            <input type="text" name="father_name" placeholder="نام پدر را وارد نمایید" maxlength="40" />
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">شماره </div>
                            <input type="number" name="phone" placeholder="شماره را وارد نمایید" />
                        </div>
                    </div>
                    <div class="d-none">
                        <strong id="birthYear"></strong>
                    </div>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">جنسیت</div>
                            <select name="gender">
                                <option value="آقا">آقا</option>
                                <option value="خانم">خانم</option>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">توضیحات</div>
                            <textarea name="description" placeholder="توضیحات را وارد نمایید"></textarea>
                        </div>
                    </div>

                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">انتخاب داکتر <?= _star ?> </div>
                            <select name="doctor_id" id="doctor_id" class="checkSelect">
                                <option disabled selected>داکتر را انتخاب کنید</option>
                                <?php foreach ($doctors as $doctor): ?>
                                    <option value="<?= $doctor['id'] ?>">
                                        <?= $doctor['employee_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="one">
                            <div class="label-form mb5 fs14">نوبت <?= _star ?> <span id="waitingPatients" class=""></span></div>
                            <input type="number" name="queue_number" class="checkInput" id="queue_number" placeholder="شماره مریض را وارد نمائید">
                        </div>
                    </div>

                    <!-- <input type="hidden" name="csrf_token"  value="<?= $_SESSION['csrf_token'] ?>" /> -->
                    <input type="submit" id="submit" value="ثبت" class="btn" />
                </form>
            </div>
        </div>
        <!-- end page content -->
    </div>
    <!-- End content -->

    <!-- confirm number -->
    <script>
        const doctorQueues = <?= json_encode($doctorQueues) ?>;

        document.getElementById('doctor_id').addEventListener('change', function() {
            const doctorId = this.value;
            const queueData = doctorQueues[doctorId] || {
                total: 0,
                waiting: 0
            };

            document.getElementById('queue_number').value = (queueData.total || 0) + 1;

            const waitingSpan = document.getElementById('waitingPatients');
            const waitingCount = queueData.waiting ?? 0;
            waitingSpan.textContent = ` (تعداد مریض‌های منتظر: ${waitingCount}) `;
        });
    </script>

    <!-- // copy text in input name -->
    <script type="text/javascript">
        document.getElementById("search_seller").addEventListener("input", function() {
            document.querySelector("input[name='user_name']").value = this.value;
        });
    </script>

    <!-- age -->
    <script>
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

    <?php include_once('resources/views/layouts/footer.php') ?>