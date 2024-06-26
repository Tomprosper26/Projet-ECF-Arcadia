<?php

require_once "../app/MongoDB/AnimalViewsDAO.php";
session_start();

class DashboardController {

    private $viewsDAO;

    public function __construct() {
        $this->viewsDAO = new AnimalMongoDAO();
    }

    public function render() {
        $title = 'Arcadia-Admin-Dashboard';
        $animals = $this->viewsDAO->getAllAnimalsWithViews();

        usort($animals, function($a, $b) {
            return $b['views'] - $a['views'];
        });
        include "../views/dashboard.php";
    }

}