<?php
session_start();
require_once "../app/DAO/UsersDAO.php";
require_once "../app/DAO/AnimalDAO.php";
require_once "../app/DAO/HabitatDAO.php";

class VeterinaireController {

    private $usersDAO;
    private $animalDAO;
    private $habitatDAO;

    public function __construct() {
        $this->usersDAO = new UsersDAO();
        $this->animalDAO = new AnimalDAO();
        $this->habitatDAO = new HabitatDAO();
    }

    public function render() {
        $title = 'Arcadia-Employé';
        $animals = $this->animalDAO->getAllAnimals();
        $habitats = $this->habitatDAO->getAllHabitats();
        include "../views/Veterinaire.php";
    }

}