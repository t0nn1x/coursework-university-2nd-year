<?php 

namespace controllers;
include_once 'core/Controller.php';

use core\Controller;
use core\Core;
/**
 * 
 */

class MainController
{
    public function indexAction()
    {
        // return $this->render();
    }

    public function errorAction($code)
    {
        switch ($code) {
            case 404:
                $controller = new \core\Controller();
                $controller->redirect('/views/errors/404/404.php');
                break;
            default:
                echo '500';
                break;
        }
    }
}