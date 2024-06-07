<?php

require_once "../app/DAO/ServicesDAO.php";

class ServicesController {

    private $servicesDAO;

    public function __construct() {
        $this->servicesDAO = new ServicesDAO();
    }

    public function render() {
        $title = "Arcadia-Services";
        $services = $this->servicesDAO->getAllServices();
        include "../views/services.php";
    }

}