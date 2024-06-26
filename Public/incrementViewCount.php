<?php
require "../app/MongoDB/AnimalViewsDAO.php";

$animalViewsDAO = new AnimalMongoDAO();

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID de l\'animal manquant']);
    exit();
}

$animalId = $input['id'];

if ($animalId) {
    $animalViewsDAO->incrementViewCount($animalId);

    echo json_encode(['success' => true]);

} else {
    echo json_encode(['animalId undefined' => true]);
}
?>
