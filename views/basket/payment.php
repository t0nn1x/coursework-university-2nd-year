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
    <form action="/basket/payment" method="post">
        <div class="form-floating">
            <input type="text" class="form-control" id="name" name="name" placeholder="Ваше ім'я" required>
            <label for="name">Ваше ім'я</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Ваш телефон" required>
            <label for="phone">Ваш телефон</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="address" name="address" placeholder="Ваша адреса" required>
            <label for="address">Ваша адреса</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="comment" name="comment" placeholder="Коментар до замовлення">
            <label for="comment">Коментар до замовлення</label>
        </div>
    

    <div class="mb-3"></div>

    <div class="container p-0">
        <div class="card px-4">
            <p class="h8 py-3">Payment Details</p>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Person Name</p>
                        <input class="form-control mb-3" type="text" placeholder="Name" value="Barry Allen">
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Card Number</p>
                        <input class="form-control mb-3" type="text" placeholder="1234 5678 435678">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Expiry</p>
                        <input class="form-control mb-3" type="text" placeholder="MM/YYYY">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">CVV/CVC</p>
                        <input class="form-control mb-3 pt-2 " type="password" placeholder="***">
                    </div>
                </div>
                <div class="col-12">
                    <div class="btn btn-primary mb-3">
                        <span class="ps-3">Оплатити</span>
                        <span class="fas fa-arrow-right"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

<?php endif; ?>