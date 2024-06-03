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
        ['label' => 'Singe']
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
        ['prenom' => 'Mowgli', 'etat' => 'sain', 'habitat_nom' => 'jungle', 'race_label' => 'Singe'],
        ['prenom' => 'Baloo', 'etat' => 'sain', 'habitat_nom' => 'jungle', 'race_label' => 'Ours'],
        ['prenom' => 'Bagheera', 'etat' => 'sain', 'habitat_nom' => 'jungle', 'race_label' => 'Singe'],
        ['prenom' => 'Frodo', 'etat' => 'sain', 'habitat_nom' => 'marais', 'race_label' => 'Singe'],
        ['prenom' => 'Gollum', 'etat' => 'sain', 'habitat_nom' => 'marais', 'race_label' => 'Singe'],
        ['prenom' => 'Sam', 'etat' => 'sain', 'habitat_nom' => 'marais', 'race_label' => 'Singe']
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

    // Insérer des images (les données des images doivent être en LONGBLOB)
    $images = [
        ['file_path' => '/path/to/savane_image.jpg', 'habitat_nom' => 'savane'],
        ['file_path' => '/path/to/jungle_image.jpg', 'habitat_nom' => 'jungle'],
        ['file_path' => '/path/to/marais_image.jpg', 'habitat_nom' => 'marais']
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

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

