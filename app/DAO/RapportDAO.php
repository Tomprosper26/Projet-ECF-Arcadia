<?php

require_once 'DataBaseDAO.php';

class RapportDAO extends DataBase {

    public function insertRapport($nourriture, $grammage, $detail, $animal_id, $user_id) {
        $sql = "INSERT INTO rapport_veterinaire (nourriture, grammage, détail, animal_id, user_id) VALUES (:nourriture, :grammage, :detail, :animal_id, :user_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'nourriture' => $nourriture,
            'grammage' => $grammage,
            'detail' => $detail,
            'animal_id' => $animal_id,
            'user_id' => $user_id
        ]);
    }

    public function getRapportById($id) {
        $sql = "SELECT * FROM rapport_veterinaire WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllRapports() {
        $sql = "SELECT * FROM rapport_veterinaire";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateRapport($id, $nourriture, $grammage, $détail, $animal_id, $user_id) {
        $sql = "UPDATE rapport_veterinaire SET nourriture = :nourriture, grammage = :grammage, détail = :détail, animal_id = :animal_id, user_id = :user_id WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'nourriture' => $nourriture,
            'grammage' => $grammage,
            'détail' => $détail,
            'animal_id' => $animal_id,
            'user_id' => $user_id
        ]);
    }

    public function deleteRapport($id) {
        $sql = "DELETE FROM rapport_veterinaire WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}

?>