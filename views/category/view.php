<?php

/**
 * @var array category
 * @var array products 
 * @var array wishlist
 */

use models\User;
?>

<h2 class="h3 mb-3 fw-normal text-center"><?= $category['name'] ?></h2>

<?php if (User::isAdmin()) : ?>
    <div class="mb-3">
        <a href="/product/add/<?= $category['id'] ?>" class="btn btn-success">Додати товар</a>
    </div>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-4 g-4 categories-list">
    <?php foreach ($products as $row) : ?>
        <div class="col">
            <a href="/product/view/<?= $row['id'] ?>" class="card-link">
                <div class="card">
                    <?php $filePath = 'files/product/' . $row['photo']; ?>
                    <div class="imageFormat">
                        <?php if (is_file($filePath)) : ?>
                            <img src="/<?= $filePath ?>" class="card-img-top" alt="">
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
                            <button type="button" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"></path>
                                </svg>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>