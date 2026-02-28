<?php
require_once 'Http/Controllers/intake-times/IntakeTime.php';

// expenses routes
uri('intake-times', 'App\IntakeTime', 'intakeTimes');
uri('intake-time-store', 'App\IntakeTime', 'intakeTimeStore', 'POST');
uri('edit-intake-time/{id}', 'App\IntakeTime', 'editIntakeTime');
uri('edit-intake-time-store/{id}', 'App\IntakeTime', 'editIntakeTimeStore', 'POST');
uri('intake-time-details/{id}', 'App\IntakeTime', 'intakeTimeDetails');

uri('change-status-intake-time/{id}', 'App\IntakeTime', 'changeStatusIntakeTime');
