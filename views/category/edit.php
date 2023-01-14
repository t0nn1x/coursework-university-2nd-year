<?php

/**
 * @var array $errors
 * @var array $model
 * @var array $category
 */
?>

<h2>Редагування категорії</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Назва категорії</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?= $category['name'] ?>">
        <?php if (!empty($errors['name'])) : ?>
            <div class="form-text text-danger"> <?= $errors['name']; ?></div>
        <?php endif; ?>
    </div>
    <div class="col-2">
        <?php $filePath = 'files/category/' . $category['photo']; ?>
        <?php if (is_file($filePath)) : ?>
            <img class="img-thumbnail card-img-top" src="/<?= $filePath ?>" alt="">
        <?php else : ?>
            <img class="img-thumbnail card-img-top" src="/static/images/no-image.jpg" alt="">
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Файл з фотографією для категорії (замінити фото)</label>
        <input type="file" class="form-control" name="file" id="file" accept="image/jpeg" />
    </div>
    <div>
        <button class="btn btn-primary">Зберегти</button>
    </div>
</form>