<?php
require_once 'Http/Controllers/settings/PrescriptionSetting.php';

// prescriptionssettings routes

uri('prescription-change', 'App\PrescriptionSetting', 'prescriptionSettings');

uri('prescription-change-store', 'App\PrescriptionSetting', 'prescriptionChangeStore', 'POST');
