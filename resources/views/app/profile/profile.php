<?php
$title = 'مشخصات اکانت';
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
?>
<script src="<?= asset('lib/chart.js') ?>"></script>

<!-- Start content -->
<div class="content">
    <div class="content-title"> جزئیات پروفایل: <?= $profile['employee_name'] ?></div>

    <!-- start page content -->
    <div class="mini-container">
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">نام</div>
                <div class="w100 m10 center"><?= $profile['employee_name'] ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">تعداد نسخه‌های تجویز شده</div>
                <div class="w100 m10 center"><?= $totalPrescriptions ?> نسخه</div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">تاریخ ثبت</div>
                <div class="w100 m10 center"><?= jdate('Y/m/d', strtotime($profile['created_at'])) ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">شماره تماس</div>
                <div class="w100 m10 center"><?= $profile['phone'] ?: '- - - -' ?></div>
            </div>
        </div>
        <div class="details">
            <div class="detail-item d-flex">
                <div class="w100 m10 center">ایمیل</div>
                <div class="w100 m10 center"><?= $profile['email'] ?: '- - - -' ?></div>
            </div>
        </div>
        <hr class="hr">
        <br>
    </div>

    <!-- show chart -->
    <div class="mini-container">
        <div class="dash-chart center m-auto w90d">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <!-- change profile infos -->
    <div class="mini-container">
        <div class="change-password center">
            تغییر اطلاعات پروفایل
            <div class="insert">
                <form action="<?= url('change-profile-infos/' . $profile['id']) ?>" method="POST">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">نام <?= _star ?> </div>
                            <input type="text" class="checkInput" name="employee_name" value="<?= $profile['employee_name'] ?>" placeholder=" نام خود را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">شماره موبایل <?= _star ?> </div>
                            <input type="text" class="checkInput" name="phone" value="<?= $profile['phone'] ?>" placeholder="شماره موبایل خود را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">ایمیل </div>
                            <input type="text" name="email" value="<?= $profile['email'] ?>" placeholder="ایمیل خود را وارد نمایید" />
                        </div>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="submit" id="submit" value="ویرایش" class="btn bold" />
                </form>
            </div>
        </div>
    </div>
    <!-- end page content -->

    <!-- change password -->
    <div class="mini-container">
        <div class="change-password center">
            تغییر رمزعبور
            <div class="insert">
                <form action="<?= url('edit-store-profile/' . $profile['id']) ?>" method="POST">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">رمزعبور فعلی <?= _star ?> </div>
                            <input type="password" class="checkInput" name="oldPassword" placeholder=" رمزعبور فعلی را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">رمزعبور جدید <?= _star ?> </div>
                            <input type="password" class="checkInput" name="newPassword" placeholder="رمزعبور جدید را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14">تکرار رمزعبور جدید <?= _star ?> </div>
                            <input type="password" class="checkInput" name="newPasswordR" placeholder="تکرار رمزعبور جدید را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form fs12 text-underline cursor-p color-orange" id="openModalClosure">فراموشی رمزعبور (کلیک کنید)</div>
                        </div>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="submit" id="submit" value="تغییر رمزعبور" class="btn bold" />
                </form>
            </div>
        </div>
    </div>
    <!-- end page content -->
</div>
<!-- End content -->

<!-- forgot password modal -->
<div id="closureModal" class="modal">
    <form action="<?= url('forgot-request') ?>" method="POST">
        <div class="modal-content border-radius">
            <div class="closureClose cursor-p float-right fs22 btn-close m10">&times;</div>
            <br>
            <span class="fs12 color-orange">لینک تغییر رمزعبور به ایمیل شما ارسال می شود</span>
            <div class="insert flex-justify-align center">
                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14">ایمیل خود را وارد نمائید <?= _star ?> </div>
                        <input type="email" name="email" placeholder="ایمیل خود را وارد نمایید" />
                    </div>
                </div>
            </div>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="submit" id="submit" value="ارسال" class="btn bold p10 w80" />
        </div>
    </form>
</div>

<!-- open modal input forget password -->
<script>
    var closureModal = document.getElementById("closureModal");
    var closureBtn = document.getElementById("openModalClosure");
    var closureClose = document.getElementsByClassName("closureClose")[0];
    closureBtn.onclick = function() {
        closureModal.style.display = "block";
    }
    closureClose.onclick = function() {
        closureModal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == closureModal) {
            closureModal.style.display = "none";
        }
    }
    document.getElementById("closureCancelBtn").onclick = function() {
        closureModal.style.display = "none";
    }
    document.getElementById("confirmBtn").onclick = function() {
        var email = document.getElementById("emailInput").value;
        closureModal.style.display = "none";
    }
</script>

<!-- chart -->
<script>
    const rawDates = <?= json_encode(array_keys($data)) ?>;
    const dataValues = <?= json_encode(array_values($data)) ?>;

    const daysFa = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه'];

    function getPersianDay(dateStr) {
        const date = new Date(dateStr);
        let dayNumber = date.getDay();
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