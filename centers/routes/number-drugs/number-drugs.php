<?php
require_once 'Http/Controllers/number-drugs/NumberDrug.php';

// expenses routes
uri('number-drugs', 'App\NumberDrug', 'numberDrugs');
uri('number-drugs-store', 'App\NumberDrug', 'numberDrugsStore', 'POST');
