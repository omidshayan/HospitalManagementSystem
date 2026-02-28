<?php
require_once 'Http/Controllers/patients/Patient.php';

// add patients routes
uri('patients', 'App\Patient', 'patients');

// live search
uri('live-search-patient', 'App\Patient', 'liveSearchPatient', 'POST');




