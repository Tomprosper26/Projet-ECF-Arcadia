<?php
require_once "../app/DAO/AnimalDAO.php";
require_once "../app/DAO/AnimalImageDAO.php";
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    $animalDAO = new AnimalDAO();
    $imageDAO = new AnimalImageDAO();

    if ($action == 'update_animal') {

        $animal_name = $_POST['prenom'];
        $habitat_id = $_POST['habitat_id'];
        $etat = $_POST['etat'];
        $prenom = $_POST['nom'];
        $animalname = $animalDAO->getAnimalByName($animal_name);
        $animal_id = $animalname['id'];

    $animalDAO->updateAnimal($animal_id, $prenom, $etat, $habitat_id);

        $url = "/connexion-" . $user['role_id'];
        header("Location: $url");
        exit();

    } elseif ($action == 'delete_animal') {

        $animal_name = $_POST['prenom'];
        $animalname = $animalDAO->getAnimalByName($animal_name);
        $animal_id = $animalname['id'];

        $imageDAO->deleteImage($animal_id);
        $animalDAO->deleteAnimal($animal_id);

        $url = "/connexion-" . $user['role_id'];
        header("Location: $url");
        exit();
    }
}
?>