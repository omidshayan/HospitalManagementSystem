        <div class="pre-body-right">
            <?php
            if ($prescription) { ?>
                <div class="content-create-pre mb30 mt20">
                    <div class="mb10 fs14 d-flex justify-between">
                        <div class="mr30">
                            <span><?= (!empty($drugList)) ? 'لیست دواها' : '' ?></span>
                            <?php
                            if (empty($drugList) && empty($recommended)) { ?>

                                <a href="<?= url('delete-prescription/' . $prescription['id']) ?>" class="color-red text-underline delete-prescription">حذف نسخه</a>
                            <?php }
                            ?>
                        </div>
                    </div>

                    <?php
                    if (!empty($drugList)) { ?>
                        <table class="fl-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام دارو</th>
                                    <th>تعداد</th>
                                    <th>تولید کننده</th>
                                    <th>زمان مصرف</th>
                                    <th>مقدار | واحد</th>
                                    <th>طریقه مصرف</th>
                                    <th>توضیحات</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody id="drugListBody">
                                <?php
                                $number = 1;
                                foreach ($drugList as $item) {
                                ?>
                                    <tr>
                                        <td class="color-orange"><?= $number ?></td>
                                        <td class="fs18"><?= $item['drug_name'] ?></td>
                                        <td><?= $item['drug_count'] ?: '- - - -' ?></td>
                                        <td><?= $item['company'] ?: '- - - -' ?></td>
                                        <td><?= ($item['interval_time']) ?: '- - - -' ?></td>
                                        <td><?= ($item['dosage']) ?: '- - - -' ?></td>
                                        <td><?= ($item['usage_instruction']) ?: '- - - -' ?></td>
                                        <td><?= $item['description'] ?: '- - - -' ?></td>
                                        <td>
                                            <a href="<?= url('delete-prescription-list/' . $item['id']) ?>" class="delete-drug flex-justify-align">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512">
                                                    <path fill="#ff0000" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $number++;
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php }
                    ?>


                    <?php
                    if (!empty($recommended)) { ?>

                        <div class="p5">لیست آزمایشات</div>
                        <table class="fl-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام آزمایش</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $number = 1;
                                foreach ($recommended as $item) {
                                ?>
                                    <tr>
                                        <td class="color-orange"><?= $number ?></td>
                                        <td><?= $item['test_name'] ?></td>
                                        <td>
                                            <a href="<?= url('delete-test-list/' . $item['recommended_id']) ?>" class="delete-drug flex-justify-align">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512">
                                                    <path fill="#ff0000" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $number++;
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php }
                    ?>

                    <div class="flex-justify-align mt20 paginate-section">
                        <div class="table-info fs12">تعداد کل: <?= count($drugList) + count($recommended) ?></div>
                        <?= $drugList || $recommended ? '
                                    <a href="' . url('close-prescription-store/' . $prescription['id']) . '"
                                    class="color btn p5-20 bg-success bold pa close-p"
                                    id="closePrescriptionBtn">
                                    <span class="heart-beat">❤</span>
                                    بــسـتن نــسـخـه
                                    </a>' : '' ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="color-red fs14 center mt50 bg-success p10">نسخه خالی است</div>
            <?php }
            ?>
        </div>