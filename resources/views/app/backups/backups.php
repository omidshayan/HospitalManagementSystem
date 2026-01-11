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

    <a href="<?= url('backup-create') ?>" class="btn p10 bold mr10 fs14" id="backupBtn">بکاپ گیری</a>

    <!-- show packages -->
    <div class="mini-container">
        <div class="mb10 fs14"> بکاپ‌های ثبت شده</div>
        <table class="fl-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام بکاپ</th>
                    <th>تاریخ ثبت</th>
                    <th>توسط</th>
                    <th>دانلود</th>
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
                    <tr class="<?= $item['exists'] ? '' : 'color-red' ?>">
                        <td class="color-orange <?= ($item['status'] == 2) ? 'color-red' : '' ?>"><?= $number ?></td>
                        <td><?= htmlspecialchars($item['backup']) ?></td>
                        <td><?= jdate('Y/m/d', strtotime($item['created_at'])) ?></td>
                        <td class="fs12"><?= htmlspecialchars($item['who_it']) ?></td>
                        <td>
                            <?php if ($item['exists']): ?>
                                <a href="<?= url('backup-download/' . $item['id']) ?>" class="text-underline color">دانلود</a>
                            <?php else: ?>
                                <span class="fs12">فایل موجود نیست</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php
                    $number++;
                }
                ?>
            </tbody>
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

    <!-- load backup -->
    <div class="mini-container">
        <div class="text-right fs14">بازگردانی اطلاعات</div>
        <form action="<?= url('restor-backup') ?>" method="post">
            <div class="insert">
                <div class="inputs d-flex">
                    <div class="one">
                        <div class="label-form mb5 fs14">انتخاب بکاپ</div>
                        <input type="file" name="restor_backup" accept=".zip" required>
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                <input type="submit" id="submit" value="اعمال" class="btn" />
            </div>
        </form>
    </div>
    <!-- end load backup -->

</div>
<!-- End content -->

<!-- loading btn -->
<script>
    $(document).ready(function() {
        $('#backupBtn').on('click', function(e) {
            e.preventDefault();

            var $btn = $(this);
            $btn.prop('disabled', true);

            var originalText = $btn.text();

            $btn.html('<span class="load-spinner"></span> در حال پردازش...');

            window.location.href = $btn.attr('href');
        });
    });
</script>

<style>
    .load-spinner {
        border: 3px solid #f3f3f3 !important;
        border-top: 3px solid #3498db !important;
        border-radius: 50%;
        width: 14px;
        height: 14px;
        display: inline-block;
        vertical-align: middle;
        animation: load-spin 1s linear infinite;
        margin-left: 6px;
        font-size: 10px !important;
    }

    @keyframes load-spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<?php include_once('resources/views/layouts/footer.php') ?>