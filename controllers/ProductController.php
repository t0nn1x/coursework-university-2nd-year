<?php

namespace controllers;

use models\Basket;
use models\Product;
use models\Category;
use models\User;
use core\Core;

class ProductController extends \core\Controller
{
    public function indexAction()
    {
        return $this->render();
    }

    public function addAction($params)
    {
        $category_id = intval($params[0]);
        if(empty($category_id)) {
            $category_id = null;
        }
        $categories = Category::getCategories();
        if (Core::getInstance()->requestMethod === 'POST') {
        $_POST['name'] = trim($_POST['name']);
        $errors = [];
        if (empty($_POST['name'])) {
            $errors['name'] = 'Назва товару не може бути порожньою';
        }
        if (Product::isProductExists($_POST['name'])) {
            $errors['name'] = 'Товар з такою назвою вже існує';
        }
        if (empty($_POST['category_id'])) {
            $errors['category_id'] = 'Виберіть категорію';
        }
        if (empty($_POST['price'])) {
            $errors['price'] = 'Введіть ціну';
        }
        if ($_POST['price'] < 0) {
            $errors['price'] = 'Ціна не може бути відємною';
        }
        if ($_POST['quantity'] < 0) {
            $errors['quantity'] = 'Кількість товару не може бути відємною';
        }
        if(empty($errors)){
            Product::addProduct($_POST);
            return $this->redirect('/product/index');
        } else {
            $model = $_POST;
            return $this->render(null, [
                'errors' => $errors,
                'model' => $model,
                'categories' => $categories,
                'category_id' => $category_id
            ]);
        }
        }

        return $this->render(null, [
            'categories' => $categories,
            'category_id' => $category_id
        ]);
    }

    public function viewAction($params)
    {
        $id = intval($params[0]);
        $product = Product::getProductById($id);

        if(isset($_POST['Ajax']))
        {
            Basket::addProduct($_POST['id'], $_POST['count']);
            exit(json_encode(['status' => 'ok']));
        }


        return $this->render (null, [
            'product' => $product
        ]);
    }

    public function editAction($params)
    {
        $id = intval($params[0]);
        $product = Product::getProductById($id);
        $categories = Category::getCategories();
        if (Core::getInstance()->requestMethod === 'POST') {
            $_POST['name'] = trim($_POST['name']);
            $errors = [];
            if (empty($_POST['name'])) {
                $errors['name'] = 'Назва товару не може бути порожньою';
            }
            if (Product::isProductExists($_POST['name'], $id)) {
                $errors['name'] = 'Товар з такою назвою вже існує';
            }
            if (empty($_POST['category_id'])) {
                $errors['category_id'] = 'Виберіть категорію';
            }
            if (empty($_POST['price'])) {
                $errors['price'] = 'Введіть ціну';
            }
            if ($_POST['price'] < 0) {
                $errors['price'] = 'Ціна не може бути відємною';
            }
            if ($_POST['quantity'] < 0) {
                $errors['quantity'] = 'Кількість товару не може бути відємною';
            }
            if(empty($errors)){
                Product::updateProduct($id, $_POST);
                return $this->redirect('/product/index');
            } else {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model,
                    'categories' => $categories
                ]);
            }
        }

        return $this->render(null, [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        Product::deleteProduct($id);
        return $this->redirect('/category/index');
    }
}
