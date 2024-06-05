<?php

require_once "../app/DAO/AnimalDAO.php";
require_once "../app/DAO/HabitatDAO.php";

class HomeController {

    private $animalDAO;
    private $habitatDAO;

    public function __construct() {
        $this->animalDAO = new AnimalDAO();
        $this->habitatDAO = new HabitatDAO();
    }

    public function render() {
        $animalcount = $this->animalDAO->getTotalAnimals();
        $habitatcount = $this->habitatDAO->getTotalHabitats();
        include "../views/home.php";
    }

}