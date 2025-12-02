<?php
require_once 'Http/Controllers/categories-drugs/CategoryDrug.php';

// expenses routes
uri('categories-drugs', 'App\CategoryDrug', 'categoriesDrugs');


uri('expense-cat-store', 'App\ExpensesCategory', 'expenseCatStore', 'POST');
uri('expense-cat-details/{id}', 'App\ExpensesCategory', 'expenseCatDetails');
uri('change-status-expense-cat/{id}', 'App\ExpensesCategory', 'changeStatusExpenseCat');
uri('edit-cat-expense/{id}', 'App\ExpensesCategory', 'editExpense');
uri('edit-cat-store/{id}', 'App\ExpensesCategory', 'editCatStore', 'POST');





