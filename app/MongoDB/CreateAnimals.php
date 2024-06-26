<?php
require_once 'AnimalViewsDAO.php';


$animalViewsDAO = new AnimalMongoDAO();

$animals = [
    [
        'id' => 1,
        'prenom' => 'Leo',
        'views' => 0
    ],
    [
        'id' => 2,
        'prenom' => 'Simba',
        'views' => 0
    ],
    [
        'id' => 3,
        'prenom' => 'Nala',
        'views' => 0
    ],
    [
        'id' => 4,
        'prenom' => 'Mowgli',
        'views' => 0
    ],
    [
        'id' => 5,
        'prenom' => 'Baloo',
        'views' => 0
    ],
    [
        'id' => 6,
        'prenom' => 'Bagheera',
        'views' => 0
    ],
    [
        'id' => 7,
        'prenom' => 'Frodo',
        'views' => 0
    ],
    [
        'id' => 8,
        'prenom' => 'Gollum',
        'views' => 0
    ],
    [
        'id' => 9,
        'prenom' => 'Sam',
        'views' => 0
    ]
];

foreach ($animals as $animal) {
    $animalViewsDAO->insertAnimal($animal['id'], $animal['prenom']);
    echo "animal insérer avec succes";
}