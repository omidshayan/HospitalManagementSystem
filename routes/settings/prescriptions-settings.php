<?php
require_once 'Http/Controllers/settings/PrescriptionSetting.php';

// prescriptionssettings routes

uri('prescription-change', 'App\PrescriptionSetting', 'prescriptionSettings');

uri('change-status-description-active', 'App\PrescriptionSetting', 'changeStatusDescriptionActive', 'POST');
