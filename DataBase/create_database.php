<?php

$username = "root";
$password ="0000";

try {
    
    $pdo = new PDO('mysql:host=localhost', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbName = 'zoo';
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName`");
    echo "Base de données '$dbName' créée avec succès.<br>";

    $pdo->exec("USE `$dbName`");

    $createTableSQL = "
    CREATE TABLE IF NOT EXISTS habitat (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(50) NOT NULL,
        description TEXT NOT NULL,
        commentaire_habitat TEXT,
        commentaire_veterinaire TEXT
    );

    CREATE TABLE IF NOT EXISTS race (
        id INT AUTO_INCREMENT PRIMARY KEY,
        label VARCHAR(50) NOT NULL
    );

    CREATE TABLE IF NOT EXISTS animal (
        id INT AUTO_INCREMENT PRIMARY KEY,
        prenom VARCHAR(50) NOT NULL,
        etat VARCHAR(255) NOT NULL,
        nourriture VARCHAR(50),
        quantity FLOAT,
        date_repas DATETIME,
        habitat_id INT,
        race_id INT,
        FOREIGN KEY (habitat_id) REFERENCES habitat(id),
        FOREIGN KEY (race_id) REFERENCES race(id)
    );

    CREATE TABLE IF NOT EXISTS image (
        id INT AUTO_INCREMENT PRIMARY KEY,
        data LONGBLOB NOT NULL,
        habitat_id INT,
        FOREIGN KEY (habitat_id) REFERENCES habitat(id)
    );
    ";
    $pdo->exec($createTableSQL);
    echo "Tables créées avec succès.<br>";

    $createUserTableSQL = "
    CREATE TABLE IF NOT EXISTS role (
        id INT AUTO_INCREMENT PRIMARY KEY,
        label VARCHAR(50) NOT NULL
    );

    CREATE TABLE IF NOT EXISTS user (
        username VARCHAR(255) PRIMARY KEY,
        password VARCHAR(255) NOT NULL,
        nom VARCHAR(50) NOT NULL,
        prenom VARCHAR(50) NOT NULL,
        role_id INT,
        FOREIGN KEY (role_id) REFERENCES role(id)
    );
    ";
    $pdo->exec($createUserTableSQL);

    $createServiceTableSQL = "
    CREATE TABLE IF NOT EXISTS service (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        prix DECIMAL(10, 2) DEFAULT NULL,
        image LONGBLOB NOT NULL
    );
    ";
    $pdo->exec($createServiceTableSQL);

    $createAvisTableSQL = "
    CREATE TABLE IF NOT EXISTS avis (
        id INT AUTO_INCREMENT PRIMARY KEY,
        pseudo VARCHAR(50) NOT NULL,
        commentaire TEXT NOT NULL,
        is_visible BOOLEAN DEFAULT FALSE
    );
    ";
    $pdo->exec($createAvisTableSQL);

    $createRapportVeterinaireTableSQL = "
    CREATE TABLE IF NOT EXISTS rapport_veterinaire (
        id INT AUTO_INCREMENT PRIMARY KEY,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        nourriture VARCHAR(50),
        grammage FLOAT,
        détail TEXT,
        animal_id INT,
        user_id VARCHAR(255),
        FOREIGN KEY (animal_id) REFERENCES animal(id),
        FOREIGN KEY (user_id) REFERENCES user(username)
    );
    ";
    $pdo->exec($createRapportVeterinaireTableSQL);

    $createAnimalImageTableSQL = "
    CREATE TABLE IF NOT EXISTS animal_image (
        id INT AUTO_INCREMENT PRIMARY KEY,
        animal_id INT,
        image LONGBLOB NOT NULL,
        FOREIGN KEY (animal_id) REFERENCES animal(id)
    );
    ";
    $pdo->exec($createAnimalImageTableSQL);

    $createHorairesTableSQL = "
    CREATE TABLE IF NOT EXISTS horaires (
        id INT AUTO_INCREMENT PRIMARY KEY,
        jour VARCHAR(10) NOT NULL,
        ouverture TIME NOT NULL,
        fermeture TIME NOT NULL
    );
    ";
    $pdo->exec($createHorairesTableSQL);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
