<?php
require_once 'Http/Controllers/settings/Setting.php';

// settings routes
uri('prescription-settings', 'App\Setting', 'prescriptionSettings');
uri('prescription-settings-store', 'App\Setting', 'prescriptionSettingsStore', 'POST');


uri('manage-years', 'App\Setting', 'manageYears');
uri('change-status-years/{id}', 'App\Setting', 'changeStatusYears', 'POST');


uri('pre-print-settings', 'App\Setting', 'prePrintSettings');
uri('change-status-pre-print', 'App\Setting', 'changeStatusPrePrint', 'POST');

uri('change-status-admission', 'App\Setting', 'changeStatusAdmission', 'POST');


// add prescription
uri('change-status-count-drug', 'App\Setting', 'changeStatusCountDrugShow', 'POST');
uri('change-status-intake-time', 'App\Setting', 'changeStatusIntakeTimeShow', 'POST');
uri('change-status-dosage', 'App\Setting', 'changeStatusDosageShow', 'POST');
uri('change-status-intake-instructions', 'App\Setting', 'changeStatusIntakeInstructionsShow', 'POST');
uri('change-status-tests', 'App\Setting', 'changeStatusTestsShow', 'POST');
uri('change-status-company-active', 'App\Setting', 'changeStatusCompanyActive', 'POST');
uri('change-status-description-active', 'App\Setting', 'changeStatusDescriptionActive', 'POST');
