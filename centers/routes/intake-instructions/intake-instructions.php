<?php
require_once 'Http/Controllers/intake-instructions/IntakeInstructions.php';

// dosage routes
uri('intake-instructions', 'App\IntakeInstructions', 'intakeInstructions');
uri('intake-instructions-store', 'App\IntakeInstructions', 'intakeInstructionsStore', 'POST');
uri('edit-intake-instructions/{id}', 'App\IntakeInstructions', 'editIntakeInstructions');
uri('edit-intake-instructions-store/{id}', 'App\IntakeInstructions', 'editIntakeInstructionsStore', 'POST');
uri('intake-instructions-details/{id}', 'App\IntakeInstructions', 'intakeInstructionsDetails');
uri('change-status-intake-instructions/{id}', 'App\IntakeInstructions', 'changeStatusIntakeInstructions');
