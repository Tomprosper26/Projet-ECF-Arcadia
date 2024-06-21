<?php

require_once "../app/DAO/RapportDAO.php";
session_start();

class AdminRapportController {

    private $rapportDAO;

    public function __construct() {
        $this->rapportDAO = new RapportDAO();
    }

    public function render() {
        $title = 'Arcadia-Admin-Rapport';
        $rapports = $this->rapportDAO->getAllRapportDetails();
        $rapportDetailsJson = json_encode($rapports);
        include "../views/adminRapport.php";
    }

}