<?php

/**
 * @var array $errors
 * @var array $model
 * @var array $categories
 * @var int|null $category_id
 */

?>

<h2>Додавання товару</h2>
<form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="name" class="form-label">Назва товару</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="">
        <?php if (!empty($errors['name'])) : ?>
            <div class="form-text text-danger"> <?= $errors['name']; ?></div>
        <?php endif; ?>
    </div>

    <div class = "mb-3">
        <label for="name" class = "form-label"> Виберіть категорію товару </label>
        <select class = "form-select" name = "category_id" id = "category_id">
            <?php foreach ($categories as $category) : ?>
                <option <?php if($category['id'] == $category_id) echo 'selected'; ?> value = "<?= $category['id']; ?>" <?= $category['id'] == $model['category_id'] ? 'selected' : ''; ?>> <?= $category['name']; ?> </option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['category_id'])) : ?>
            <div class="form-text text-danger"> <?= $errors['category_id']; ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Ціна товару</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="">
        <?php if (!empty($errors['price'])) : ?>
            <div class="form-text text-danger"> <?= $errors['price']; ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="count" class="form-label">Кількість товару</label>
        <input type="number" class="form-control" id="count" name="count" placeholder="">
        <?php if (!empty($errors['count'])) : ?>
            <div class="form-text text-danger"> <?= $errors['count']; ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="short_description" class="form-label">Короткий опис товару</label>
        <textarea class="ckeditor form-control" id="short_description" name="short_description" rows="3"></textarea>
        <?php if (!empty($errors['short_description'])) : ?>
            <div class="form-text text-danger"> <?= $errors['short_description']; ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Розширений опис товару</label>
        <textarea class="ckeditor form-control" id="description" name="description" rows="3"></textarea>
        <?php if (!empty($errors['description'])) : ?>
            <div class="form-text text-danger"> <?= $errors['description']; ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Статус товару</label>
        <select class="form-select" name="status" id="status">
            <option value="1">Активний</option>
            <option value="0">Неактивний</option>
        </select>
        <?php if (!empty($errors['visible'])) : ?>
            <div class="form-text text-danger"> <?= $errors['visible']; ?></div>
        <?php endif; ?>

    <div class="mb-3">
        <label for="file" class="form-label">Файли з фотографією для товару</label>
        <input multiple type="file" class="form-control" name="file" id="file" accept="image/jpeg" />
    </div>
    <div>
        <button class="btn btn-primary">Додати</button>
    </div>

</form>

<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    let editors = document.querySelectorAll('.ckeditor');
    for(let i = 0; i < editors.length; i++) {
        ClassicEditor
            .create(editors[i])
            .catch(error => {
                console.error(error);
            });
    }
</script>
