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

    public function deleteAction($params)
    {
        $product_id = intval($params[0]);
        Basket::removeProduct($product_id);
        return $this->redirect('/basket/index');
    }

    public function clearAction()
    {
        Basket::clearBasket();
        return $this->redirect('/basket/index');
    }

    public function paymentAction()
    {
        $basket = Basket::getProductsInBasket();
        return $this->render(null, [
            'basket' => $basket
        ]);
    }
}