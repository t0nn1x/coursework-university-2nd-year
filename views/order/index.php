<?php
/** @var array $orders */
?>

<div class="container px-3 my-5 clearfix">

    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h2>Замовлення</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered m-0">
                    <thead>
                    <tr>
                        <!-- Set columns width -->
                        <th class="text-center py-3 px-4" style="min-width: 10px;">#</th>
                        <th class="text-center py-3 px-4" style="min-width: 490px;">Ім'я</th>
                        <th class="text-right py-3 px-4" style="width: 100px;">Адреса</th>
                        <th class="text-right py-3 px-4" style="width: 100px;">Загальна вартість</th>
                        <th class="text-center align-middle py-3 px-0" style="width: 40px;">Дія</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    if (!empty($orders)):
                        foreach ($orders as $row) : ?>
                            <tr>

                                <td class="text-right font-weight-semibold align-middle p-4"><?= $row['id'] ?></td>
                                <td class="p-4"><?=$row['name']?></td>
                                <td  class="text-right font-weight-semibold align-middle p-4"><?= $row['address']?></td>
                                <td class="text-right font-weight-semibold align-middle p-4"> <label id="count" > <?= $row['totalPrice'] ?></label></td>
                                <td class="text-center align-middle p-4">
                                    <a href="/order/view/<?=$row['id']?>" class="btn btn-sm btn-outline-primary">Переглянути</a>
                                </td>
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
