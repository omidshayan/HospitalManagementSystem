<?php
require_once 'Http/Controllers/drug-types/DrugType.php';

// dosage routes
uri('drug-types', 'App\DrugType', 'drugTypes');
uri('drug-type-store', 'App\DrugType', 'drugTypeStore', 'POST');



uri('edit-dosage/{id}', 'App\Dosage', 'editDosage');
uri('edit-dosage-store/{id}', 'App\Dosage', 'editDosageStore', 'POST');
uri('dosage-details/{id}', 'App\Dosage', 'dosageDetails');
uri('change-status-dosage/{id}', 'App\Dosage', 'changeStatusDosage');
