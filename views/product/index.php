<?php

/** 
 * @var array $rows 
 * @var array $categories
 * @var array $errors
 * @var array $row
 * @var array $category
 * @var array $basket
 * @var array $basketItem
 * @var array $basketItems
 */

use models\User;

?>


<h2 class="h3 mb-3 fw-normal text-center">Список товарів</h2>

<?php if (User::isAdmin()) : ?>
    <a href="/product/add" class="btn btn-primary mb-3">Додати товар</a>
<?php endif; ?>









