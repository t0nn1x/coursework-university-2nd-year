<?php

namespace models;
use core\Utils;
use core\Core;

class Order
{
    public static function getOrdersByUser($user_id)
    {
        $rows = Core::getInstance()->db->select('orders', '*', [
            'user_id' => $user_id
        ]);
        return $rows;
    }

    public static function getProductsByOrderId($id)
    {
        $rows = Core::getInstance()->db->select('order_product', '*', [
            'order_id' => $id
        ]);
        if (empty($rows))
            return null;
        else
            return $rows;
    }

    public static function getProductQuantity($orderId, $productId)
    {
        $row = Core::getInstance()->db->select('order_product', '*', [
            'order_id' => $orderId,
            'product_id' => $productId
        ]);
        if (empty($row))
            return null;
        else
            return $row[0]['quantity'];
    }
}