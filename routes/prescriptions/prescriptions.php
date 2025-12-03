<?php
require_once 'Http/Controllers/prescriptions/Prescription.php';

// drugs routes
uri('add-prescription', 'App\Prescription', 'addPrescription');


// search
uri('search-product-purchase', 'App\Prescription', 'searchProdut', 'POST');


// add drug in prescription 
uri('drug-prescription-store', 'App\Prescription', 'drugPrescriptionStore', 'POST');


// prescription actions
uri('delete-prescription-list/{id}', 'App\Prescription', 'deletePrescriptionItem');
uri('delete-prescription/{id}', 'App\Prescription', 'deletePrescription');

uri('close-prescription-store', 'App\Prescription', 'closePrescriptionStore', 'POST');


