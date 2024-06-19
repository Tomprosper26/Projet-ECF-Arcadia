<?php
require_once 'DataBaseDAO.php';

class HorairesDAO extends DataBase{

    public function getAllHoraires() {
        $stmt = $this->pdo->query("SELECT * FROM horaires");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHorairesByDay($jour) {
        $stmt = $this->pdo->prepare("SELECT * FROM horaires WHERE jour = :jour");
        $stmt->execute(['jour' => $jour]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addHoraire($jour, $ouverture, $fermeture) {
        $stmt = $this->pdo->prepare("INSERT INTO horaires (jour, ouverture, fermeture) VALUES (:jour, :ouverture, :fermeture)");
        return $stmt->execute([
            'jour' => $jour,
            'ouverture' => $ouverture,
            'fermeture' => $fermeture
        ]);
    }

    public function updateHoraire($id, $jour, $ouverture, $fermeture) {
        $stmt = $this->pdo->prepare("UPDATE horaires SET jour = :jour, ouverture = :ouverture, fermeture = :fermeture WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'jour' => $jour,
            'ouverture' => $ouverture,
            'fermeture' => $fermeture
        ]);
    }

    public function deleteHoraire($id) {
        $stmt = $this->pdo->prepare("DELETE FROM horaires WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>