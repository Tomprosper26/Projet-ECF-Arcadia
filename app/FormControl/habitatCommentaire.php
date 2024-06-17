<?php
require_once "../app/DAO/HabitatDAO.php";
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    $HabitatDAO = new HabitatDAO();

    if ($action == 'update_habitat_commentaire') {
        
        $habitat_id = $_POST['id'];
        $habitat_commentaire = $_POST['commentaire'];

        $HabitatDAO->updateCommentaire($habitat_id, $habitat_commentaire);

        $url = "/connexion-" . $user['role_id'];
        header("Location: $url");
        exit();

    }
}
?>