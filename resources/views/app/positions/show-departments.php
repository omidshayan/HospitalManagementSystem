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
        <div class="content-title">نمایش دیپارتمنت ها</div>
        <br />
        <div class="content-container">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام دیپارتمنت</th>
                        <th>مسئول</th>
                        <th>وضعیت</th>
                        <th>تغییر وضعیت</th>
                        <th>ویرایش</th>
                        <th>جزئیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($departments as $department) { ?>
                        <tr>
                            <td>1</td>
                            <td><?= $department['name'] ?></td>
                            <td><?= $department['admin_id'] ?></td>
                            <td>
                                <span class="status"><?= ($department['state'] == 1) ? '<span class="color-green">فعال</span>' : '<span class="color-red">غیرفعال</span>' ?></span>
                            </td>
                            <td>
                                <span><a href="<?= url('change-status/' . $department['id']) ?>" class="color btn p5">تغییر وضعیت</a></span>
                            </td>
                            <td><a href="<?= url('edit-department/' . $department['id']) ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg></td></a>
                            <td><a href="<?=url('department-details/'. $department['id'])?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg></td></a>
                        </tr>
                    <?php }

                    ?>

                </tbody>

                <tbody></tbody>
            </table>

            <div class="flex-justify-align mt20">

                paginate
            </div>
        </div>
    </div>
    <!-- End content -->

    <?php include_once('resources/views/layouts/footer.php') ?>