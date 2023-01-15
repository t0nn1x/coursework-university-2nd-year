<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Category;
use models\Product;
use models\User;

class CategoryController extends \core\Controller
{
    public function indexAction()
    {
        $rows = Category::getCategories();
        $viewPath = null;
        if (User::isAdmin()) {
            $viewPath = 'views/category/index-admin.php';
        }
        return $this->render($viewPath, [
            'rows' => $rows
        ]);
    }

    public function addAction()
    {
        if (!User::isAdmin()) {
            return $this->redirect('/category/index');
        }
        if (Core::getInstance()->requestMethod === 'POST') {
            $_POST['name'] = trim($_POST['name']);
            $errors = [];
            if (empty($_POST['name'])) {
                $errors['name'] = 'Назва категорії не може бути порожньою';
            }
            if (Category::isCategoryExists($_POST['name'])) {
                $errors['name'] = 'Категорія з такою назвою вже існує';
            }
            if (empty($errors) && isset($_FILES['file'])) { // якщо помилок немає і файл завантажено
                Category::addCategory($_POST['name'], $_FILES['file']['tmp_name']); // додаємо категорію
                return $this->redirect('/category/index');
            } else {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            }
        }
        return $this->render();
    }

    public function editAction($params)
    {
        $id = intval($params[0]);
        if (!User::isAdmin()) {
            return $this->redirect('/category/index');
        }
        if ($id > 0) {
            $category = Category::GetCategoryById($id);
            if (Core::getInstance()->requestMethod == 'POST') {
                $_POST['name'] = trim($_POST['name']);
                $errors = [];
                if (empty($_POST['name'])) {
                    $errors['name'] = 'Назва категорії не може бути порожньою';
                }
                if (empty($errors) && isset($_FILES['file'])) { // якщо помилок немає і файл завантажено
                    Category::updateCategory($id, $_POST['name']);
                    if (isset($_FILES['file'])) {
                        Category::changePhoto($id, $_FILES['file']['tmp_name']);
                    }
                    return $this->redirect('/category/index');
                } else {
                    $model = $_POST;
                    return $this->render(null, [
                        'errors' => $errors,
                        'model' => $model,
                        'category' => $category
                    ]);
                }
            }



            return $this->render(null, [
                'category' => $category
            ]);
        } else {
            return $this->redirect('/category/index');
        }
    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        $yes = boolval($params[1] === 'yes');
        if (!User::isAdmin())
            return $this->redirect('/category/index');
        if ($id > 0) {
            $category = Category::getCategoryById($id);
            if ($yes) {
                $filePath = 'files/category/' . $category['photo'];
                if (is_file($filePath))
                    unlink($filePath);
                Category::deleteCategory($id);
                return $this->redirect('/category/index');
            }
            return $this->render(null, [
                'category' => $category
            ]);
        } else
            return $this->redirect('/category/index');
    }

    public function viewAction($params)
    {
        $id = intval($params[0]);
        $category = Category::getCategoryById($id);
        $products = Product::getProductsInCategoryId($id);

        foreach ($products as &$product) {
            $product['photos'] = Product::getProductPhotos($product['id']);
        }

        return $this->render(null, [
            'category' => $category,
            'products' => $products
        ]);
    }
}
