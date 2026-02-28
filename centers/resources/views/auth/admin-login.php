<?php
$title = 'ورود به سیستم';
include_once('resources/views/auth/layouts/header.php');

if (isset($_GET['error'])) : ?>
    <script>
        $(document).ready(function() {
            Swal.fire({
                icon: 'error',
                title: 'خطا در ثبت',
                text: 'مشکل در ثبت!',
                customClass: {
                    'swal2-popup': 'black-background'
                }
            });
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $("#phone").hide();
        $("#password").hide();

        $(".phoneInput, .passInput").on("input", function() {
            let phone = $(".phoneInput").val().trim();
            let password = $(".passInput").val().trim();
            if (phone !== "") {
                $("#phone").hide();
            }
            if (password !== "") {
                $("#password").hide();
            }
        });
        $("#submit").click(function(e) {
            let phone = $(".phoneInput").val().trim();
            let password = $(".passInput").val().trim();

            if (phone === "") {
                e.preventDefault();
                $("#phone").show();
            }
            if (password === "") {
                e.preventDefault();
                $("#password").show();
            }
            if (phone === "" && password === "") {
                e.preventDefault();
                $("#phone").show();
                $("#password").show();
            }
        });
    });
</script>

<!-- login form -->
<div class="login">
    <div class="login-form">
        <h3>فرم ورود به سیستم (مدیریت)</h3>
        <div class="avatar-login">
            <img src="<?= asset('public/assets/img/profile.png') ?>" alt="">
        </div><br>
        <form action="<?= url('admin-check-login') ?>" method="POST">
            <div class="label-input"> شماره موبایل </div>
            <input type="text" name="phone" class="phoneInput" placeholder="شماره موبایل خود را وارد کنید..." value="<?= old('phone') ?>">
            <span class="input-error" id="phone">این قسمت الزامی است</span>
            <div class="label-input">رمزعبور</div>
            <input type="password" name="password" class="passInput" placeholder="رمزعبور خود را وارد کنید..." value="<?= old('password') ?>">
            <span class="input-error" id="password">این قسمت الزامی است</span>
            <div class="remember-login">
                <input type="checkbox" id="checkbox" checked class="remember-checkbox">
                <label for="checkbox" class="check-title">مرا به خاطر بسپار</label>
            </div>
            <input type="submit" value=" ورود " id="submit" class="btn-custom btn-color">
        </form>
        <div class="other-auth">
            <div class="forget-pass">فراموشی رمزعبور - <a href="#">کلیک کنید</a></div>
            <div class="go-register">ثبت نام نکرده اید؟ - <a href="#">ثبت نام کنید</a></div>
        </div>
    </div>
</div>
</body>

</html>


<?php
$message = flash('error');
if (!empty($message)) {
    $errorData = json_encode($message); ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'مشکل در ورود',
            text: <?= $errorData ?>,
        });
    </script>
<?php  }
?>


</body>

</html>