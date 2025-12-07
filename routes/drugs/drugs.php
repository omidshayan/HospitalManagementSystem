<?php
require_once 'Http/Controllers/drugs/Drug.php';

// drugs routes
uri('add-drug', 'App\Drug', 'addDrug');
uri('drug-store', 'App\Drug', 'drugStore', 'POST');
uri('drugs', 'App\Drug', 'showDrugs');
uri('drug-details/{id}', 'App\Drug', 'drugDetails');
uri('edit-drug/{id}', 'App\Drug', 'editDrug');
uri('edit-drug/store/{id}', 'App\Drug', 'editDrugStore', 'POST');
uri('change-status-drug/{id}', 'App\Drug', 'changeDrugStatus');







