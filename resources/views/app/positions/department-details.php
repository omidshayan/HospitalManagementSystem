    <!-- start sidebar -->
    <?php include_once('resources/views/layouts/header.php');
    $date = explode(' ', $department['created_at']);
    ?>
    <!-- end sidebar -->
    <script>
        $(document).ready(function() {
            function checkInputError(input) {
                let value = $(input).val().trim();
                if (value === "") {
                    $(input).addClass('border-error');
                } else {
                    $(input).removeClass('border-error');
                }
            }
            $(".checkInput").on("input", function() {
                checkInputError(this);
            });
            $("#submit").click(function(e) {
                let inputs = $(".checkInput");
                let emptyInputs = [];

                inputs.each(function() {
                    checkInputError(this);
                    if ($(this).val().trim() === "") {
                        emptyInputs.push(this);
                    }
                });
                if (emptyInputs.length > 0) {
                    e.preventDefault();
                    $(emptyInputs[0]).focus();
                }
            });
        });
    </script>

    <!-- Start content -->
    <div class="content">
        <div class="content-title"> جزئیات دیپارتمنت <?= $department['name'] ?></div>
        <br />
        <!-- start page content -->
        <div class="box-container">
            <div class="details">
                <div class="detail-item d-flex">
                    <div class="w100 m10 center">نام</div>
                    <div class="w100 m10 center"><?=$department['name']?></div>
                </div>
            </div>
            <div class="details">
                <div class="detail-item d-flex">
                    <div class="w100 m10 center">مسئول</div>
                    <div class="w100 m10 center"><?=$department['admin_id']?></div>
                </div>
            </div>
            <div class="details">
                <div class="detail-item d-flex">
                    <div class="w100 m10 center">تاریخ ثبت</div>
                    <div class="w100 m10 center"><?=$date[0]?></div>
                </div>
            </div>
            <div class="details">
                <div class="detail-item d-flex">
                    <div class="w100 m10 center">ساخته شده توسط</div>
                    <div class="w100 m10 center"><?=$userInfo['name']?></div>
                </div>
            </div>
            <div class="details">
                <div class="detail-item d-flex">
                    <div class="w100 m10 center">وضعیت</div>
                    <div class="w100 m10 center"><?= ($department['state'] == 1) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></div>
                </div>
            </div>
            <a href="<?= url('departments') ?>"><div class="btn center p5">برگشت</div></a>
        </div>
        <!-- end page content -->
    </div>
    <!-- End content -->

    <?php include_once('resources/views/layouts/footer.php') ?>