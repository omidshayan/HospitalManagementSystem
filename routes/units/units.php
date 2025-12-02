<?php
require_once 'Http/Controllers/units/Unit.php';

// units routes
uri('units', 'App\ProductCategory', 'Unit');

uri('unit-store', 'App\Unit', 'unitStore', 'POST');



uri('product-category-details/{id}', 'App\Unit', 'productCategoryDetails');
uri('change-status-product-cat/{id}', 'App\Unit', 'changeStatusProductCat');
