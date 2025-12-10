<!-- start sidebar -->
<?php
$title = 'جزئیات کارمند: ' . $employee['employee_name'];
include_once('resources/views/layouts/header.php');
include_once('resources/views/scripts/change-status.php');
include_once('resources/views/scripts/show-img-modal.php');
?>
<script src="<?= asset('lib/chart.js') ?>"></script>
<!-- end sidebar -->
<div id="alert" class="alert" style="display: none;">حالم بده، با برنامه نویس مه تماس بگیر :(</div>

<!-- loading and overlay -->
<div class="overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>
<!-- Start content -->
<div class="content">
    <div class="content-title"> جزئیات کارمند : <?= $employee['employee_name'] ?></div>
    <!-- start page content -->
    <div class="box-container">
        <div class="accordion-title color-orange">مشخصات عمومی</div>
        <div class="accordion-content">
            <div class="child-accordioin">
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">نام: </div>
                    <div class="info-detaile"><?= $employee['employee_name'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">ایمیل: </div>
                    <div class="info-detaile"><?= ($employee['father_name'] ? $employee['father_name'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">شماره: </div>
                    <div class="info-detaile"><?= $employee['phone'] ?></div>
                </div>
                <!-- <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile">رمزعبور: </div>
                    <div class="info-detaile" id="passwordDisplay"><?= str_repeat('*', strlen($employee['password'])) ?></div>
                    <div class="eye-icon" onmousedown="showPassword()" onmouseup="hidePassword()">
                        <span id="eyeIcon" style="font-size: 18px;">&#128065;</span>
                    </div>
                </div> -->
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">وظیفه: </div>
                    <div class="info-detaile"><?= $employee['position'] ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">تاریخ ثبت: </div>
                    <div class="info-detaile"><?= jdate('Y/m/d', strtotime($employee['created_at'])) ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">آدرس: </div>
                    <div class="info-detaile"><?= ($employee['address'] ? $employee['address'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">توضیحات: </div>
                    <div class="info-detaile"><?= ($employee['description'] ? $employee['description'] : '- - - - ') ?></div>
                </div>
                <div class="detailes-culomn d-flex cursor-p">
                    <div class="title-detaile">ثبت شده توسط: </div>
                    <div class="info-detaile"><?= $employee['who_it'] ?></div>
                </div>

                <div class="detailes-culomn d-flex cursor-p align-center">
                    <div class="title-detaile">عکس کارمند</div>
                    <div class="info-detaile d-flex align-center">
                        <?= $employee['image']
                            ? '<img class="w50 cursor-p" src="' . asset('public/images/employees/' . $employee['image']) . '" alt="logo" onclick="openModal(\'' . asset('public/images/employees/' . $employee['image']) . '\')">'
                            : ' - - - - ' ?>
                    </div>
                </div>

                <div class="detailes-culomn d-flex align-center cursor-p">
                    <div class="title-detaile">
                        <a href="" data-url="<?= url('change-status-employee') ?>" data-id="<?= $employee['id'] ?>" class="changeStatus color btn p5 w100 m10 center" id="submit">تغییر وضعیت</a>
                    </div>
                    <div class="info-detaile">
                        <div class="w100 m10 center status status-column" id="status"><?= ($employee['state'] == 1) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="dash-chart center m-auto w90d">
            <canvas id="myChart"></canvas>
        </div>

        <a href="<?= url('employees') ?>">
            <div class="btn center p5">برگشت</div>
        </a>
    </div>
    <!-- end page content -->
</div>
<!-- End content -->
<!-- show password -->
<script>
    var passwordField = document.getElementById('passwordDisplay');
    var eyeIcon = document.getElementById('eyeIcon');
    var isMouseDown = false;

    function showPassword() {
        passwordField.innerHTML = '<?= $employee['password'] ?>';
        eyeIcon.innerHTML = '&#128064;';
        isMouseDown = true;
    }

    function hidePassword() {
        if (isMouseDown) {
            passwordField.innerHTML = '<?= str_repeat('*', strlen($employee['password'])) ?>';
            eyeIcon.innerHTML = '&#128065;';
            isMouseDown = false;
        }
    }
</script>

<script>
    const rawDates = <?= json_encode(array_keys($data)) ?>;
    const dataValues = <?= json_encode(array_values($data)) ?>;

    const daysFa = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه'];

    function getPersianDay(dateStr) {
        const date = new Date(dateStr);
        let dayNumber = date.getDay();
        // جاوااسکریپت یکشنبه رو 0 می‌دونه، ولی تو میخوای شنبه اول باشه:
        // چون تو روزهای فارسی شنبه اولین روز هفته است، باید عدد را تغییر بدیم
        // دقت کن که روز هفته به صورت 0=یکشنبه هست، پس میخوایم تبدیل کنیم به 0=شنبه
        dayNumber = (dayNumber + 1) % 7;
        return daysFa[dayNumber];
    }

    const labels = rawDates.map(getPersianDay);

    const ctx = document.getElementById('myChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'تعداد نسخه‌های هفت روز گذشته',
                data: dataValues,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                maxBarThickness: 20
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' نسخه';
                        }
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
<?php include_once('resources/views/layouts/footer.php') ?>