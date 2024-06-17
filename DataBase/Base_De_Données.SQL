-- Création de la Base de Donnée :

CREATE DATABASE IF NOT EXISTS zoo;

-- Création des tables : 

-- Création de la table 'habitat'
CREATE TABLE IF NOT EXISTS habitat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    commentaire_habitat TEXT,
    commentaire_veterinaire TEXT
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
    nourriture VARCHAR(50),
    quantity FLOAT,
    date_repas DATETIME,
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

-- Création de la table 'role'
CREATE TABLE IF NOT EXISTS role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50) NOT NULL
);

-- Création de la table 'user'
CREATE TABLE IF NOT EXISTS user (
    username VARCHAR(255) PRIMARY KEY,
    password VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES role(id)
);

-- Création de la table 'service'
CREATE TABLE IF NOT EXISTS service (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    prix DECIMAL(10, 2) DEFAULT NULL,
    image LONGBLOB NOT NULL,
);

-- Création de la table 'avis'
CREATE TABLE IF NOT EXISTS avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50) NOT NULL,
    commentaire TEXT NOT NULL,
    is_visible BOOLEAN DEFAULT FALSE
);

-- Création de la table 'rapport_veterinaire'
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

-- Création de la table 'animal_image'
CREATE TABLE IF NOT EXISTS animal_image (
    id INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT,
    image LONGBLOB NOT NULL,
    FOREIGN KEY (animal_id) REFERENCES animal(id)
);

-- Insertion des données : 

-- Insérer des habitats
INSERT INTO habitat (nom, description, commentaire_habitat) VALUES
('savane', 'Large plaine herbeuse', 'Très bien entretenue'),
('jungle', 'Forêt dense et humide', 'Très propre'),
('marais', 'Terrain bas et humide', 'Attention quelques arbres semblent trop secs');

-- Insérer des races
INSERT INTO race (label) VALUES
('Lion'),
('Ours'),
('crocodile');

-- Insérer des animaux
INSERT INTO animal (prenom, etat, habitat_id, race_id) VALUES
('Leo', 'sain', (SELECT id FROM habitat WHERE nom = 'savane'), (SELECT id FROM race WHERE label = 'Lion')),
('Simba', 'sain', (SELECT id FROM habitat WHERE nom = 'savane'), (SELECT id FROM race WHERE label = 'Lion')),
('Nala', 'sain', (SELECT id FROM habitat WHERE nom = 'savane'), (SELECT id FROM race WHERE label = 'Lion')),
('Mowgli', 'sain', (SELECT id FROM habitat WHERE nom = 'jungle'), (SELECT id FROM race WHERE label = 'ours')),
('Baloo', 'sain', (SELECT id FROM habitat WHERE nom = 'jungle'), (SELECT id FROM race WHERE label = 'Ours')),
('Bagheera', 'sain', (SELECT id FROM habitat WHERE nom = 'jungle'), (SELECT id FROM race WHERE label = 'ours')),
('Frodo', 'sain', (SELECT id FROM habitat WHERE nom = 'marais'), (SELECT id FROM race WHERE label = 'crocodile')),
('Gollum', 'sain', (SELECT id FROM habitat WHERE nom = 'marais'), (SELECT id FROM race WHERE label = 'crocodile')),
('Sam', 'sain', (SELECT id FROM habitat WHERE nom = 'marais'), (SELECT id FROM race WHERE label = 'crocodile'));

-- Insérer des images (les données des images doivent être en LONGBLOB, donc cette commande est juste un exemple)
-- Assurez-vous d'utiliser des binaires valides pour les images dans votre implémentation réelle
INSERT INTO image (data, habitat_id) VALUES
(LOAD_FILE('/path/to/savane_image.jpg'), (SELECT id FROM habitat WHERE nom = 'savane')),
(LOAD_FILE('/path/to/jungle_image.jpg'), (SELECT id FROM habitat WHERE nom = 'jungle')),
(LOAD_FILE('/path/to/marais_image.jpg'), (SELECT id FROM habitat WHERE nom = 'marais'));

-- Insérer des rôles
INSERT INTO role (label) VALUES
('admin'),
('employé'),
('vétérinaire');

-- Insérer des utilisateurs
INSERT INTO user (username, password, nom, prenom, role_id) VALUES
('admin@example.com', 'adminpass', 'José', 'Dupont', (SELECT id FROM role WHERE label = 'admin')),
('employe@example.com', 'employepass', 'Jonh', 'Doe', (SELECT id FROM role WHERE label = 'employé')),
('vet@example.com', 'vetpass', 'Jane', 'Dane', (SELECT id FROM role WHERE label = 'vétérinaire'));

-- Insérer des services
INSERT INTO service (nom, description, prix, image) VALUES
('Restauration', 'Service de restauration avec divers plats et boissons disponibles.', 15.00, LOAD_FILE('path/to/service1.jpg')),
('Visite Guidée', 'Visite guidée gratuite pour découvrir les différents animaux du zoo.', NULL, LOAD_FILE('path/to/service2.jpg')),
('Visite en Petit Train', 'Tour en petit train pour explorer le zoo.', 5.00, LOAD_FILE('path/to/service3.jpg'));

--Insérer des avis
INSERT INTO avis (pseudo, commentaire, is_visible) VALUES
('JohnDoe', 'Très belle visite, les enfants ont adoré!', TRUE),
('Visitor123', 'Les animaux semblaient bien traités, bonne expérience.', TRUE);

-- Insérer des images (les données des images doivent être en LONGBLOB, donc cette commande est juste un exemple)
-- Assurez-vous d'utiliser des binaires valides pour les images dans votre implémentation réelle
INSERT INTO animal_image (animal_id, image) VALUES
(1, LOAD_FILE('path/to/animal1.jpg')),
(2, LOAD_FILE('path/to/animal2.jpg')),
(3, LOAD_FILE('path/to/animal3.jpg'));