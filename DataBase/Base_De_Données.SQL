-- Création de la Base de Donnée :

CREATE DATABASE IF NOT EXISTS zoo;

-- Création des tables : 

-- Création de la table 'habitat'
CREATE TABLE IF NOT EXISTS habitat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    commentaire_habitat TEXT
);

-- Création de la table 'race'
CREATE TABLE IF NOT EXISTS race (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50) NOT NULL
);

-- Création de la table 'animal'
CREATE TABLE IF NOT EXISTS animal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL,
    etat VARCHAR(255) NOT NULL,
    habitat_id INT,
    race_id INT,
    FOREIGN KEY (habitat_id) REFERENCES habitat(id),
    FOREIGN KEY (race_id) REFERENCES race(id)
);

-- Création de la table 'image'
CREATE TABLE IF NOT EXISTS image (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data LONGBLOB NOT NULL,
    habitat_id INT,
    FOREIGN KEY (habitat_id) REFERENCES habitat(id)
);

-- Insertion des données : 

-- Insérer des habitats
INSERT INTO habitat (nom, description, commentaire_habitat) VALUES
('savane', 'Large plaine herbeuse avec des arbres dispersés', 'Chaud et sec'),
('jungle', 'Forêt dense et humide', 'Chaud et humide'),
('marais', 'Terrain bas et humide', 'Humide et boueux');

-- Insérer des races
INSERT INTO race (label) VALUES
('Lion'),
('Ours'),
('Singe');

-- Insérer des animaux
INSERT INTO animal (prenom, etat, habitat_id, race_id) VALUES
('Leo', 'sain', (SELECT id FROM habitat WHERE nom = 'savane'), (SELECT id FROM race WHERE label = 'Lion')),
('Simba', 'sain', (SELECT id FROM habitat WHERE nom = 'savane'), (SELECT id FROM race WHERE label = 'Lion')),
('Nala', 'sain', (SELECT id FROM habitat WHERE nom = 'savane'), (SELECT id FROM race WHERE label = 'Lion')),
('Mowgli', 'sain', (SELECT id FROM habitat WHERE nom = 'jungle'), (SELECT id FROM race WHERE label = 'Singe')),
('Baloo', 'sain', (SELECT id FROM habitat WHERE nom = 'jungle'), (SELECT id FROM race WHERE label = 'Ours')),
('Bagheera', 'sain', (SELECT id FROM habitat WHERE nom = 'jungle'), (SELECT id FROM race WHERE label = 'Singe')),
('Frodo', 'sain', (SELECT id FROM habitat WHERE nom = 'marais'), (SELECT id FROM race WHERE label = 'Singe')),
('Gollum', 'sain', (SELECT id FROM habitat WHERE nom = 'marais'), (SELECT id FROM race WHERE label = 'Singe')),
('Sam', 'sain', (SELECT id FROM habitat WHERE nom = 'marais'), (SELECT id FROM race WHERE label = 'Singe'));

-- Insérer des images (les données des images doivent être en LONGBLOB, donc cette commande est juste un exemple)
-- Assurez-vous d'utiliser des binaires valides pour les images dans votre implémentation réelle
INSERT INTO image (data, habitat_id) VALUES
(LOAD_FILE('/path/to/savane_image.jpg'), (SELECT id FROM habitat WHERE nom = 'savane')),
(LOAD_FILE('/path/to/jungle_image.jpg'), (SELECT id FROM habitat WHERE nom = 'jungle')),
(LOAD_FILE('/path/to/marais_image.jpg'), (SELECT id FROM habitat WHERE nom = 'marais'));
