<?php

namespace controllers;

use core\Controller;
use models\Order;
use models\Product;
use models\User;

class OrderController extends Controller
{
    public function indexAction()
    {
        if(User::isAdmin())
        {
            $orders = Order::getOrders();
        }
        else
            $orders = Order::getOrdersByUser($_SESSION['user']['id']);

        return $this->render(null, [
            'orders' => $orders
        ]);
    }

    public function viewAction($params)
    {

        $id = intval($params[0]);
        $product_ids = Order::getProductsByOrderId($id);
        $products = [];
        foreach ($product_ids as $product_id) {
            $product = Product::getProductById($product_id['product_id']);
            $product['quantity'] = Order::getProductQuantity($id, $product_id['product_id']);
            $products[] = $product;
        }

        return $this->render(null, ['products' => $products, 'order_id' => $id]);
    }
}