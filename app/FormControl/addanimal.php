<?php
require_once "../app/DAO/AnimalDAO.php";
require_once "../app/DAO/AnimalImageDAO.php";
require_once "../app/DAO/RaceDAO.php";
include "../app/MongoDB/AnimalViews.php";
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    $animalDAO = new AnimalDAO();
    $imageDAO = new AnimalImageDAO();
    $raceDAO = new RaceDAO();
    $viewsDAO = new AnimalMongoDAO();

    if ($action == 'add_animal') {
        
        $prenom = $_POST['nom'];
        $etat = $_POST['etat'];
        $habitat_id = $_POST['habitat_id'];
        $race_id = $_POST['race'];
        $image = $_FILES['image'];
        $imageData = file_get_contents($image['tmp_name']);

        if($race_id == "others"){

            $raceDAO->createRace($_POST['race_create']);
            $race = $raceDAO->getRaceByName($_POST['race_create']);
            $race_id = $race['id'];
            $animalDAO->addAnimal($prenom, $etat, $habitat_id, $race_id);
            $animal = $animalDAO->getAnimalByName($prenom);
            $animal_id = $animal['id'];
            $imageDAO->addImage($animal_id, $imageData);
            $viewsDAO->insertAnimal($animal_id, $prenom);

            $url = "/connexion-" . $user['role_id'];
            header("Location: $url");
            exit();

        } else {

            $animalDAO->addAnimal($prenom, $etat, $habitat_id, $race_id);
            $animal = $animalDAO->getAnimalByName($prenom);
            $animal_id = $animal['id'];
            $imageDAO->addImage($animal_id, $imageData);
            $viewsDAO->insertAnimal($animal_id, $prenom);

            $url = "/connexion-" . $user['role_id'];
            header("Location: $url");
            exit();

        }

    }
}
?>
