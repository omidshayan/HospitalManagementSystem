<?php
require_once 'Http/Controllers/prescriptions/Prescription.php';

// drugs routes
uri('add-prescription', 'App\Prescription', 'addPrescription');
uri('prescriptions', 'App\Prescription', 'prescriptions');


// search
uri('search-product-purchase', 'App\Prescription', 'searchProdut', 'POST');


// add drug in prescription 
uri('drug-prescription-store', 'App\Prescription', 'drugPrescriptionStore', 'POST');


// prescription actions
uri('delete-prescription-list/{id}', 'App\Prescription', 'deletePrescriptionItem');
uri('delete-prescription/{id}', 'App\Prescription', 'deletePrescription');

uri('close-prescription-store/{id}', 'App\Prescription', 'closePrescriptionStore', 'POST');


uri('close-prescription', 'App\Prescription', 'test', 'POST');



uri('patient-inquiry', 'App\Prescription', 'omid');