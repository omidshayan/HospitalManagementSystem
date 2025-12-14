<?php
require_once 'Http/Controllers/tests/Test.php';

// expenses routes
uri('tests', 'App\Test', 'tests');
uri('test-store', 'App\Test', 'testStore', 'POST');
uri('edit-test/{id}', 'App\Test', 'editTest');
uri('edit-test-store/{id}', 'App\Test', 'editTestStore', 'POST');

uri('intake-time-details/{id}', 'App\IntakeTime', 'intakeTimeDetails');

uri('change-status-intake-time/{id}', 'App\IntakeTime', 'changeStatusIntakeTime');
