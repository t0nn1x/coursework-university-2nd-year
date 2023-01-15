<?php 

namespace models;

class Wishlist
{
    public static function addProduct($product_id, $count = 1)
    {
        if(!is_array($_SESSION['wishlist'])){
            $_SESSION['wishlist'] = [];
        }
        $_SESSION['wishlist'][$product_id] += $count;
    }

    public static function removeProduct($product_id)
    {
        if(!is_array($_SESSION['wishlist'])){
            $_SESSION['wishlist'] = [];
        }
        unset($_SESSION['wishlist'][$product_id]);
    }

    public static function getProductsInWishlist()
    {
        if(is_array($_SESSION['wishlist'])){
            $result = [];
            $products = [];
            $totalPrice = 0;
            foreach($_SESSION['wishlist'] as $product_id => $count){
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