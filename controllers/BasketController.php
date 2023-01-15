<?php 

namespace controllers;

use core\Core;
use models\Basket;
use models\Payment;
use models\Product;
use models\User;

class BasketController extends \core\Controller
{
    public function indexAction()
    {
        $basket = Basket::getProductsInBasket();
        $photos = [];

        if(!empty($basket)) {
            foreach ($basket['products'] as $product) {
                $photos[] = Product::getPhotoById($product['product']['id']);
            }
        }


        return $this->render(null, [
            'basket' => $basket,
            'photos' => $photos
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
        $errors = [];
        if(isset($_POST['pay']) && Core::getInstance()->requestMethod === 'POST')
        {
            if (trim($_POST['name']) == '') {
                $errors['name'] = 'Введіть ім\'я';
            }
            if (trim($_POST['phone']) == '') {
                $errors['phone'] = 'Введіть телефон';
            }
            if (trim($_POST['address']) == '') {
                $errors['address'] = 'Введіть адресу';
            }
            if (trim($_POST['comment']) == '') {
                Payment::addOrder($_SESSION['user']['id'], $_POST['address'], $basket['totalPrice'], $_POST['phone'], $_POST['name']);

            }
            else {
                Payment::addOrder($_SESSION['user']['id'], $_POST['address'], $basket['totalPrice'], $_POST['phone'], $_POST['name'], $_POST['comment']);
            }
            $order_id = Payment::getLastOrderId();
            foreach ($basket['products'] as $product) {
                Payment::addOrderProduct($order_id, $product['product']['id'], $product['count']);
            }
            Basket::clearBasket();
            $this->redirect('/basket');

        }

        return $this->render(null, [
            'basket' => $basket,
            'errors' => $errors
        ]);
    }
}