<?php

class HomeController {

    public function __construct() {
        
        // require "../app/config.php";
        // $database = new PDO($dsn, $username, $password);

    }

    public function render() {
        include "../views/home.php";
    }

}