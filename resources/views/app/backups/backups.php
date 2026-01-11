<!-- start sidebar -->
<?php
$title = 'مدیریت پشتیبان گیری';
include_once('resources/views/layouts/header.php');
include_once('public/alerts/check-inputs.php');
include_once('public/alerts/toastr.php');
?>
<!-- end sidebar -->

<!-- Start content -->
<div class="content">
    <div class="content-title"> مدیریت پشتیبان گیری
        <span class="help fs14 text-underline cursor-p color-orange" id="openModalBtn">(راهنما)</span>
    </div>
    <?php
    $help_title = 'بخش بکاپ';
    $help_content = 'اطلاعات راهنما';
    include_once('resources/views/helps/help.php');
    ?>

    <!-- show packages -->
    <div class="mini-container">
        <div class="mb10 fs14"> بکاپ‌های ثبت شده</div>
        <table class="fl-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نوع دارو</th>
                    <th>ویرایش</th>
                    <th>جزئیات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $perPage = 10;
                $data = paginate($backups, $perPage);
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $number = ($currentPage - 1) * $perPage + 1;
                foreach ($data as $item) {
                ?>
                    <tr>
                        <td class="color-orange <?= ($item['status'] == 2) ? 'color-red' : '' ?>"><?= $number ?></td>
                        <td><?= $item['backups'] ?></td>
                        <td><?= jdate('Y/m/d', $item['created_at']) ?></td>

                    </tr>
                <?php
                    $number++;
                }
                ?>
            </tbody>
            <tbody></tbody>
        </table>
        <div class="flex-justify-align mt20 paginate-section">
            <div class="table-info fs12">تعداد کل: <?= count($backups) ?></div>
            <?php
            if (count($backups) == null) { ?>
                <div class="center color-red fs12">
                    <i class="fa fa-comment"></i>
                    <?= _not_infos ?>
                </div>
            <?php } else {
                if (count($backups) > 10) {
                    echo paginateView($backups, 10);
                }
            }
            ?>
        </div>
    </div>
    <!-- end page content -->
</div>
<!-- End content -->

<?php include_once('resources/views/layouts/footer.php') ?>