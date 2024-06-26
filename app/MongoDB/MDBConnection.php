<?php
require __DIR__ . '/../../vendor/autoload.php';

use MongoDB\Driver\ServerApi;

use MongoDB\Client;

class MongoDBConnection {
    private $client;
    private $db;

    public function __construct() {
        $uri = 'mongodb+srv://tomprosper:Bv1tPjxw2dS3mL3q@arcadiazoo.5xfv2yl.mongodb.net/?appName=ArcadiaZoo';
        
        $options = [
            'serverSelectionTimeoutMS' => 5000,
        ];

        try {
            $this->client = new Client($uri, [], $options);
            $this->db = $this->client->selectDatabase('ArcadiaZoo'); 
        } catch (Exception $e) {
            echo 'Erreur de connexion à MongoDB ' . $e->getMessage();
            exit();
        }
    }

    public function getDB() {
        return $this->db;
    }
}
?>

