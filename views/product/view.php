<?php

/**
 * @var array $product
 */
?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title"><?= $product['name'] ?></h3>
            <h6 class="card-subtitle"><?= $product['short_description'] ?></h6>
            <div class="row">


                <div id="carouselExampleControls" class="carousel slide img-size" data-bs-ride="carousel">
                    <div class="carousel-inner ">
                        <?php if(!empty($product['photos'])) :?>
                        <?php foreach($product['photos'] as $item) :?>
                        <div class="carousel-item active img-size"   >
                            <img src="<?= $item['photo']?>" class="d-block w-100 img-size" alt="...">
                        </div>
                        <?php endforeach;?>
                        <?else:?>
                            <div class="carousel-item active">
                                <img src="/static/images/no-image.jpg" class="d-block w-100" alt="...">
                            </div>
                        <?endif;?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>


                <div class="col-lg-7 col-md-7 col-sm-6">
        
                    <h4 class="box-title mt-5">Опис товару: </h4>
                    <p><?= $product['description'] ?></p>
                    <h4>Залишилось у наявності: <?= $product['count'] ?> шт.</h4>
                    <h2 class="mt-5"> Ціна: 
                    <?= $product['price'] ?><small class="text-success"> грн</small>
                    </h2>
                    <h5>Ви хочете придбати: <input min="1" value="1" max="<?=$product['count'] ?>" type="number" name="count" id="count" class="form-control"></h5>
                    <button id="Add-to-cart" class="btn btn-dark btn-rounded mr-1" data-toggle="tooltip" title="" data-original-title="Add to cart">
                        <i class="fa fa-shopping-cart"></i>
                    </button>
                    <button id="add-to-wish" class="btn btn-dark btn-rounded" data-toggle="tooltip" title="" data-original-title="Add to wishlist">
                        <i class="fa fa-heart"></i>
                    </button>
                    <button class="btn btn-success btn-rounded">Миттєва покупка</button>
                    <div class="mt-5">
                        <a href="/product/reviews/<?= $product['id'] ?>" class="btn btn-primary">Відгуки</a>
                        <a href="/product/contact/<?= $product['id'] ?>" class="btn btn-primary">Зв'язатися з продавцем</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script defer>

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