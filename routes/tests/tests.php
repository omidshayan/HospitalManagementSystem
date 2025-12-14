<?php
require_once 'Http/Controllers/tests/Test.php';

// expenses routes
uri('tests', 'App\Test', 'tests');
uri('test-store', 'App\Test', 'testStore', 'POST');
uri('edit-test/{id}', 'App\Test', 'editTest');
uri('edit-test-store/{id}', 'App\Test', 'editTestStore', 'POST');
uri('test-details/{id}', 'App\Test', 'testDetails');
uri('change-status-test/{id}', 'App\Test', 'changeStatusTest');


