<?php
require_once "../app/DAO/AvisDAO.php";
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    $reviewsDAO = new AvisDAO();

    if ($action == 'toggle_visibility') {
        
        $reviewId = $_POST['id'];
        $review = $reviewsDAO->getAvisById($reviewId);
        $newVisibility = !$review['is_visible'];
        $reviewsDAO->updateVisibility($reviewId);

        $url = "/connexion-" . $user['role_id'];
        header("Location: $url");
        exit();

    } elseif ($action == 'delete') {
        
        $reviewId = $_POST['id'];
        $reviewsDAO->deleteAvis($reviewId);

        $url = "/connexion-" . $user['role_id'];
        header("Location: $url");
        exit();
    }
}
?>