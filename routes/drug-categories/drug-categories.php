<?php
require_once 'Http/Controllers/drug-categories/DrugCategory.php';

// expenses routes
uri('drug-categories', 'App\DrugCategory', 'drugCategories');
uri('drug-cat-store', 'App\DrugCategory', 'drugCatStore', 'POST');
uri('drug-cat-details/{id}', 'App\DrugCategory', 'expenseCatDetails');
uri('edit-drug-category/{id}', 'App\DrugCategory', 'editDrugCat');
uri('edit-drug-cat-store/{id}', 'App\DrugCategory', 'editDrugCatStore', 'POST');
uri('change-status-drug-cat/{id}', 'App\DrugCategory', 'changeStatusDrugCat');





