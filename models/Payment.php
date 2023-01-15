<?php

namespace models;

use core\Core;

class Payment
{
    public static function addOrder($user_id, $address, $total_price, $phone, $name, $comment=null)
    {

         Core::getInstance()->db->insert('orders', [
             'user_id' => $user_id,
             'address' => $address,
             'totalPrice' => $total_price,
             'phone' => $phone,
             'name' => $name,
             'comment' => $comment
         ]);
    }
    public static function addOrderProduct($order_id, $product_id, $quantity)
    {
        Core::getInstance()->db->insert('order_product', [
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => $quantity
        ]);
    }
    public static function getLastOrderId()
    {
        $rows = Core::getInstance()->db->select('orders', 'max(id) as id');
        if (empty($rows))
            return null;
        else
            return $rows[0]['id'];
    }
}