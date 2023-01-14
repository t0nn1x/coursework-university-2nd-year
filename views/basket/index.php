<?php

/**
 * @var array $basket
 * 
 */

?>


<link rel="stylesheet" href="/views/basket/css/style.css">
<div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h2>Кошик</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered m-0">
                    <thead>
                        <tr>
                            <!-- Set columns width -->
                            <th class="text-center py-3 px-4" style="min-width: 10px;">#</th>
                            <th class="text-center py-3 px-4" style="min-width: 490px;">Назва товару &amp; Деталі</th>
                            <th class="text-right py-3 px-4" style="width: 100px;">Вартість одиниці</th>
                            <th class="text-center py-3 px-4" style="width: 120px;">Кількість</th>
                            <th class="text-right py-3 px-4" style="width: 100px;">Загальна вартість</th>
                            <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $index = 1;
                        foreach ($basket['products'] as $row) : ?>
                            <tr>

                                <td class="text-right font-weight-semibold align-middle p-4"><?= $index ?></td>
                                <td class="p-4">
                                    <div class="media align-items-center">
                                        <img src="сюди можна вставити посилання на картинку" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                        <div class="media-body">
                                            <a href="" class="d-block text-dark"><?= $row['product']['name'] ?> </a>
                                            <small>
                                                <span class="text-muted"><?= $row['product']['short_description'] ?></span>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td id="productPrice<?=$row['product']['id']?>" class="text-right font-weight-semibold align-middle p-4"><?= $row['product']['price'] ?> ₴</td>
                                <td class="text-right font-weight-semibold align-middle p-4"> <input id="count" data-id="<?=$row['product']['id']?>" type="number" min="1" max="<?=$row['product']['count']?>" value="<?= $row['count']?>" class="form-control"> од.</td>
                                <script>
                                    
                                </script>
                                <td id="product<?=$row['product']['id']?>" class="totalProductPrice text-right font-weight-semibold align-middle p-4"><?= $row['product']['price'] * $row['count'] ?> ₴</td>
                                <td class="text-center align-middle px-0"><a href="/basket/delete/<?=$row['product']['id']?>" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>
                            </tr>
                        <? $index++;
                        endforeach; ?>



                    </tbody>
                </table>
            </div>
            <!-- / Shopping cart table -->

            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                <div class="mt-4">
                    <label class="text-muted font-weight-normal">Промокод:</label>
                    <input type="text" placeholder="ABC" class="form-control">
                </div>
                <div class="d-flex">
                    <div class="text-right mt-4">
                        <label class="text-muted font-weight-normal m-0">Загальна вартість:</label>
                        <div class="text-large"><strong id="superTotalPrice"><?= $basket['totalPrice'] ?> ₴</strong></div>
                    </div>
                </div>
            </div>

            <div class="float-right">
                <button type="button" class="btn btn-lg btn-success md-btn-flat mt-2 mr-3" onclick="location.href='/product'">Назад до магазину</button>
                <button type="button" class="btn btn-lg btn-primary mt-2">Оплата</button>
            </div>

        </div>
    </div>
</div>

<script>
    let count = document.querySelectorAll('#count');
    for (let i =0; i <count.length; i++  )
    {
        count[i].addEventListener('change', function(){
            let prodId = this.getAttribute('data-id');
            let prodCount = this.value;
            let prodPrice;
            prodPrice = Number(document.querySelector('#productPrice'+prodId).innerHTML.replace('₴', ''));
            let totalPrice = prodCount * prodPrice;

            document.getElementById('product'+prodId).innerHTML = totalPrice.toString() + ' ₴';
            let total = 0;
            document.querySelectorAll('.totalProductPrice').forEach(function (item) {
                total += Number(item.innerHTML.replace('₴', ''));
            });
            document.getElementById('superTotalPrice').innerHTML = total.toString() + ' ₴';
        })
    }
</script>