<?php
require_once 'Http/Controllers/settings/Setting.php';

// settings routes
uri('prescription-settings', 'App\Setting', 'prescriptionSettings');
uri('prescription-settings-store', 'App\Setting', 'prescriptionSettingsStore', 'POST');


uri('manage-years', 'App\Setting', 'manageYears');
uri('change-status-years/{id}', 'App\Setting', 'changeStatusYears', 'POST');


// number drugs
uri('number-drugs', 'App\Setting', 'numberDrugs');

