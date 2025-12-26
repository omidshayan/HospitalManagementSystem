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
uri('change-status-count-drug', 'App\Setting', 'changeStatusCountDrug', 'POST');
uri('change-status-intake-time', 'App\Setting', 'changeStatusIntakeTime', 'POST');