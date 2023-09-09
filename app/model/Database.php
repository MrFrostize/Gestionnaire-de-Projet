<?php

namespace App\Model;

use PDO;
use PDOException;

class Database {
    // Instance unique de la classe Database (pattern Singleton)
    private static $instance = null;

    // Objet de connexion PDO
    private $connection;

    // Constructeur privé pour empêcher la création d'une nouvelle instance via le mot-clé 'new'
    private function __construct() {
        try {
            // Établissement de la connexion à la base de données
            $this->connection = new PDO(DB_DSN, DB_USER, DB_PASS);
            // Configuration de PDO pour lancer des exceptions en cas d'erreur
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Arrêt du script et affichage de l'erreur si la connexion échoue
            die("Erreur de connexion: " . $e->getMessage());
        }
    }

    // Méthode pour obtenir l'instance unique de la classe
    public static function getInstance() {
        // Si l'instance n'existe pas encore, la créer
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        // Retourner l'instance unique
        return self::$instance;
    }

    // Méthode pour obtenir l'objet de connexion PDO
    public function getConnection() {
        return $this->connection;
    }

    // Méthode privée pour empêcher le clonage de l'instance (pattern Singleton)
    private function __clone() { }

    // Méthode pour empêcher la désérialisation et garantir qu'une seule instance est utilisée
    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}
