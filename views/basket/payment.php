<?php

/** @var array $basket */

use models\User;

?>


<h2 class="h3 mb-3 fw-normal text-center">Оплата товару</h2>

<?php if (!User::isUserAuthenticated()) : ?>
    <div class="alert alert-danger" role="alert">
        Для оформлення замовлення необхідно авторизуватися!
    </div>
<?php else : ?>
    <form  method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Ваше ім'я" required>
            <label for="name">Ваше ім'я</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="phone" name="phone" placeholder="Ваш телефон" required>
            <label for="phone">Ваш телефон</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="address" name="address" placeholder="Ваша адреса" required>
            <label for="address">Ваша адреса</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="comment" name="comment" placeholder="Коментар до замовлення">
            <label for="comment">Коментар до замовлення</label>
        </div>
    

    <div class="mb-3">
        <label>До сплати: <?=$basket['totalPrice']?>₴</label>

    </div>
    <INPUT name="pay" type="submit"  class="w-100 btn btn-lg btn-primary" value="Оплатити">

    </form>

<?php endif; ?>