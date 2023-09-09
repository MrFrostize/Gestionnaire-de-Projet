<?php

// Inclusion de la classe Database pour pouvoir l'utiliser
include_once __DIR__ . '/Database.php';

// Définition des constantes pour la connexion à la base de données

// Hôte de la base de données (par exemple, localhost avec un port spécifique)
define('DB_HOST', 'localhost:8889');

// Nom de la base de données
define('DB_NAME', 'gestion');

// Nom d'utilisateur pour se connecter à la base de données
define('DB_USER', 'diginamic');

// Mot de passe pour se connecter à la base de données
define('DB_PASS', 'diginamic');

// Jeu de caractères à utiliser lors de la connexion à la base de données
define('DB_CHARSET', 'utf8mb4');

// Chaîne DSN (Data Source Name) pour PDO, qui contient les informations nécessaires pour se connecter à la base de données
define('DB_DSN', "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET);

?>
