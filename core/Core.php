<?php

namespace core;

use controllers\MainController;

/**
 * Клас ядра системи, який відповідає за запуск системи та взаємодію з базою даних 
 */
class Core
{

    private static $instance = null; // singleton класса Core 
    public $app;
    public DB $db;
    public $requestMethod;
    public $pageParams;

    private function __construct() // заборонямо створення обєкта класу Core ззовні
    {
        global $pageParams;
        $this->app = [];
        $this->pageParams = $pageParams;
    }

    /**
     * Функція створює екземпляр класу Core
     */
    public static function getInstance() // створюємо екземпляр класу Core
    {
        if (empty(self::$instance)) { // якщо екземпляр класу Core не існує
            self::$instance = new self(); // створюємо екземпляр класу Core
        }
        return self::$instance;
    }

    /**
     * Функція ініціалізації системи 
     */
    public function Initialize() // ініціалізація
    {
        session_start(); // запускаємо сесію
        $this->db = new DB(DATABASE_HOST, DATABASE_LOGIN, DATABASE_PASSWORD, DATABASE_BASENAME);
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Функція початку роботи системи 
     */
    public function Run() // запуск
    {
        $route = $_GET['route'];
        $routeParts = explode('/', $route);
        $moduleName = strtolower(array_shift($routeParts));
        $actionName = strtolower(array_shift($routeParts));

        if (empty($moduleName)) {  // якщо не вказано модуль, то використовуємо модуль main
            $moduleName = 'main';
        }

        if (empty($actionName)) { // якщо не вказано дію, то використовуємо дію index
            $actionName = 'index';
        }

        $this->app['moduleName'] = $moduleName;
        $this->app['actionName'] = $actionName;


        $controllerName = '\\controllers\\' . ucfirst($moduleName) . 'Controller'; // NewsController 
        $controllerActionName = $actionName . 'Action';
        $statusCode = 200;

        if (class_exists($controllerName)) // якщо клас існує (перевіряємо чи існує файл NewsController.php
        {
            $controller = new $controllerName();

            if (method_exists($controller, $controllerActionName)) { // якщо метод існує
                $this->pageParams['content'] = $controller->$controllerActionName($routeParts); // викликаємо метод
            } else {
                $statusCode = 404; // якщо метод не існує
            }
        } else {
            $statusCode = 404; // якщо клас не існує
        }
        $statusCodeType = intval($statusCode / 100); // отримуємо першу цифру статусу (2, 4, 5
        if ($statusCodeType == 4 || $statusCodeType == 5) { // якщо статус 404 або 500
            $mainController = new \controllers\MainController();
            $this->pageParams['content'] = $mainController->errorAction($statusCode); // викликаємо метод errorAction
        }
    }

    /**
     * Функція завершення роботи системи 
     */
    public function Done() // завершення
    {
        $pathToLayout = 'themes/light/layout.php'; // шлях до файлу з шаблоном
        $tpl = new Template ($pathToLayout); // створюємо екземпляр класу Template
        $tpl->setParams($this->pageParams); // викликаємо метод setParam
        $html = $tpl->getHTML(); // викликаємо метод getHTML
        echo $html;
    }
}
