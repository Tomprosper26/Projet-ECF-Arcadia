<?php

require_once 'DataBaseDAO.php';

class AvisDAO extends DataBase {

    public function addAvis($pseudo, $commentaire, $isVisible = false) {
        $sql = "INSERT INTO avis (pseudo, commentaire, is_visible) VALUES (:pseudo, :commentaire, :is_visible)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':pseudo' => $pseudo,
            ':commentaire' => $commentaire,
            ':is_visible' => $isVisible
        ]);
        return $this->pdo->lastInsertId();
    }

        public function getAllAvis() {
            $sql = "SELECT * FROM avis";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function getVisibleAvis() {
            $sql = "SELECT * FROM avis WHERE is_visible = 1";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function updateAvis($id, $pseudo, $commentaire, $isVisible) {
            $sql = "UPDATE avis SET pseudo = :pseudo, commentaire = :commentaire, is_visible = :is_visible WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':pseudo' => $pseudo,
                ':commentaire' => $commentaire,
                ':is_visible' => $isVisible,
                ':id' => $id
            ]);
        }
    
        public function deleteAvis($id) {
            $sql = "DELETE FROM avis WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':id' => $id]);
        }
    
        public function getAvisById($id) {
            $sql = "SELECT * FROM avis WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
}

?>