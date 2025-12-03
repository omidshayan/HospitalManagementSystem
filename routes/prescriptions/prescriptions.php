<?php
require_once 'Http/Controllers/prescriptions/Prescription.php';

// drugs routes
uri('add-prescription', 'App\Prescription', 'addPrescription');


uri('search-product-purchase', 'App\Prescription', 'searchProdut', 'POST');

uri('get-product-infos', 'App\Prescription', 'getProductInfos', 'POST');






















uri('employees', 'App\Employee', 'showEmployees');
uri('employee-store', 'App\Employee', 'employeeStore', 'POST');
uri('employee-details/{id}', 'App\Employee', 'employeeDetails');
uri('edit-employee/{id}', 'App\Employee', 'editEmployee');
uri('edit-employee/store/{id}', 'App\Employee', 'editEmployeeStore', 'POST');
uri('change-status-employee/{id}', 'App\Employee', 'changeStatus');




