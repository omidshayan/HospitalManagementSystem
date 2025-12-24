<?php
require_once 'Http/Controllers/admissions/Admission.php';

// admissions routes
uri('admission/create', 'App\Drug', 'admissionCreate');
uri('admission/store', 'App\Drug', 'drugStore', 'POST');
uri('admissions', 'App\Drug', 'showDrugs');
uri('admission/details/{id}', 'App\Drug', 'drugDetails');
uri('edit/admission/{id}', 'App\Drug', 'editDrug');
uri('edit/admission/store/{id}', 'App\Drug', 'editDrugStore', 'POST');
uri('change/status/admission/{id}', 'App\Drug', 'changeDrugStatus');







