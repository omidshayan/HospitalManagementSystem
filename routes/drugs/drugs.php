<?php
require_once 'Http/Controllers/drugs/Drug.php';

// drugs routes
uri('add-drug', 'App\Drug', 'addDrug');
uri('drug-store', 'App\Drug', 'drugStore', 'POST');



uri('employees', 'App\Employee', 'showEmployees');
uri('employee-details/{id}', 'App\Employee', 'employeeDetails');
uri('edit-employee/{id}', 'App\Employee', 'editEmployee');
uri('edit-employee/store/{id}', 'App\Employee', 'editEmployeeStore', 'POST');
uri('change-status-employee/{id}', 'App\Employee', 'changeStatus');




