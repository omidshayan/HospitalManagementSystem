    <!-- start sidebar -->
    <?php include_once('resources/views/layouts/header.php');
    include_once('public/alerts/error.php');

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
        <div class="content-title">ویرایش دیپارتمنت <?=$department['name']?></div>
        <br />
        <!-- start page content -->
        <div class="content-container">
            <div class="insert">
                <form action="<?=url('edit-store').'/'.$department['id']?>" method="POST">
                    <div class="inputs d-flex">
                        <div class="one">
                            <div class="label-form mb5 fs14"><?= _name ?> <?= _star ?> </div>
                            <input type="text" name="name" class="checkInput" value="<?=$department['name']?>" placeholder="نام دیپارتمنت را وارد نمایید" />
                        </div>
                    </div>
                    <div class="inputs d-flex">
                        <div class="one">
                            <select name="admin_id">
                                <option selected disabled>انتخاب مسئول دیپارتمنت</option>
                                <option value="1">مسئول از بین کارمندان ثبت شده انتخاب میشه</option>
                                <option value="1"> </option>
                                <option value="1"> کارمند اول</option>
                                <option value="2"> کارمند دوم</option>
                                <option value="3">کارمند سوم</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" id="submit" value="insert" class="btn" />
                </form>
            </div>
            <a href="<?=url('departments')?>" class="color text-underline d-flex justify-center fs14">نمایش دیپارتمنت ها</a>
        </div>
        <!-- end page content -->
    </div>
    <!-- End content -->

    <?php include_once('resources/views/layouts/footer.php') ?>