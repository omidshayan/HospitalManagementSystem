<?php
require_once 'Http/Controllers/drug-types/DrugType.php';

// dosage routes
uri('drug-types', 'App\DrugType', 'drugTypes');
uri('drug-type-store', 'App\DrugType', 'drugTypeStore', 'POST');
uri('drug-type-dosage/{id}', 'App\DrugType', 'editDrugType');
uri('drug-type-edit-store/{id}', 'App\DrugType', 'editDrugTypeStore', 'POST');
uri('drug-type-details/{id}', 'App\DrugType', 'drugTypeDetails');
uri('change-status-drug-type/{id}', 'App\DrugType', 'changeStatusDrugType');



