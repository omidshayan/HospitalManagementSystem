<?php
require_once 'Http/Controllers/prescriptions/Prescription.php';

// drugs routes
uri('add-prescription', 'App\Prescription', 'addPrescription');
uri('prescriptions', 'App\Prescription', 'prescriptions');
uri('drug-prescription-store', 'App\Prescription', 'drugPrescriptionStore', 'POST');


// search
uri('search-product-purchase', 'App\Prescription', 'searchProdut', 'POST');


// editing
uri('edit-prescription/{id}', 'App\Prescription', 'editPrescription');
uri('edit-drug-prescription-store/{id}', 'App\Prescription', 'editDrugPrescriptionStore', 'POST');
uri('edit-close-prescription-store/{id}', 'App\Prescription', 'editClosePrescriptionStore', 'POST');


// prescription actions
uri('delete-prescription-list/{id}', 'App\Prescription', 'deletePrescriptionItem');
uri('delete-test-list/{id}', 'App\Prescription', 'deleteTestItem');
uri('delete-prescription/{id}', 'App\Prescription', 'deletePrescription');

uri('close-prescription-store/{id}', 'App\Prescription', 'closePrescriptionStore', 'POST');


// uri('close-prescription', 'App\Prescription', 'test', 'POST');
uri('single-prescriptions/print', 'App\Prescription', 'Single');


// patient Inquiry
uri('patient-inquiry', 'App\Prescription', 'patientInquiry');

uri('show-prescription-item/{id}', 'App\Prescription', 'showPrescriptionItem');
