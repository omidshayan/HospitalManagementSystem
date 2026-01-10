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
                                    <?= ($settings['description'] == 1) ? '<th class="w80 p5 fs11">توضیحات</th>' : '' ?>

                                    <?= ($settings['intake_instructions'] == 1) ? '<th class="w80 p5 fs11">طریقه مصرف</th>' : '' ?>

                                    <?= ($settings['dosage'] == 1) ? '<th class="w120 fs11">مقدار مصرف</th>' : '' ?>

                                    <?= ($settings['intake_time'] == 1) ? '<th class="w80 fs11">زمان مصرف</th>' : '' ?>

                                    <?= ($settings['company'] == 1) ? '<th class="fs11">تولیدکننده</th>' : '' ?>

                                    <?= ($settings['count_drug'] == 1) ? '<th class="fs11">تعداد</th>' : '' ?>

                                    <th class="fs11">نام دارو</th>

                                    <?= ($settings['drug_type'] == 1) ? '<th class="fs11">نوع</th>' : '' ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($items as $item) { ?>
                                    <div class="p-drugs-items">
                                        <tr class="p-color-item fs14 center">

                                            <?php if (!empty($settings['description']) && (int)$settings['description'] === 1): ?>
                                                <td><?= htmlspecialchars($item['description'] ?? '') ?></td>
                                            <?php endif; ?>

                                            <?php if (!empty($settings['intake_instructions']) && (int)$settings['intake_instructions'] === 1): ?>
                                                <td><?= htmlspecialchars($item['usage_instruction'] ?? '') ?></td>
                                            <?php endif; ?>

                                            <?php if (!empty($settings['dosage']) && (int)$settings['dosage'] === 1): ?>
                                                <td><?= htmlspecialchars($item['dosage'] ?? '') ?></td>
                                            <?php endif; ?>

                                            <?php if (!empty($settings['intake_time']) && (int)$settings['intake_time'] === 1): ?>
                                                <td><?= htmlspecialchars($item['interval_time'] ?? '') ?></td>
                                            <?php endif; ?>

                                            <?php if (!empty($settings['company']) && (int)$settings['company'] === 1): ?>
                                                <td><?= htmlspecialchars($item['company'] ?? '') ?></td>
                                            <?php endif; ?>

                                            <?php if (!empty($settings['count_drug']) && (int)$settings['count_drug'] === 1): ?>
                                                <td><?= $item['drug_count'] ?></td>
                                            <?php endif; ?>

                                            <td class="p5 drug-name-en center"><?= htmlspecialchars($item['drug_name'] ?? '') ?></td>

                                            <?php if (!empty($settings['drug_type']) && (int)$settings['drug_type'] === 1): ?>
                                                <td class="p5 w30"><?= htmlspecialchars($item['drug_type'] ?? '') ?></td>
                                            <?php endif; ?>

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
                        <?php
                        if (isset($settings['active_doctor_infos']) && $settings['active_doctor_infos'] == 1) { ?>
                            <div class="p-doctor-infos">
                                <h3>نام داکتر: <?= $prescription['employee_name'] ?></h3>
                                <span class="fs14 bold">تخصص: <?= $prescription['expertise'] ?></span>
                                <hr class="hrp">
                            </div>
                        <?php }
                        ?>

                        <!-- Vital Signs -->
                        <div class="p-vital-signs fs12">
                            <div class="fs20 bold ml-5">Vital Signs</div>
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['bp'] ?></span>
                                <span>BP</span>
                            </div>
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['pr'] ?></span>
                                <span>PR</span>
                            </div>
                            <div class="d-flex justify-between pr8">
                                <span><?= $prescription['rr'] ?></span>
                                <span>RR</span>
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

                        <!-- clinical findings -->
                        <?php
                        if ($prescription['clinical_findings'] != '') { ?>
                            <div class="fs20 bold mt20 text-left ml-10">Clinical Findings</div>
                            <div class="fs14 text-left ml-10"><?= $prescription['clinical_findings'] ?></div>
                        <?php }
                        ?>

                        <!-- tests -->
                        <!-- <ul class="p-recommended fs12">
                            <?php
                            if (!empty($tests)) {
                                foreach ($tests as $test) { ?>
                                    <li class="ol"><?= $test['test_name'] ?> </li>
                            <?php }
                            }
                            ?>
                        </ul> -->

                        <?php
                        if ($prescription['clinical_findings'] != '') { ?>
                            <div class="fs20 bold mt20 text-left ml-10 mt50">Diagnosis</div>
                            <div class="fs14 text-left ml-10"><?= $prescription['diagnosis'] ?></div>
                        <?php }
                        ?>

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