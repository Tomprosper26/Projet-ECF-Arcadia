<?php

require_once "../app/DAO/AvisDAO.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $reviewId = $_POST['id'];
    $action = $_POST['action'];

    $reviewsDAO = new AvisDAO();

    if ($action == 'toggle_visibility') {

        $review = $reviewsDAO->getAvisById($reviewId);
        $newVisibility = !$review['is_visible'];
        $reviewsDAO->updateVisibility($reviewId);

    } elseif ($action == 'delete') {

        $reviewsDAO->deleteAvis($reviewId);

    }

    header("Location: /connexion-2");
    exit();
}
?>