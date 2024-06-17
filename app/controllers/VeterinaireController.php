<?php
session_start();
require_once "../app/DAO/UsersDAO.php";
require_once "../app/DAO/AnimalDAO.php";
require_once "../app/DAO/HabitatDAO.php";
require_once "../app/DAO/RapportDAO.php";

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
        $animaldetails = $this->animalDAO->getAllAnimalsDetails();
        $habitats = $this->habitatDAO->getAllHabitats();
        $habitatsImg = $this->habitatDAO->getHabitatImages();
        $habitatImages = [];
        foreach ($habitatsImg as $habitatImg) {
            $habitatImages[$habitatImg['id']] = $habitatImg['data'];
        }
        $animaldetails = $this->animalDAO->getAllAnimalsDetails();
        include "../views/Veterinaire.php";
    }

}