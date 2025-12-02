<?php
require_once 'Http/Controllers/drugs/Drug.php';

// drugs routes
uri('drugs', 'App\Drug', 'drugs');


uri('employees', 'App\Employee', 'showEmployees');
uri('employee-store', 'App\Employee', 'employeeStore', 'POST');
uri('employee-details/{id}', 'App\Employee', 'employeeDetails');
uri('edit-employee/{id}', 'App\Employee', 'editEmployee');
uri('edit-employee/store/{id}', 'App\Employee', 'editEmployeeStore', 'POST');
uri('change-status-employee/{id}', 'App\Employee', 'changeStatus');




