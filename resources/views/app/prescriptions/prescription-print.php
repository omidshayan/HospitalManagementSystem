        <div class="center bg-whith">
            <?php
            $imagePath = asset('public/images/public') . '/' . $_SESSION['settings']['image'];
            ?>
            <div class="item-print p10" style="background-image: url('<?= $imagePath ?>');">

                <!-- top pre infos  -->
                <?php
                if ($prescrption_change['active_infos_pre'] == 1) : ?>
                    <div class="pa w100">
                        <div class="pre-p-title pa">
                            <h1 class="pre-color pre-title mr10"><?= $preInfos['center_name'] ?></h1>
                            <div class="pre-color bold pre-p-slogan pa"><?= $preInfos['slogan'] ?></div>
                        </div>
                        <div class="pa pre-p-logo">
                            <?= $preInfos['image']
                                ? '<img class="w130 pre-p-logo" src="' . asset('public/images/public/' . $preInfos['image']) . '" alt="logo" onclick="openModal(\'' . asset('public/images/public/' . $preInfos['image']) . '\')">'
                                : ' - - - - ' ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- patient infos -->
                <div class="p-patient-infos">
                    <span>
                        <span class="fs14">نام مریض:</span>
                        <span class="bold"> <?= $prescription['patient_name'] ?></span>
                    </span>
                    <span>
                        <span class="fs14">سن: </span>
                        <span class="bold"><?= $this->convertEnNumber($this->getAge($prescription['birth_year'])) ?></span>
                    </span>

                    <span>
                        <span class="fs14">تاریخ مراجعه: </span>
                        <span class="bold"><?= jdate('Y/m/d', strtotime($prescription['created_at'])) ?></span>
                    </span>
                </div>

                <!-- body pre... -->
                <div class="body-pre-print">

                    <!-- drugs list -->
                    <div class="p-drugs-print pr">

                        <table class="pa t0 w100">
                            <thead>
                                <tr class="fs12 p-color-title">
                                    <th class="w80 p5">طریقه مصرف</th>
                                    <th class="w120">مقدار مصرف هر نوبت</th>
                                    <th class="w80">زمان مصرف</th>
                                    <th class="">تعداد</th>
                                    <th class="">نام دارو</th>
                                    <th class="">نوع</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($items as $item) { ?>

                                    <div class="p-drugs-items">
                                        <tr class="p-color-item fs14 center">
                                            <td><?= $item['usage_instruction'] ?></td>
                                            <td><?= $item['dosage'] ?></td>
                                            <td><?= $item['interval_time'] ?></td>
                                            <td><?= $this->convertEnNumber($item['drug_count']) ?></td>
                                            <td class="p5 drug-name-en"> <?= $item['drug_name'] ?></td>
                                            <td class="p5 drug-name-en"> <?= $item['drug_type'] ?></td>
                                        </tr>
                                    </div>

                                <?php }
                                ?>
                            </tbody>
                        </table>

                    </div>

                    <!-- left infos -->
                    <div class="p-left-infos border-r">

                        <!-- doctor infos -->
                        <?php if ($prescrption_change['active_infos_pre'] == 1) : ?>
                            <div class="p-doctor-infos">
                                <h3>نام داکتر: <?= $prescription['employee_name'] ?></h3>
                                <span class="fs14 bold">تخصص: <?= $prescription['expertise'] ?></span>
                                <hr class="hrp">
                            </div>
                        <?php endif; ?>

                        <!-- infos -->
                        <div class="p-vital-signs fs12">
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['bp'] ?></span>
                                <span>BP</span>
                            </div>
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['pr'] ?></span>
                                <span>Pr</span>
                            </div>
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['rr'] ?></span>
                                <span>Rr</span>
                            </div>
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['temp'] ?></span>
                                <span>TEMP</span>
                            </div>
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['spo2'] ?></span>
                                <span>SPO₂</span>
                            </div>
                        </div>

                        <!-- tests -->
                        <ul class="p-recommended fs12">
                            <?php
                            if (!empty($tests)) {
                                foreach ($tests as $test) { ?>
                                    <li class="ol"><?= $test['test_name'] ?> </li>
                            <?php }
                            }
                            ?>
                        </ul>

                        <div class="fs14 mt50 text-left ml-10"><?= $prescription['diagnosis'] ?></div>
                    </div>

                </div>

                <!-- footer pre infos -->
                <?php if ($prescrption_change['active_infos_pre'] == 1) : ?>
                    <div class="pre-color pa w100">

                        <div class="pre-p-right-infos pa">
                            <div class="pre-p-address bold"><?= $preInfos['address'] ?></div>
                        </div>

                        <div class="pre-p-phones pa">
                            <div class="pre-p-address bold"><?= $preInfos['phone1'] ?></div>
                            <div class="pre-p-address bold"><?= $preInfos['phone2'] ?></div>
                        </div>
                        <div class="pre-p-phones-2 pa">
                            <div class="pre-p-address bold"><?= $preInfos['phone3'] ?></div>
                            <div class="pre-p-address bold"><?= $preInfos['phone4'] ?></div>
                        </div>

                        <div class="pre-p-left-infos"></div>
                    </div>
                <?php endif; ?>

            </div>
        </div>