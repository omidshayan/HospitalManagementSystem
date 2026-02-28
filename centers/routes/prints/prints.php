<?php
require_once 'Http/Controllers/prints/Prints.php';

// exec cron job routes
uri('prescription-print/{id}', 'App\Prints', 'prescriptionPrint');


uri('prescription-print', 'App\Prints', 'print');
uri('prescription-item-print/{id}', 'App\Prints', 'prescriptionItemPrint');

uri('auto-print', 'App\Prints', 'autoPrint');


uri('getNextPrescription', 'App\Prints', 'getNextPrescription');

uri('print-item/{id}', 'App\Prints', 'printItem');

