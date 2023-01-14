<?php 
/**
 * @var array category
 * @var array products
 */

 use models\User;
?>

<h1><?=$category['name'] ?></h1>

<?php if (User::isAdmin()) : ?>
    <div class="mb-3">
        <a href="/product/add/<?=$category['id'] ?>" class="btn btn-success">Додати товар</a>
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
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>