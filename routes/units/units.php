<?php
require_once 'Http/Controllers/units/Unit.php';

// units routes
uri('units', 'App\Unit', 'units');
uri('unit-store', 'App\Unit', 'unitStore', 'POST');
uri('unit-details/{id}', 'App\Unit', 'unitDetails');
uri('change-status-unit/{id}', 'App\Unit', 'changeStatusUnit');
