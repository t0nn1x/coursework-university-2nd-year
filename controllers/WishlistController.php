<?php 

namespace controllers;

use models\Product;
use models\Wishlist;

class WishlistController extends \core\Controller
{
    public function removeAction($params)
    {
        $product_id = intval($params[0]);
        Wishlist::deleteFromWishlist($product_id);
        return $this->redirect('/wishlist/index');
    }


    public function indexAction()
    {
        $wishlist = Wishlist::getProductsInWishlist();
        $products = [];
        if (!empty($wishlist)) {
            foreach ($wishlist as $product) {
                $products[] = Product::getProductById($product['product_id']);
            }
            foreach ($products as &$product) {
                $product['photos'] = Product::getProductPhotos($product['id']);
            }
        }

        return $this->render(null, [
            'products' => $products
        ]);

    }
}