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

    public function updateHabitat($id, $nom, $description, $commentaire_habitat) {
        $stmt = $this->pdo->prepare("UPDATE habitat SET nom = :nom, description = :description, commentaire_habitat = :commentaire_habitat WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nom' => $nom,
            'description' => $description,
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
}
?>