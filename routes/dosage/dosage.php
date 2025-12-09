<?php
require_once 'Http/Controllers/dosage/Dosage.php';

// dosage routes
uri('dosage', 'App\intakeTime', 'dosage');
uri('dosage-store', 'App\intakeTime', 'dosageStore', 'POST');
uri('edit-dosage/{id}', 'App\intakeTime', 'editDosage');
uri('edit-dosage-store/{id}', 'App\intakeTime', 'editDosageStore', 'POST');
uri('dosage-details/{id}', 'App\intakeTime', 'dosageDetails');
uri('change-status-dosage/{id}', 'App\intakeTime', 'changeStatusDosage');
