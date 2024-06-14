<?php
session_start();
require_once "../app/DAO/UsersDAO.php";
require_once "../app/DAO/AvisDAO.php";
require_once "../app/DAO/ServicesDAO.php";

class EmployeController {

    private $usersDAO;
    private $avisDAO;
    private $servicesDAO;

    public function __construct() {
        $this->usersDAO = new UsersDAO();
        $this->avisDAO = new AvisDAO();
        $this->servicesDAO = new ServicesDAO();
    }

    public function render() {
        $title = 'Arcadia-Employé';
        $avis = $this->avisDAO->getUnvisibleAvis();
        $services = $this->servicesDAO->getAllServices();
        include "../views/Employe.php";
    }

}