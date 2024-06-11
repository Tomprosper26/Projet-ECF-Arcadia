<?php

require_once "../app/DAO/AnimalDAO.php";
require_once "../app/DAO/HabitatDAO.php";
require_once "../app/DAO/AnimalimageDAO.php";

class HabitatsController {

    private $animalDAO;
    private $habitatDAO;
    private $animalimageDAO;

    public function __construct() {
        $this->animalDAO = new AnimalDAO();
        $this->habitatDAO = new HabitatDAO();
        $this->animalimageDAO = new AnimalImageDAO();

    }

    public function render() {
        $title = "Arcadia-Habitats";
        $habitats = $this->habitatDAO->getAllHabitats();
        $habitatsImg = $this->habitatDAO->getHabitatImages();
        $habitatImages = [];
        foreach ($habitatsImg as $habitatImg) {
            $habitatImages[$habitatImg['id']] = $habitatImg['data'];
        }
        $animals = $this->animalDAO->getAllAnimals();
        $animalImages = $this->animalimageDAO->getAllAnimalImages();

        include "../views/habitats.php";
    }

}