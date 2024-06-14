<?php
require_once "../app/DAO/AnimalDAO.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST['action'];

    if($action == 'update_nourriture') {
        $animal_id = $_POST['animal_id'];
        $nourriture = $_POST['nourriture'];
        $quantité = $_POST['quantité'];
        $date = $_POST['date'];

        try {
            $animalDAO = new AnimalDAO();
            $animalDAO->updateAnimalFood($animal_id, $nourriture, $quantité, $date);

            $url = "/connexion-" . $user['role_id'];
            header("Location: $url");
            exit();

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>