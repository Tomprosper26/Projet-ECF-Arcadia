<?php

class ContactController {

    public function __construct() {

    }

    public function render() {
        $title = 'Arcadia-Contact';
        include "../views/contact.php";
    }

}