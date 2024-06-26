<?php
require __DIR__ . '/../../app/MongoDB/MDBConnection.php';

class AnimalMongoDAO {
    private $db;

    public function __construct() {
        $mongoDBConnection = new MongoDBConnection();
        $this->db = $mongoDBConnection->getDB();
    }

    public function insertAnimal($id, $name) {
        $animalCollection = $this->db->animals; 
        $result = $animalCollection->insertOne([
            'id' => $id,
            'name' => $name,
            'viewCount' => 0
        ]);
        return $result->getInsertedId();
    }

    public function incrementViewCount($id) {
        $animalCollection = $this->db->animals;
        $result = $animalCollection->updateOne(
            ['id' => $id],
            ['$inc' => ['viewCount' => 1]]
        );
        return $result->getModifiedCount();
    }

    public function getAnimalById($id) {
        $animalCollection = $this->db->animals;
        return $animalCollection->findOne(['id' => $id]);
    }
}
?>
