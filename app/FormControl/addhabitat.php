<?php
require_once "../app/DAO/HabitatDAO.php";
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    $HabitatDAO = new HabitatDAO();

    if ($action == 'add_habitat') {
        
        $habitat_description = $_POST['description'];
        $habitat_commentaire = $_POST['commentaire'];
        $nom = $_POST['nom'];
        $image = $_FILES['image'];
        $imageData = file_get_contents($image['tmp_name']);

        $HabitatDAO->addHabitat($nom, $habitat_description, $habitat_commentaire);
        $habitat = $HabitatDAO->getHabitatByName($nom);
        $habitat_id = $habitat['id'];
        $HabitatDAO->addHabitatImage($habitat_id, $imageData);

        $url = "/connexion-" . $user['role_id'];
        header("Location: $url");
        exit();

    }
}
?>