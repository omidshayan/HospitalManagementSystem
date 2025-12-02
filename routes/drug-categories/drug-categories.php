<?php
require_once 'Http/Controllers/drug-categories/DrugCategory.php';

// expenses routes
uri('categories-drugs', 'App\DrugCategory', 'drugCategories');


uri('expense-cat-store', 'App\ExpensesCategory', 'expenseCatStore', 'POST');
uri('expense-cat-details/{id}', 'App\ExpensesCategory', 'expenseCatDetails');
uri('change-status-expense-cat/{id}', 'App\ExpensesCategory', 'changeStatusExpenseCat');
uri('edit-cat-expense/{id}', 'App\ExpensesCategory', 'editExpense');
uri('edit-cat-store/{id}', 'App\ExpensesCategory', 'editCatStore', 'POST');





