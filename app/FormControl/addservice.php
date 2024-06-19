<?php
require_once "../app/DAO/ServicesDAO.php";
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST['action'];

    if($action == 'add_service') {

        $image = $_FILES['image'];
        $imageData = file_get_contents($image['tmp_name']);
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];

        try {
            $servicesDAO = new ServicesDAO();
            $servicesDAO->addService($nom, $description, $prix, $imageData);

            $url = "/connexion-" . $user['role_id'];
            header("Location: $url");
            exit();

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>