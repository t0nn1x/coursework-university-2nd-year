<?php

use core\DB;

include('config/database.php');
include('config/params.php');

spl_autoload_register(function ($className) { // автозавантаження класів
    $path = $className . '.php';
    if (is_file($path)) { // якщо файл існує
        require_once $path; // підключаємо файл
    }
});

$core = core\Core::getInstance(); // створюємо екземпляр класу Core
$core->Initialize(); // ініціалізація системи
$core->Run(); // запуск системи
$core->Done(); // завершення роботи системи
