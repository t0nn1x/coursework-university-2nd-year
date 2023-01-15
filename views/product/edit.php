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

    <div class="col-2">
        <?php $filePath = 'files/product/' . $row['photo']; ?>
        <?php if (is_file($filePath)) : ?>
            <img class="img-thumbnail card-img-top" src="/<?= $filePath ?>" alt="">
        <?php else : ?>
            <img class="img-thumbnail card-img-top" src="/static/images/no-image.jpg" alt="">
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">Файл з фотографією для товару (замінити фото)</label>
        <input type="file" class="form-control" name="file" id="file" accept="image/jpeg" />
        <?php if (!empty($errors['file'])) : ?>
            <div class="form-text text-danger"> <?= $errors['file']; ?></div>
        <?php endif; ?>
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