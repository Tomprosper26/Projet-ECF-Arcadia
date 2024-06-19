<?php
require_once "../app/DAO/HabitatDAO.php";
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    $HabitatDAO = new HabitatDAO();

    if ($action == 'update_habitat') {
        
        $habitat_id = $_POST['id'];
        $habitat_description = $_POST['description'];
        $nom = $_POST['nom'];

        $HabitatDAO->updateHabitat($habitat_id, $nom, $habitat_description);

        $url = "/connexion-" . $user['role_id'];
        header("Location: $url");
        exit();

    } elseif ($action == 'delete_habitat') {

        $habitat_id = $_POST['id'];

        $HabitatDAO->deleteImage($habitat_id);
        $HabitatDAO->deleteHabitat($habitat_id);

        $url = "/connexion-" . $user['role_id'];
        header("Location: $url");
        exit();
    }
}
?>