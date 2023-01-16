<?php

/** 
 * @var array $rows 
 * @var array $categories
 * @var array $errors
 * @var array $row
 * @var array $category
 * @var array $basket
 * @var array $basketItem
 * @var array $products
 */

use models\User;

?>


<h2 class="h3 mb-3 fw-normal text-center">Список товарів</h2>

<?php if (User::isAdmin()) : ?>
    <a href="/product/add" class="btn btn-primary mb-3">Додати товар</a>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-4 g-4 categories-list">
    <?php if (!empty($products)) : ?>
    <?php foreach ($products as $row) : ?>
        <div class="col">
            <a href="/product/view/<?= $row['id'] ?>" class="card-link">
                <div class="card">
                    <div class="imageFormat">
                        <?php if (!empty($row['photos'])) : ?>
                            <img src="<?= $row['photos'][0]['photo'] ?>" class="card-img-top" alt="">
                        <?php else : ?>
                            <img src="/static/images/no-image.jpg" class="card-img-top" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['name'] ?></h5>
                        <p class="card-text"><?= $row['short_description'] ?></p>
                        <p class="card-text"><?= $row['price'] ?> грн.</p>
                    </div>


                    <?php if (User::isAdmin()) : ?>
                        <div class="card-footer">
                            <a href="/product/edit/<?= $row['id'] ?>" class="btn btn-primary">Редагувати</a>
                            <a href="/product/delete/<?= $row['id'] ?>" class="btn btn-danger">Видалити</a>
                        </div>
                    <?php else : ?>
                        <!-- Кнопка детальніше -->
                        <div class="card-footer">
                            <a href="/product/view/<?= $row['id'] ?>" class="btn btn-success">Купити</a>
                            <!-- відгуки -->
                            <a href="/product/view/<?= $row['id'] ?>" class="btn btn-primary">Відгуки</a>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
    <?php else:?>
    <h3>Товарів не знайдено</h3>
    <?php endif;?>
</div>







