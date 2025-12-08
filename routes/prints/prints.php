<?php
require_once 'Http/Controllers/prints/Prints.php';

// exec cron job routes
uri('prescription-print/{id}', 'App\Prints', 'prescriptionPrint');


uri('prescription-print', 'App\Prints', 'print');

uri('auto-print', 'App\Prints', 'autoPrint');

uri('get-not-printed', 'App\Prints', 'getNotPrinted', 'POST');

uri('update-printed', 'App\Prints', 'updatePrinted', 'POST');
