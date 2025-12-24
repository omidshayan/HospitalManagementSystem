<?php
require_once 'Http/Controllers/admissions/Admission.php';

// admissions routes
uri('admission/create', 'App\Admission', 'admissionCreate');
uri('admission/store', 'App\Admission', 'admissionStore', 'POST');
uri('admissions', 'App\Admission', 'admissions');
uri('admission/details/{id}', 'App\Admission', 'admissionDetails');
uri('edit/admission/{id}', 'App\Admission', 'editAdmission');
uri('edit/admission/store/{id}', 'App\Admission', 'editAdmissionStore', 'POST');
uri('change/status/admission/{id}', 'App\Admission', 'changeAdmissionStatus');







