<?php
require_once 'Http/Controllers/settings/PrescriptionSetting.php';

// prescriptionssettings routes

uri('prescription-change', 'App\PrescriptionSetting', 'prescriptionSettings');

uri('prescription-change-store', 'App\PrescriptionSetting', 'prescriptionChangeStore', 'POST');

uri('change-status-active-infos-pre', 'App\PrescriptionSetting', 'changeStatusActiveInfosPre', 'POST');

uri('change-status-active-doctor-infos', 'App\PrescriptionSetting', 'changeStatusActiveDoctorInfos', 'POST');

// backup
uri('backup', 'App\PrescriptionSetting', 'backup');

uri('backup-create', 'App\PrescriptionSetting', 'backupCreate');

uri('backup-download/{id}', 'App\PrescriptionSetting', 'backupDownload');
