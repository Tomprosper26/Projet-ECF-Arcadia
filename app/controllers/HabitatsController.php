<?php

require_once "../app/DAO/AnimalDAO.php";
require_once "../app/DAO/HabitatDAO.php";

class HabitatsController {

    private $animalDAO;
    private $habitatDAO;

    public function __construct() {
        $this->animalDAO = new AnimalDAO();
        $this->habitatDAO = new HabitatDAO();

    }

    public function render() {
        $title = "Arcadia-Habitats";
        $habitats = $this->habitatDAO->getAllHabitats();
        $habitatsImg = $this->habitatDAO->getHabitatImages();
        $habitatImages = [];
        foreach ($habitatsImg as $habitatImg) {
            $habitatImages[$habitatImg['id']] = $habitatImg['data'];
        }

        include "../views/habitats.php";
    }

}