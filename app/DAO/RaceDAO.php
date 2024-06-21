<?php

require_once 'DataBaseDAO.php';

class RaceDAO extends DataBase {

    public function createRace($label) {
        $stmt = $this->pdo->prepare('INSERT INTO race (label) VALUES (:label)');
        return $stmt->execute(['label' => $label]);
    }

    public function getRaceById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM race WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllRaces() {
        $stmt = $this->pdo->query('SELECT * FROM race');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateRace($id, $label) {
        $stmt = $this->pdo->prepare('UPDATE race SET label = :label WHERE id = :id');
        return $stmt->execute(['id' => $id, 'label' => $label]);
    }

    public function deleteRace($id) {
        $stmt = $this->pdo->prepare('DELETE FROM race WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function getRaceByName($nom) {
        $stmt = $this->pdo->prepare('SELECT * FROM race WHERE label = :nom');
        $stmt->execute(['nom' => $nom]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>