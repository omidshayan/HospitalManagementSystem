<?php
require_once 'Http/Controllers/dosage/Dosage.php';

// dosage routes
uri('dosage', 'App\Dosage', 'dosage');
uri('dosage-store', 'App\Dosage', 'dosageStore', 'POST');
uri('edit-dosage/{id}', 'App\Dosage', 'editDosage');
uri('edit-dosage-store/{id}', 'App\Dosage', 'editDosageStore', 'POST');
uri('dosage-details/{id}', 'App\Dosage', 'dosageDetails');
uri('change-status-dosage/{id}', 'App\Dosage', 'changeStatusDosage');
