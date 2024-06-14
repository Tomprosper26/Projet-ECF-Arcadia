<?php
require_once "../app/DAO/ServicesDAO.php";
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST['action'];

    if($action == 'update_service') {
        $serviceId = $_POST['id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];

        try {
            $servicesDAO = new ServicesDAO();
            $servicesDAO->updateService($serviceId, $nom, $description, $prix);

            $url = "/connexion-" . $user['role_id'];
            header("Location: $url");
            exit();

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>