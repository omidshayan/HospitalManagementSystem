<?php
require_once 'Http/Controllers/tests/Test.php';

// expenses routes
uri('tests', 'App\Test', 'tests');
uri('test-store', 'App\Test', 'testStore', 'POST');

uri('edit-intake-time/{id}', 'App\IntakeTime', 'editIntakeTime');
uri('edit-intake-time-store/{id}', 'App\IntakeTime', 'editIntakeTimeStore', 'POST');
uri('intake-time-details/{id}', 'App\IntakeTime', 'intakeTimeDetails');

uri('change-status-intake-time/{id}', 'App\IntakeTime', 'changeStatusIntakeTime');
