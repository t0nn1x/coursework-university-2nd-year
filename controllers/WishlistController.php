<?php 

namespace controllers;

use models\Wishlist;

class WishlistController extends \core\Controller
{
    public function addAction($product_id)
    {
        Wishlist::addProduct($product_id);
        header('Location: /wishlist');
    }

    public function removeAction($product_id)
    {
        Wishlist::removeProduct($product_id);
        header('Location: /wishlist');
    }

    public function indexAction()
    {
        $wishlist = Wishlist::getProductsInWishlist();
        $products = $wishlist['products'];
        $totalPrice = $wishlist['totalPrice'];
        return $this->render(null, [
            'products' => $products,
            'totalPrice' => $totalPrice
        ]);
        return true;
    }
}