<?php
require_once 'Http/Controllers/settings/Setting.php';

// settings routes


uri('manage-years', 'App\Setting', 'manageYears');
uri('change-status-years/{id}', 'App\Setting', 'changeStatusYears', 'POST');




