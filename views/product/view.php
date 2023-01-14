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
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="white-box text-center"><?php $filePath = 'files/product/' . $product['photo']; ?> 430x600</div>     
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6">
        
                    <h4 class="box-title mt-5">Опис товару: </h4>
                    <p><?= $product['description'] ?></p>
                    <h4>Залишилось у наявності: <?= $product['count'] ?> шт.</h4>
                    <h2 class="mt-5"> Ціна: 
                    <?= $product['price'] ?><small class="text-success"> грн</small>
                    </h2>
                    <h5>Ви хочете придбати: <input min="1" max="<?=$product['count'] ?>" type="number" name="count" id="count" class="form-control"></h5>
                    <button class="btn btn-dark btn-rounded mr-1" data-toggle="tooltip" title="" data-original-title="Add to cart">
                        <i class="fa fa-shopping-cart"></i>
                    </button>
                    <button class="btn btn-dark btn-rounded" data-toggle="tooltip" title="" data-original-title="Add to wishlist">
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

