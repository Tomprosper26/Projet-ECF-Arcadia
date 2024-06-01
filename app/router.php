<?php

class Router {
    private $routes = [];

    public function addRoute($path, $controller, $method) {
        $this->routes[$path] = ['controller' => $controller, 'method' => $method];
    }

    public function dispatch($requestPath) {
        if (array_key_exists($requestPath, $this->routes)) {
            $controllerName = $this->routes[$requestPath]['controller'];
            $methodName = $this->routes[$requestPath]['method'];
            
            require_once "../app/controllers/$controllerName.php";
            $controller = new $controllerName();
            $controller->$methodName();
        }
    }
}