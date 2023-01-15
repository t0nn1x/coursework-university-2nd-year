<?php
/** @var array $products */
/** @var int $order_id */
use \models\Order;
?>
<div class="card">
        <div class="card-header">
            <h2>Замовлення #<?=$order_id?></h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered m-0">
                    <thead>
                    <tr>
                        <!-- Set columns width -->
                        <th class="text-center py-3 px-4" style="min-width: 10px;">Назва</th>
                        <th class="text-center py-3 px-4" style="min-width: 490px;">Ціна</th>
                        <th class="text-right py-3 px-4" style="width: 100px;">Кількість</th>
                        <th class="text-right py-3 px-4" style="width: 100px;">Загальна вартість</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    if (!empty($products)):
                        foreach ($products as $row) : ?>
                            <tr>

                                <td class="text-right font-weight-semibold align-middle p-4"><?= $row['name'] ?></td>
                                <td class="p-4"><?=$row['price']?>₴</td>
                                <td  class="text-right font-weight-semibold align-middle p-4"><?=$row['quantity']?></td>
                                <td class="text-right font-weight-semibold align-middle p-4"> <label id="count" > <?= $row['price']*$row['quantity']?>₴</label></td>

                            </tr>
                            <?
                        endforeach;
                    else: ?>
                        <tr>
                            <td colspan="6" class="text-center font-weight-semibold align-middle p-4">Замовлення порожні</td>
                        </tr>
                    <? endif;?>




                    </tbody>
                </table>
            </div>
            <!-- / Shopping cart table -->


        </div>
    </div>
</div>
