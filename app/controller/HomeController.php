<?php

namespace App\Controller;

class HomeController {

    // Méthode pour afficher la page d'accueil
    public function index() {
        // Inclut le fichier de vue pour la page d'accueil
        require_once '../app/view/home/index.php';
    }

}

?>
