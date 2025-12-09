<?php
require_once 'Http/Controllers/intake-times/intakeTime.php';

// expenses routes
uri('intake-times', 'App\intakeTime', 'intakeTimes');
uri('intake-time-store', 'App\intakeTime', 'intakeTimeStore', 'POST');

uri('intake-time-details/{id}', 'App\intakeTime', 'expenseIntakeTime');
uri('change-status-intake-time/{id}', 'App\intakeTime', 'changeStatusIntakeTime');
uri('edit-intake-time/{id}', 'App\intakeTime', 'editIntakeTime');
uri('edit-intake-time-store/{id}', 'App\intakeTime', 'editIntakeTime', 'POST');
