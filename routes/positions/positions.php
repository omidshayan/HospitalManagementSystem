<?php
require_once 'Http/Controllers/positions/Position.php';

// add product routes
uri('positions', 'App\Position', 'Positions');
uri('position-store', 'App\Position', 'positionStore', 'POST');

uri('change-status-position/{id}', 'App\Position', 'changeStatus');
uri('edit-position/{id}', 'App\Position', 'editPosition');
uri('edit-position-store/{id}', 'App\Position', 'editPositionStore', 'POST');
uri('position-details/{id}', 'App\Position', 'positionDetails');





