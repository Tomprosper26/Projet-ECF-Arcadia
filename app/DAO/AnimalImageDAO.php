<?php

require_once 'DataBaseDAO.php';

class AnimalImageDAO extends DataBase {

    public function getImageByAnimalId($animal_id) {
        $stmt = $this->pdo->prepare("SELECT image FROM animal_image WHERE animal_id = :animal_id");
        $stmt->execute(['animal_id' => $animal_id]);
        return $stmt->fetch();
    }

    public function addImage($animal_id, $imageData) {
        $stmt = $this->pdo->prepare("INSERT INTO animal_image (animal_id, image) VALUES (:animal_id, :image)");
        return $stmt->execute([
            'animal_id' => $animal_id,
            'image' => $imageData
        ]);
    }

    public function deleteImage($id) {
        $stmt = $this->pdo->prepare("DELETE FROM animal_image WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getAllAnimalImages() {
        $stmt = $this->pdo->query("SELECT * FROM animal_image");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>