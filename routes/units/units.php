<?php
require_once 'Http/Controllers/products-category/ProductCategory.php';

// Product category routes
uri('products-category', 'App\ProductCategory', 'productsCategory');
uri('product-category-store', 'App\ProductCategory', 'productsCategoryStore', 'POST');

uri('product-category-details/{id}', 'App\ProductCategory', 'productCategoryDetails');
uri('change-status-product-cat/{id}', 'App\ProductCategory', 'changeStatusProductCat');


uri('change-status-expense-cat/{id}', 'App\ExpensesCategory', 'changeStatusExpenseCat');
uri('edit-expense-cat/{id}', 'App\ExpensesCategory', 'editExpenseCat');







