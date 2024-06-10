<?php 
require "../app/autoloader.php";
require "../app/router.php";

Autoloader::register();

$router = new Router();

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


if ($requestPath === '/') {

    $HomeController = new HomeController();
    $router->addRoute('/','HomeController', 'render');

} elseif ($requestPath === '/avis') {

    $AvisController = new AvisController();
    $router->addRoute('/avis', 'AvisController', 'render');

} elseif ($requestPath === '/services') {

    $ServicesController = new ServicesController();
    $router->addRoute('/services', 'ServicesController', 'render');

}  elseif ($requestPath === '/habitats') {

    $HabitatsController = new HabitatsController();
    $router->addRoute('/habitats', 'HabitatsController', 'render'); 

} else {
    echo "page introuvable";
}

$router->dispatch($requestPath);

?>