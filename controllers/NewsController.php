<?php 

namespace controllers;

class NewsController extends \core\Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function viewAction()
    {
        return $this->render('views/news/index.php'); // викликаємо метод render() базового класу Controller
    }

    public function indexAction()
    {
        return $this->render(null, [
            'title' => 'Список новин',
            'text' => 'Текст новини'
            ]
        );
    }
}