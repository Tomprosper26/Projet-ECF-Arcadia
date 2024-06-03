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
        commentaire_habitat TEXT
    );

    CREATE TABLE IF NOT EXISTS race (
        id INT AUTO_INCREMENT PRIMARY KEY,
        label VARCHAR(50) NOT NULL
    );

    CREATE TABLE IF NOT EXISTS animal (
        id INT AUTO_INCREMENT PRIMARY KEY,
        prenom VARCHAR(50) NOT NULL,
        etat VARCHAR(255) NOT NULL,
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

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
