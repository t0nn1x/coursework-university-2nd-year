<?php 
/**
 * @var array $category
 */
?>

<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Видалити категорію "<?=$category['name'] ?>"?</h4>
    <p>Після видалення категорії всі товари даної категорії потраплять до стандартної категорії <b>"Не визначено"</b></p>
    <hr>
    <p class="mb-0">
        <a href="/category/delete/<?=$category['id'] ?>/yes" class="btn btn-danger">Видалити</a>
        <a href="/category" class="btn btn-secondary">Відмінити</a>
    </p>
</div>