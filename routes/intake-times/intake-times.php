<?php
require_once 'Http/Controllers/intake-times/intakeTime.php';

// expenses routes
uri('intake-times', 'App\intakeTime', 'intakeTimes');
uri('intake-times-store', 'App\intakeTime', 'intakeTimesStore', 'POST');
