<?php

$username = "root";
$password ="0000";

try {
    
    $pdo = new PDO("mysql:host=localhost;dbname=zoo", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insérer des données dans la table habitat
    $habitats = [
        ['nom' => 'savane', 'description' => 'Large plaine herbeuse avec des arbres dispersés', 'commentaire_habitat' => 'Chaud et sec'],
        ['nom' => 'jungle', 'description' => 'Forêt dense et humide', 'commentaire_habitat' => 'Chaud et humide'],
        ['nom' => 'marais', 'description' => 'Terrain bas et humide', 'commentaire_habitat' => 'Humide et boueux']
    ];

    $stmt = $pdo->prepare("INSERT INTO habitat (nom, description, commentaire_habitat) VALUES (:nom, :description, :commentaire_habitat)");
    foreach ($habitats as $habitat) {
        $stmt->execute($habitat);
    }

    // Insérer des données dans la table race
    $races = [
        ['label' => 'Lion'],
        ['label' => 'Ours'],
        ['label' => 'Crocodile']
    ];

    $stmt = $pdo->prepare("INSERT INTO race (label) VALUES (:label)");
    foreach ($races as $race) {
        $stmt->execute($race);
    }

    // Insérer des données dans la table animal
    $animals = [
        ['prenom' => 'Leo', 'etat' => 'sain', 'habitat_nom' => 'savane', 'race_label' => 'Lion'],
        ['prenom' => 'Simba', 'etat' => 'sain', 'habitat_nom' => 'savane', 'race_label' => 'Lion'],
        ['prenom' => 'Nala', 'etat' => 'sain', 'habitat_nom' => 'savane', 'race_label' => 'Lion'],
        ['prenom' => 'Mowgli', 'etat' => 'sain', 'habitat_nom' => 'jungle', 'race_label' => 'Ours'],
        ['prenom' => 'Baloo', 'etat' => 'sain', 'habitat_nom' => 'jungle', 'race_label' => 'Ours'],
        ['prenom' => 'Bagheera', 'etat' => 'sain', 'habitat_nom' => 'jungle', 'race_label' => 'Ours'],
        ['prenom' => 'Frodo', 'etat' => 'sain', 'habitat_nom' => 'marais', 'race_label' => 'Crocodile'],
        ['prenom' => 'Gollum', 'etat' => 'sain', 'habitat_nom' => 'marais', 'race_label' => 'Crocodile'],
        ['prenom' => 'Sam', 'etat' => 'sain', 'habitat_nom' => 'marais', 'race_label' => 'Crocodile']
    ];

    $stmt = $pdo->prepare("INSERT INTO animal (prenom, etat, habitat_id, race_id) VALUES (:prenom, :etat, :habitat_id, :race_id)");
    foreach ($animals as $animal) {
        $habitatId = $pdo->query("SELECT id FROM habitat WHERE nom = '{$animal['habitat_nom']}'")->fetchColumn();
        $raceId = $pdo->query("SELECT id FROM race WHERE label = '{$animal['race_label']}'")->fetchColumn();
        $stmt->execute([
            'prenom' => $animal['prenom'],
            'etat' => $animal['etat'],
            'habitat_id' => $habitatId,
            'race_id' => $raceId
        ]);
    }

    // Insérer des images.
    $images = [
        ['file_path' => 'images/savane.jpg', 'habitat_nom' => 'savane'],
        ['file_path' => 'images/jungle.jpg', 'habitat_nom' => 'jungle'],
        ['file_path' => 'images/marais.jpg', 'habitat_nom' => 'marais']
    ];

    $stmt = $pdo->prepare("INSERT INTO image (data, habitat_id) VALUES (:data, :habitat_id)");
    foreach ($images as $image) {
        $habitatId = $pdo->query("SELECT id FROM habitat WHERE nom = '{$image['habitat_nom']}'")->fetchColumn();
        $imageData = file_get_contents($image['file_path']);
        $stmt->execute([
            'data' => $imageData,
            'habitat_id' => $habitatId
        ]);
    }

    $roles = [
        ['label' => 'admin'],
        ['label' => 'employé'],
        ['label' => 'vétérinaire']
    ];

    $stmt = $pdo->prepare("INSERT INTO role (label) VALUES (:label)");
    foreach ($roles as $role) {
        $stmt->execute($role);
    }

    $users = [
        ['username' => 'admin@example.com', 'password' => password_hash('adminpass', PASSWORD_DEFAULT), 'nom' => 'José', 'prenom' => 'Dupont', 'role_label' => 'admin'],
        ['username' => 'employe@example.com', 'password' => password_hash('employepass', PASSWORD_DEFAULT), 'nom' => 'Jonh', 'prenom' => 'Doe', 'role_label' => 'employé'],
        ['username' => 'vet@example.com', 'password' => password_hash('vetpass', PASSWORD_DEFAULT), 'nom' => 'Jane', 'prenom' => 'Dane', 'role_label' => 'vétérinaire']
    ];

    $stmt = $pdo->prepare("INSERT INTO user (username, password, nom, prenom, role_id) VALUES (:username, :password, :nom, :prenom, :role_id)");
    foreach ($users as $user) {
        $roleId = $pdo->query("SELECT id FROM role WHERE label = '{$user['role_label']}'")->fetchColumn();
        $stmt->execute([
            'username' => $user['username'],
            'password' => $user['password'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'role_id' => $roleId
        ]);
    }

    $services = [
        ['nom' => 'Restauration', 'description' => 'Service de restauration avec divers plats et boissons disponibles.', 'prix' => 15.00],
        ['nom' => 'Visite Guidée', 'description' => 'Visite guidée gratuite pour découvrir les différents animaux du zoo.', 'prix' => NULL],
        ['nom' => 'Visite en Petit Train', 'description' => 'Tour en petit train pour explorer le zoo.', 'prix' => 5.00]
    ];

    $stmt = $pdo->prepare("INSERT INTO service (nom, description, prix) VALUES (:nom, :description, :prix)");
    foreach ($services as $service) {
        $stmt->execute($service);
    }

    $avis = [
        ['pseudo' => 'JohnDoe', 'commentaire' => 'Très belle visite, les enfants ont adoré!', 'is_visible' => false],
        ['pseudo' => 'Visitor123', 'commentaire' => 'Les animaux semblaient bien traités, bonne expérience.', 'is_visible' => false]
    ];

    $stmt = $pdo->prepare("INSERT INTO avis (pseudo, commentaire, is_visible) VALUES (:pseudo, :commentaire, :is_visible)");
    foreach ($avis as $avi) {
        $stmt->execute($avi);
    }

    $aimages = [
        ['animal_id' => 1, 'file_path' => 'images/lion.jpg'],
        ['animal_id' => 2, 'file_path' => 'images/lion.jpg'],
        ['animal_id' => 3, 'file_path' => 'images/lion.jpg'],
        ['animal_id' => 4, 'file_path' => 'images/ours.jpg'],
        ['animal_id' => 5, 'file_path' => 'images/ours.jpg'],
        ['animal_id' => 6, 'file_path' => 'images/ours.jpg'],
        ['animal_id' => 7, 'file_path' => 'images/crocodile.jpg'],
        ['animal_id' => 8, 'file_path' => 'images/crocodile.jpg'],
        ['animal_id' => 9, 'file_path' => 'images/crocodile.jpg']
    ];

    $stmt = $pdo->prepare("INSERT INTO animal_image (animal_id, image) VALUES (:animal_id, :image)");
    foreach ($aimages as $aimage) {
        $imageData = file_get_contents($aimage['file_path']);
        $stmt->execute([
            'animal_id' => $aimage['animal_id'],
            'image' => $imageData
        ]);
    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

