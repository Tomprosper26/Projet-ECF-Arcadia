<?php

// renseigner ici vos informations de connection a la Base de Donnée :

define('DB_DSN', 'mysql:host=localhost;dbname=zoo');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '0000');
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);