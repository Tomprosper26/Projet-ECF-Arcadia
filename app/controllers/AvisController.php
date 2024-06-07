<?php

require_once "../app/DAO/AvisDAO.php";

class AvisController {

    private $avisDAO;

    public function __construct() {
        $this->avisDAO = new AvisDAO();
    }

    public function render() {
        $title = 'Arcadia-Avis';
        include "../views/Avis.php";
    }

}