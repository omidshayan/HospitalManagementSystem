<?php
require_once 'Http/Controllers/drug-categories/DrugCategory.php';

// expenses routes
uri('categories-drugs', 'App\DrugCategory', 'drugCategories');
uri('drug-cat-store', 'App\DrugCategory', 'drugCatStore', 'POST');


uri('expense-cat-details/{id}', 'App\DrugCategory', 'expenseCatDetails');
uri('change-status-expense-cat/{id}', 'App\DrugCategory', 'changeStatusExpenseCat');
uri('edit-cat-expense/{id}', 'App\DrugCategory', 'editExpense');
uri('edit-cat-store/{id}', 'App\DrugCategory', 'editCatStore', 'POST');





