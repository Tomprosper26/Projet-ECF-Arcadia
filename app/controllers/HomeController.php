<?php

require_once "../app/DAO/AnimalDAO.php";
require_once "../app/DAO/HabitatDAO.php";
require_once "../app/DAO/ServicesDAO.php";
require_once "../app/DAO/AvisDAO.php";

class HomeController {

    private $animalDAO;
    private $habitatDAO;
    private $servicesDAO;
    private $avisDAO;

    public function __construct() {
        $this->animalDAO = new AnimalDAO();
        $this->habitatDAO = new HabitatDAO();
        $this->servicesDAO = new ServicesDAO();
        $this->avisDAO = new AvisDAO();
    }

    public function render() {
        $title = "Accueil";
        $animalcount = $this->animalDAO->getTotalAnimals();
        $habitatcount = $this->habitatDAO->getTotalHabitats();
        $habitats = $this->habitatDAO->getFirstThreeHabitats();
        $services = $this->servicesDAO->getAllServices();
        $images = [];
        foreach($habitats as $habitat){
            $image = $this->habitatDAO->getHabitatImage($habitat['id']);
            array_push($images, $image);
        }
        $avis = $this->avisDAO->getVisibleAvis();

        include "../views/home.php";
    }

}