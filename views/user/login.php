<?php
/** @var string|null $error */
/** @var array $model */
core\Core::getInstance()->pageParams['title'] = 'Вхід на сайт';
?>

<h1 class="h3 mb-3 fw-normal text-center">Вхід на сайт</h1>
<main class="form-signin w-100 m-auto">
    <form action="" method="post">
        <?php if (!empty($error)) : ?>
            <div class="message error text-center mb-2">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <div class="form-floating">
            <input type="email" class="form-control" name="login" id="login" value="<?= $model['login'] ?>"
                   placeholder="name@example.com">
            <label for="login">Електронна пошта</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="password" value="<?= $model['password'] ?>"
                   placeholder="Password">
            <label for="password">Пароль</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Увійти</button>
    </form>
</main>