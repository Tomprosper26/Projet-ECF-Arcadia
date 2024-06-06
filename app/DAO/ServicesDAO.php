<?php

require_once 'DataBaseDAO.php';

class ServicesDAO extends DataBase {

        public function addService($name, $description, $price = null, $image) {
            $stmt = $this->pdo->prepare("INSERT INTO service (nom, description, prix, image) VALUES (:nom, :description, :prix, :image)");
            return $stmt->execute([
                'nom' => $name,
                'description' => $description,
                'prix' => $price,
                'image' => $image
            ]);
        }
    
        public function getAllServices() {
            $stmt = $this->pdo->query("SELECT * FROM service");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function getServiceById($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM service WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        public function updateService($id, $name, $description, $price = null) {
            $stmt = $this->pdo->prepare("UPDATE service SET nom = :nom, description = :description, prix = :prix WHERE id = :id");
            return $stmt->execute([
                'id' => $id,
                'nom' => $name,
                'description' => $description,
                'prix' => $price
            ]);
        }

        public function deleteService($id) {
            $stmt = $this->pdo->prepare("DELETE FROM service WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        }
}