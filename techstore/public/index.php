<?php
session_start();
require_once __DIR__ . '/../src/Core/Router.php';
require_once __DIR__ . '/../src/Core/Database.php';
require_once __DIR__ . '/../src/Models/Product.php';
require_once __DIR__ . '/../src/Controllers/ProductController.php';
require_once __DIR__ . '/../src/Models/Review.php';
require_once __DIR__ . '/../src/Controllers/AuthController.php';
require_once __DIR__ . '/../src/Controllers/FeedbackController.php';
require_once __DIR__ . '/../src/Controllers/CalculatorController.php';
use Src\Core\Router;
use Src\Controllers\ProductController;

$router = new Router();

$router->add('/', function () {

    header('Location: /?route=products');

    exit;

});

$router->add('products', function () {

    $controller = new ProductController();

    $controller->index();

});
$router->add('products/create', function () {

    $controller = new ProductController();

    $controller->create();

});
$router->add('calculator', function () {

    echo "Калькулятор";

});

$router->add('feedback', function () {

    echo "Обратная связь";

});

$router->add('product', function () {

    $controller = new ProductController();

    $controller->show();

});
$router->add('products/edit', function () {

    $controller = new ProductController();

    $controller->edit();

});
$router->add('products/delete', function () {

    $controller = new ProductController();

    $controller->delete();

});
$router->add('login', function () {

    $controller = new AuthController();

    $controller->login();

});

$router->add('logout', function () {

    $controller = new AuthController();

    $controller->logout();

});
$router->add('feedback', function () {

    $controller = new FeedbackController();

    $controller->index();

});
$router->add('calculator', function () {

    $controller = new CalculatorController();

    $controller->index();

});
$router->dispatch();