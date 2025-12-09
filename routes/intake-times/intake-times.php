<?php
require_once 'Http/Controllers/intake-times/intakeTime.php';

// expenses routes
uri('intake-times', 'App\intakeTime', 'intakeTimes');
uri('intake-time-store', 'App\intakeTime', 'intakeTimeStore', 'POST');
