<?php

require_once 'DataBaseDAO.php';

class AnimalImageDAO extends DataBase {

    public function getImageByAnimalId($animal_id) {
        $stmt = $this->pdo->prepare("SELECT image FROM animal_image WHERE animal_id = :animal_id");
        $stmt->execute(['animal_id' => $animal_id]);
        return $stmt->fetch();
    }

    public function addImage($animal_id, $file_path) {
        $imageData = file_get_contents($file_path);
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
}
?>