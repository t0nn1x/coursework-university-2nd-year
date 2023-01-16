<?php

/**
 * @var array $product
 */
?>
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="row g-0">
            <div class="col-md-6 border-end">
                <div class="d-flex flex-column justify-content-center">


                    <div class="main_image">
                        <img src="<?=$product['photos'][0]['photo']?>" id="main_product_image" width="350">
                    </div>
                    <div class="thumbnail_images">
                        <ul id="thumbnail">
                            <?php if(!empty($product['photos'])): ?>
                            <?php foreach ($product['photos'] as $photo) : ?>
                                <li><img onclick="changeImage(this)" src="<?=$photo['photo']?>" width="70"></li>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <li><img onclick="changeImage(this)" src="/static/images/no-image.jpg" width="70"></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 right-side">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3><?= $product['name'] ?></h3> <span class="heart"><i class='bx bx-heart'></i></span>
                    </div>
                    <div class="mt-2 pr-3 content">
                        <p><?= $product['description'] ?></p>
                    </div>
                    <h3><?= $product['price'] ?> ₴</h3>
                    <div class="mt-3">
                        <label for="count">Кількість:</label>
                        <input type="number" id="count" min="1" value="1" max="<?= $product['count'] ?>">
                    </div>
                    <div class="mt-3">
                        <label for="count">Рейтинг: <?php if(!empty($product['rating'])){echo round($product['rating']);}else echo 'не визначений';?></label>
                    </div>
                    <div id="rating" class="mt-3">
                    </div>

                    <div class="mt-5"> <span class="fw-bold">На складі: <?= $product['count'] ?> шт.</span>

                    </div>
                    <div class="buttons d-flex flex-row mt-5 gap-3"> <button id="buy-now" class="btn btn-outline-dark">Buy Now</button> <button id="Add-to-cart" class="btn btn-dark">Add to Basket</button> <button id="add-to-wish" class="btn btn-outline-dark">Add to Wishlist</button>
                       <?php if(\models\User::isUserAuthenticated()){echo '<button id="rate" class="btn btn-outline-dark">Оцінити</button>';}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let rate = document.getElementById('rate');
    rate.addEventListener('click', function () {
        let rating = document.getElementById('rating');
        rating.innerHTML = '<input type="number" id="rating-input" min="1" value="1" max="5">' +
            '<button id="rating-button" class="btn btn-outline-dark">Оцінити</button>';
        let ratingButton = document.getElementById('rating-button');
        ratingButton.addEventListener('click', function () {
            let ratingInput = document.getElementById('rating-input');
            let rating = ratingInput.value;
            let productId = <?=$product['id']?>;
            $.ajax({
                url: '/product/view/<?=$product['id'] ?>',
                type: 'POST',
                data: {
                    AjaxRate: true,
                    product_id: productId,
                    rating: rating
                },
                success: function (reply) {
                    let data = JSON.parse(reply);
                    if (data.status === 'ok') {
                        alert('Товар успішно оцінено');
                        location.reload();
                    } else {
                            alert('Помилка оцінки товару');
                        location.reload();
                    }
                }
            });


        })
    });

    function changeImage(element) {

        var main_prodcut_image = document.getElementById('main_product_image');
        main_prodcut_image.src = element.src;


    }
</script>

<style>
    body {
        background-color: #ecedee
    }

    .card {
        border: none;
        overflow: hidden
    }

    .thumbnail_images ul {
        list-style: none;
        justify-content: center;
        display: flex;
        align-items: center;
        margin-top: 10px
    }

    .thumbnail_images ul li {
        margin: 5px;
        padding: 10px;
        border: 2px solid #eee;
        cursor: pointer;
        transition: all 0.5s
    }

    .thumbnail_images ul li:hover {
        border: 2px solid #000
    }

    .main_image {
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #eee;
        height: 400px;
        width: 100%;
        overflow: hidden
    }

    .heart {
        height: 29px;
        width: 29px;
        background-color: #eaeaea;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .content p {
        font-size: 12px
    }

    .ratings span {
        font-size: 14px;
        margin-left: 12px
    }

    .colors {
        margin-top: 5px
    }

    .colors ul {
        list-style: none;
        display: flex;
        padding-left: 0px
    }

    .colors ul li {
        height: 20px;
        width: 20px;
        display: flex;
        border-radius: 50%;
        margin-right: 10px;
        cursor: pointer
    }

    .colors ul li:nth-child(1) {
        background-color: #6c704d
    }

    .colors ul li:nth-child(2) {
        background-color: #96918b
    }

    .colors ul li:nth-child(3) {
        background-color: #68778e
    }

    .colors ul li:nth-child(4) {
        background-color: #263f55
    }

    .colors ul li:nth-child(5) {
        background-color: black
    }

    .right-side {
        position: relative
    }

    .search-option {
        position: absolute;
        background-color: #000;
        overflow: hidden;
        align-items: center;
        color: #fff;
        width: 200px;
        height: 200px;
        border-radius: 49% 51% 50% 50% / 68% 69% 31% 32%;
        left: 30%;
        bottom: -250px;
        transition: all 0.5s;
        cursor: pointer
    }

    .search-option .first-search {
        position: absolute;
        top: 20px;
        left: 90px;
        font-size: 20px;
        opacity: 1000
    }

    .search-option .inputs {
        opacity: 0;
        transition: all 0.5s ease;
        transition-delay: 0.5s;
        position: relative
    }

    .search-option .inputs input {
        position: absolute;
        top: 200px;
        left: 30px;
        padding-left: 20px;
        background-color: transparent;
        width: 300px;
        border: none;
        color: #fff;
        border-bottom: 1px solid #eee;
        transition: all 0.5s;
        z-index: 10
    }

    .search-option .inputs input:focus {
        box-shadow: none;
        outline: none;
        z-index: 10
    }

    .search-option:hover {
        border-radius: 0px;
        width: 100%;
        left: 0px
    }

    .search-option:hover .inputs {
        opacity: 1
    }

    .search-option:hover .first-search {
        left: 27px;
        top: 25px;
        font-size: 15px
    }

    .search-option:hover .inputs input {
        top: 20px
    }

    .search-option .share {
        position: absolute;
        right: 20px;
        top: 22px
    }

    .buttons .btn {
        height: 50px;
        width: 150px;
        border-radius: 0px !important
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script defer>

    let btnNow = document.getElementById('buy-now');
    if(btnNow != null)
    {
        btnNow.addEventListener('click', function () {
            let count = document.getElementById('count').value;
            let id = <?= $product['id'] ?>;
            $.ajax({
                url: '/product/view/<?=$product['id'] ?>',
                type: 'POST',
                data: {id: id, count: count, AjaxNow: true},
                success: function (reply) {
                    let res = JSON.parse(reply);
                    if (res.status === 'success') {
                        location.href = '/basket/payment';
                    } else {
                        alert('Помилка!');
                    }
                },

            });
        });
    }

    let btn = document.getElementById('Add-to-cart');
    if(btn!=null)
    {
        btn.addEventListener('click', function () {
            let count = document.getElementById('count').value;
            let id = <?= $product['id'] ?>;
            $.ajax({
                url: '/product/view/<?=$product['id'] ?>',
                type: 'POST',
                data: {
                    Ajax: true,
                    id: id,
                    count: count
                },
                success: function (reply) {
                    let data = JSON.parse(reply);
                    if (data.status === 'ok') {
                        alert('Товар успішно додано до кошика');
                    } else {
                        alert('Товар не додано до кошика');
                    }
                }
            });
        });
    }
    let btn2 = document.getElementById('add-to-wish');
    if(btn2!=null)
    {
        btn2.addEventListener('click', function () {
            let id = <?= $product['id'] ?>;
            $.ajax({
                url: '/product/view/<?=$product['id'] ?>',
                type: 'POST',
                data: {
                    AjaxWish: true,
                    pid: id,
                },
                success: function (reply) {
                    let data = JSON.parse(reply);
                    if (data.status === 'ok') {
                        alert('Товар успішно додано до вибраного');
                    } else {
                        alert('Товар вже є в вибраному');
                    }
                }
            });
        });
    }

</script>