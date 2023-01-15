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
 * @var array $product
 * @var array $model
 * @var array $photos
 */

use models\User;

?>

<h2>Редагування товару</h2>

<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Назва товару</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?= $product['name'] ?>">
        <?php if (!empty($errors['name'])) : ?>
            <div class="form-text text-danger"> <?= $errors['name']; ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Опис товару</label>
        <textarea class="ckeditor form-control" id="description" name="description" rows="3"><?= $product['description'] ?></textarea>
        <?php if (!empty($errors['description'])) : ?>
            <div class="form-text text-danger"> <?= $errors['description']; ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Ціна товару</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="" value="<?= $product['price'] ?>">
        <?php if (!empty($errors['price'])) : ?>
            <div class="form-text text-danger"> <?= $errors['price']; ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Категорія товару</label>
        <select class="form-select" id="category_id" name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['id'] ?>" <?= $category['id'] == $row['category_id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['category_id'])) : ?>
            <div class="form-text text-danger"> <?= $errors['category_id']; ?></div>
        <?php endif; ?>
    </div>

    <?php if (!empty($photos)) : $i=0?>
        <?php if (!empty($errors['photo'])) : ?>
            <div class="message error">
                <?= $errors['photo'] ?>
            </div>
        <?php endif; ?>

        <?php foreach ($photos as $photo) : ?>
            <div class="mb-3">
                <label class="form-label">Фото товару</label>
                <input value="<?=$photo['photo']?>" type="url" class="form-control" name="photo<?=$i?>" >
            </div>
            <?php $i++; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="text-center mb-4">
        <button type="submit" class="btn btn-primary">Змініити товар</button>
    </div>

    <button type="submit" class="btn btn-primary">Зберегти</button>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <script>
        let editors = document.querySelectorAll('.ckeditor');
        for (let i = 0; i < editors.length; i++) {
            ClassicEditor
                .create(editors[i])
                .catch(error => {
                    console.error(error);
                });
        }
    </script>