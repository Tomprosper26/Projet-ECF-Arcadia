<?php

require_once 'DataBaseDAO.php';

class AnimalDAO extends DataBase {

    public function getAllAnimals() {
        $stmt = $this->pdo->query("SELECT * FROM animal");
        return $stmt->fetchAll();
    }

    public function getAnimalById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM animal WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function addAnimal($prenom, $etat, $habitat_id, $race_id) {
        $stmt = $this->pdo->prepare("INSERT INTO animal (prenom, etat, habitat_id, race_id) VALUES (:prenom, :etat, :habitat_id, :race_id)");
        return $stmt->execute([
            'prenom' => $prenom,
            'etat' => $etat,
            'habitat_id' => $habitat_id,
            'race_id' => $race_id
        ]);
    }

    public function updateAnimal($id, $prenom, $etat, $habitat_id, $race_id) {
        $stmt = $this->pdo->prepare("UPDATE animal SET prenom = :prenom, etat = :etat, habitat_id = :habitat_id, race_id = :race_id WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'prenom' => $prenom,
            'etat' => $etat,
            'habitat_id' => $habitat_id,
            'race_id' => $race_id
        ]);
    }

    public function deleteAnimal($id) {
        $stmt = $this->pdo->prepare("DELETE FROM animal WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getTotalAnimals() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM animal");
        return $stmt->fetchColumn();
    }

    public function getAllAnimalsDetails() {
        $stmt = $this->pdo->query("SELECT * FROM animal LEFT JOIN animal_image ON animal.id = animal_image.animal_id RIGHT JOIN race ON race.id = animal.race_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateAnimalFood($animalId, $foodType, $quantity, $feedingDate) {
        $stmt = $this->pdo->prepare("UPDATE animal SET nourriture = ?, quantity = ?, date_repas = ? WHERE id = ?");
        $stmt->execute([$foodType, $quantity, $feedingDate, $animalId]);
    }

    public function updateAnimalEtat($etat, $id) {
        $stmt = $this->pdo->prepare("UPDATE animal SET etat = :etat  WHERE id = :id");
        return $stmt->execute([
            'etat' => $etat,
            'id' => $id
        ]);
    }
}
?>