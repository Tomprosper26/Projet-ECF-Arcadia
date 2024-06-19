<?php
require_once "../app/DAO/HorairesDAO.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST['action'];

    if($action == 'update_horaires') {

        $horairesDAO = new HorairesDAO();

        $jour = $_POST['jour'];
        $ouverture = $_POST['ouverture'];
        $fermeture = $_POST['fermeture'];

        $horaire = $horairesDAO->getHorairesByDay($jour);

        $horairesDAO->updateHoraire($horaire['id'], $jour, $ouverture, $fermeture);

        $url = "/connexion-" . $user['role_id'];
        header("Location: $url");
        exit();
    }
}
?>