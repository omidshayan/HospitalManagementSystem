<?php
require_once 'Http/Controllers/departments/Department.php';

// Department routes
uri('departments', 'App\Department', 'departments');
uri('department-store', 'App\Department', 'departmentStore', 'POST');
uri('edit-department/{id}', 'App\Department', 'editDepartment');
uri('edit-department-store/{id}', 'App\Department', 'editDepartmentStore', 'POST');
uri('department-details/{id}', 'App\Department', 'departmentDetails');
uri('change-status-department/{id}', 'App\Department', 'changeStatusDepartment');
