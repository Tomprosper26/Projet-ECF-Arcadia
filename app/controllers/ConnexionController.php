<?php

require_once "../app/DAO/UsersDAO.php";

class ConnexionController {

    private $usersDAO;

    public function __construct() {
        $this->usersDAO = new UsersDAO();
    }

    public function render() {
        $title = 'Arcadia-Connexion';
        include "../views/connexion.php";
    }

}
