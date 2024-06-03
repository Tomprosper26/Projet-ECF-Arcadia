<?php 
require "../app/autoloader.php";
require "../app/router.php";

Autoloader::register();

$router = new Router();

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


if ($requestPath === '/') {
    $HomeController = new HomeController();
    $router->addRoute('/','HomeController', 'render');
} else {
    echo "page introuvable";
}

$router->dispatch($requestPath);

?>