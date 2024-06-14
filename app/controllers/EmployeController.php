<?php
session_start();
require_once "../app/DAO/UsersDAO.php";
require_once "../app/DAO/AvisDAO.php";
require_once "../app/DAO/ServicesDAO.php";
require_once "../app/DAO/AnimalDAO.php";
require_once "../app/DAO/HabitatDAO.php";

class EmployeController {

    private $usersDAO;
    private $avisDAO;
    private $servicesDAO;
    private $animalDAO;
    private $habitatDAO;

    public function __construct() {
        $this->usersDAO = new UsersDAO();
        $this->avisDAO = new AvisDAO();
        $this->servicesDAO = new ServicesDAO();
        $this->animalDAO = new AnimalDAO();
        $this->habitatDAO = new HabitatDAO();
    }

    public function render() {
        $title = 'Arcadia-Employé';
        $avis = $this->avisDAO->getUnvisibleAvis();
        $services = $this->servicesDAO->getAllServices();
        $animals = $this->animalDAO->getAllAnimals();
        $habitats = $this->habitatDAO->getAllHabitats();
        include "../views/Employe.php";
    }

}