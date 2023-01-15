<?php 

namespace models;

use core\Core;

class Wishlist
{
    public static function addToWishList($id)
    {
        Core::getInstance()->db->insert('wishlist', [
            'user_id' => $_SESSION['user']['id'],
            'product_id' => $id
        ]);
    }
    public static function getProductsInWishlist()
    {
        $rows = Core::getInstance()->db->select('wishlist', '*', [
            'user_id' => $_SESSION['user']['id']
        ]);
        if (empty($rows))
            return null;
        else
            return $rows;
    }
    public static function deleteFromWishlist($id)
    {
        Core::getInstance()->db->delete('wishlist', [
            'user_id' => $_SESSION['user']['id'],
            'product_id' => $id
        ]);
    }
    public static function deleteAllFromWishlist()
    {
        Core::getInstance()->db->delete('wishlist', [
            'user_id' => $_SESSION['user']['id']
        ]);
    }
    public static function isProductInWishlist($id)
    {
        $rows = Core::getInstance()->db->select('wishlist', '*', [
            'user_id' => $_SESSION['user']['id'],
            'product_id' => $id
        ]);
        if (empty($rows))
            return false;
        else
            return true;
    }
}