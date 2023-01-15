<?php

/**
 * @var array $products
 * @var array $totalPrice
 * @var \models\User $user
 */

use models\User;

?>


<h2 class="h3 mb-3 fw-normal text-center">Список бажань</h2>

<?php if (!User::isUserAuthenticated()) : ?>
    <div class="alert alert-warning" role="alert">
        Для перегляду бажань необхідно авторизуватися!
    </div>
<?php else : ?>
    <?php if (empty($products)) : ?>
        <div class="alert alert-warning" role="alert">
            Ваш список бажань порожній!
        </div>
    <?php else : ?>
        <div class="row row-cols-1 row-cols-md-4 g-4 categories-list">
            <?php foreach ($products as $product) : ?>
                <div class="col">
                    <a href="/product/view/<?= $product['product']['id'] ?>" class="card-link">
                        <div class="card">
                            <?php $filePath = 'files/product/' . $product['product']['photo']; ?>
                            <div class="imageFormat">
                                <?php if (is_file($filePath)) : ?>
                                    <img src="/<?= $filePath ?>" class="card-img-top" alt="">
                                <?php else : ?>
                                    <img src="/static/images/no-image.jpg" class="card-img-top" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $product['product']['name'] ?></h5>
                                <p class="card-text"><?= $product['product']['price'] ?> грн.</p>
                                <p class="card-text">Кількість: <?= $product['count'] ?></p>
                            </div>
                            <div class="card-body">
                                <a href="/wishlist/remove/<?= $product['product']['id'] ?>" class="btn btn-danger">Видалити зі списку бажань</a>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

