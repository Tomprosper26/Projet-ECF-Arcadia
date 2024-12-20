<?php

require_once 'DataBaseDAO.php';

class HabitatDAO extends DataBase {

    public function getAllHabitats() {
        $stmt = $this->pdo->query("SELECT * FROM habitat");
        return $stmt->fetchAll();
    }

    public function getHabitatById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM habitat WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function addHabitat($nom, $description, $commentaire_habitat) {
        $stmt = $this->pdo->prepare("INSERT INTO habitat (nom, description, commentaire_habitat) VALUES (:nom, :description, :commentaire_habitat)");
        return $stmt->execute([
            'nom' => $nom,
            'description' => $description,
            'commentaire_habitat' => $commentaire_habitat
        ]);
    }

    public function updateHabitat($id, $nom, $description) {
        $stmt = $this->pdo->prepare("UPDATE habitat SET nom = :nom, description = :description WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nom' => $nom,
            'description' => $description,
        ]);
    }

    public function updateCommentaire($id, $commentaire_habitat) {
        $stmt = $this->pdo->prepare("UPDATE habitat SET commentaire_habitat = :commentaire_habitat WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'commentaire_habitat' => $commentaire_habitat
        ]);
    }

    public function deleteHabitat($id) {
        $stmt = $this->pdo->prepare("DELETE FROM habitat WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getTotalHabitats() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM habitat");
        return $stmt->fetchColumn();
    }

    public function getHabitatImage($habitatId) {
        $stmt = $this->pdo->prepare('SELECT data FROM image WHERE habitat_id = :habitat_id');
        $stmt->execute(['habitat_id' => $habitatId]);
        return $stmt->fetchColumn();
    }

    public function getFirstThreeHabitats() {
        $stmt = $this->pdo->query('SELECT * FROM habitat LIMIT 3');
        return $stmt->fetchAll();
    }

    public function getHabitatImages() {
        $stmt = $this->pdo->query("SELECT habitat.id, image.data FROM habitat JOIN image ON habitat.id = image.habitat_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addHabitatImage($habitatId, $data) {
        $stmt = $this->pdo->prepare('INSERT INTO image (data, habitat_id) VALUES (:data, :habitat_id)');
        $stmt->execute([
            'data' => $data,
            'habitat_id' => $habitatId
        ]);
    }

    public function getHabitatByName($name) {
        $stmt = $this->pdo->prepare("SELECT * FROM habitat WHERE nom = :nom");
        $stmt->execute(['nom' => $name]);
        return $stmt->fetch();
    }

    public function deleteImage($id) {
        $sql = "DELETE FROM image WHERE habitat_id = :habitat_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':habitat_id' => $id]);
    }
}
?>