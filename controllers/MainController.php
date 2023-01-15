<?php 

namespace controllers;
include_once 'core/Controller.php';

use core\Controller;
use core\Core;
/**
 * 
 */

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->redirect('/category');
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