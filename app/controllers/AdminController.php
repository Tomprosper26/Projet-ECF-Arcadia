<?php
session_start();
require_once "../app/DAO/UsersDAO.php";
require_once "../app/DAO/AvisDAO.php";
require_once "../app/DAO/ServicesDAO.php";
require_once "../app/DAO/AnimalDAO.php";
require_once "../app/DAO/HabitatDAO.php";
require_once "../app/DAO/HorairesDAO.php";
require_once "../app/DAO/RaceDAO.php";

class AdminController {

    private $usersDAO;
    private $avisDAO;
    private $servicesDAO;
    private $animalDAO;
    private $habitatDAO;
    private $horairesDAO;
    private $raceDAO;

    public function __construct() {
        $this->usersDAO = new UsersDAO();
        $this->avisDAO = new AvisDAO();
        $this->servicesDAO = new ServicesDAO();
        $this->animalDAO = new AnimalDAO();
        $this->habitatDAO = new HabitatDAO();
        $this->raceDAO = new RaceDAO();
    }

    public function render() {
        $title = 'Arcadia-Admin';
        $avis = $this->avisDAO->getUnvisibleAvis();
        $services = $this->servicesDAO->getAllServices();
        $animals = $this->animalDAO->getAllAnimals();
        $habitats = $this->habitatDAO->getAllHabitats();
        $habitatsImg = $this->habitatDAO->getHabitatImages();
        $habitatImages = [];
        foreach ($habitatsImg as $habitatImg) {
            $habitatImages[$habitatImg['id']] = $habitatImg['data'];
        }
        $animaldetails = $this->animalDAO->getAllAnimalsDetails();
        $races = $this->raceDAO->getAllRaces();
        include "../views/admin.php";
    }

}