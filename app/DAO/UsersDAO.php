<?php

require_once 'DataBaseDAO.php';

class UsersDAO extends DataBase {

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE username = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $email, $nom, $prenom, $role_id) {
        $stmt = $this->pdo->prepare('UPDATE user SET username = :email, nom = :nom, prenom = :prenom, role_id = :role_id WHERE id = :id');
        return $stmt->execute([
            'id' => $id,
            'email' => $email,
            'nom' => $nom,
            'prenom' => $prenom,
            'role_id' => $role_id
        ]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare('DELETE FROM user WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

}

?>