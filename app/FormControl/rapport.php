<?php
require_once "../app/DAO/RapportDAO.php";
require_once "../app/DAO/AnimalDAO.php";
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    $RapportDAO = new RapportDAO();
    $AnimalDAO = new AnimalDAO();

    if ($action == 'create_rapport') {
        
        $user_id = $user['username'];
        $etat = $_POST['etat'];
        $nourriture = $_POST['nourriture'];
        $quantity = $_POST['quantity'];
        $commentaire = $_POST['commentaire'];
        $animal_name = $_POST['prenom'];
        $animalname = $AnimalDAO->getAnimalByName($animal_name);
        $animal_id = $animalname['id'];

        $RapportDAO->insertRapport($nourriture, $quantity, $commentaire, $animal_id, $user_id);
        $AnimalDAO->updateAnimalEtat($etat, $animal_id);

        $url = "/connexion-" . $user['role_id'];
        header("Location: $url");
        exit();

    }
}
?>