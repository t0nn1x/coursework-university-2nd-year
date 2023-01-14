<?php 

namespace controllers;

use models\Basket;

class BasketController extends \core\Controller
{
    public function indexAction()
    {
        $basket = Basket::getProductsInBasket();
        return $this->render(null, [
            'basket' => $basket
        ]);
    }
}