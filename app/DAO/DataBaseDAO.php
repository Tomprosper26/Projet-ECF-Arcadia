<?php

require_once '../app/config.php';

class DataBase {
    protected $pdo;

    public function __construct() {
        $this->pdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
    }
}
?>