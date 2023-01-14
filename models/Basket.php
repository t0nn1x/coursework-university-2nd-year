<?php 

namespace models;

class Basket 
{
    public static function addProduct($product_id, $count = 1)
    {
        if(!is_array($_SESSION['basket'])){
            $_SESSION['basket'] = [];
        }
        $_SESSION['basket'][$product_id] += $count;
    }

    public static function removeProduct($product_id)
    {
        if(!is_array($_SESSION['basket'])){
            $_SESSION['basket'] = [];
        }
        unset($_SESSION['basket'][$product_id]);
    }

    public static function getProductsInBasket()
    {
        if(is_array($_SESSION['basket'])){
            $result = [];
            $products = [];
            $totalPrice = 0;
            foreach($_SESSION['basket'] as $product_id => $count){
                $product = Product::getProductById($product_id);
                $totalPrice += $product['price'] * $count;
                $products [] = ['product' => $product, 'count' => $count];
            }
            $result['products'] = $products;
            $result['totalPrice'] = $totalPrice;
            return $result;
        }
        return null;
    }
}