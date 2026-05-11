<?php
use MyProject\Controllers\ArticlesController;
// автозагрузка классов

spl_autoload_register(function (string $className) {

    require_once __DIR__
        . '/src/'
        . str_replace('\\', '/', $className)
        . '.php';
});

// получаем url

$route = $_GET['route'] ?? '';

// создаем контроллер

$controller =
    new \MyProject\Controllers\MainController();

// роутинг

if ($route == '') {

    $controller->main();
}
elseif ($route == 'about-me') {

    $controller->aboutMe();
}
elseif (str_contains($route, 'hello/')) {

    // разбиваем route

    $parts = explode('/', $route);

    // получаем имя

    $name = $parts[1] ?? '';

    // вызываем action

    $controller->hello($name);
}
elseif (str_contains($route, 'bye/')) {

    // получаем имя

    $parts = explode('/', $route);

    $name = $parts[1] ?? '';

    $controller->sayBye($name);
}
elseif (str_contains($route, 'hello/')) {

    // разбиваем url

    $parts = explode('/', $route);

    // получаем имя

    $name = $parts[1] ?? '';

    // вызываем action

    $controller->hello($name);
}
elseif (str_contains($route, 'article/') && str_contains($route, '/edit')) {

    // разбиваем route

    $parts = explode('/', $route);

    // id статьи

    $id = $parts[1] ?? 1;

    // контроллер статей

    $controller =
        new ArticlesController();

    // открываем редактирование

    $controller->edit((int)$id);
}
elseif (str_contains($route, 'article/')) {

    // разбиваем route

    $parts = explode('/', $route);

    // id статьи

    $id = $parts[1] ?? 1;

    // контроллер статей

    $controller =
        new ArticlesController();

    // открываем статью

    $controller->show((int)$id);
}
else {

    echo 'ошибка 404';
}
?>