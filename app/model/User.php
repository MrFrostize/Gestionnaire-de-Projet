<?php
namespace App\Model;

use App\Model\Database;
include_once 'db.php';

class User {

    // Méthode pour enregistrer un nouvel utilisateur
    public function register($nom, $prenom, $email, $password) {
        $pdo = Database::getInstance()->getConnection();

        // Vérification si l'email existe déjà
        $stmt = $pdo->prepare("SELECT * FROM Utilisateur WHERE Email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            return ['status' => false, 'message' => "L'email est déjà utilisé!"];
        }

        // Hashage du mot de passe pour la sécurité
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertion du nouvel utilisateur dans la base de données
        $stmt = $pdo->prepare("INSERT INTO Utilisateur (Nom, Prénom, Email, Mot_de_passe) VALUES (:nom, :prenom, :email, :password)");
        $success = $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'password' => $hashedPassword]);

        if ($success) {
            return ['status' => true];
        } else {
            return ['status' => false, 'message' => "Erreur lors de l'inscription."];
        }
    }

    // Méthode pour connecter un utilisateur
    public function login($email, $password) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare("SELECT * FROM Utilisateur WHERE Email = :email");
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch();

        // Vérification du mot de passe
        if ($user && password_verify($password, $user['Mot_de_passe'])) {
            return ['status' => true, 'user_id' => $user['ID_Utilisateur']];
        } else {
            return ['status' => false, 'message' => "Email ou mot de passe incorrect."];
        }
    }

    // Méthode pour obtenir les projets d'un utilisateur
    public function getUserProjects($userId) {
        $pdo = Database::getInstance()->getConnection();
    
        // Requête pour obtenir les projets créés par l'utilisateur
        $createdProjectsQuery = "SELECT p.* FROM Projet p WHERE p.ID_Administrateur = :userId";
    
        // Requête pour obtenir les projets auxquels l'utilisateur participe
        $participatedProjectsQuery = "SELECT p.* FROM Projet p JOIN Participation part ON p.ID_Projet = part.ID_Projet WHERE part.ID_Utilisateur = :userId";
    
        // Union des deux requêtes pour obtenir la liste complète des projets
        $finalQuery = $createdProjectsQuery . " UNION " . $participatedProjectsQuery;
    
        $stmt = $pdo->prepare($finalQuery);
        $stmt->execute(['userId' => $userId]);
    
        return $stmt->fetchAll();
    }

    // Méthode pour obtenir les projets et les tâches d'un utilisateur
    public function getUserProjectsAndTasks($userId) {
        $pdo = Database::getInstance()->getConnection();
    
        // Requête pour obtenir les projets et les tâches créés par l'utilisateur
        $createdProjectsAndTasksQuery = "SELECT p.*, t.* FROM Projet p LEFT JOIN Tâche t ON p.ID_Projet = t.ID_Projet WHERE p.ID_Administrateur = :userId";
    
        // Requête pour obtenir les projets et les tâches auxquels l'utilisateur participe
        $participatedProjectsAndTasksQuery = "SELECT p.*, t.* FROM Projet p JOIN Participation part ON p.ID_Projet = part.ID_Projet LEFT JOIN Tâche t ON p.ID_Projet = t.ID_Projet WHERE part.ID_Utilisateur = :userId";
    
        // Union des deux requêtes pour obtenir la liste complète des projets et des tâches
        $finalQuery = $createdProjectsAndTasksQuery . " UNION " . $participatedProjectsAndTasksQuery;
    
        $stmt = $pdo->prepare($finalQuery);
        $stmt->execute(['userId' => $userId]);
    
        return $stmt->fetchAll();
    }

    // Méthode pour vérifier si un utilisateur existe en fonction de son email
    public function exists($email) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT ID_Utilisateur FROM Utilisateur WHERE Email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn(); // Retourne l'ID de l'utilisateur s'il existe, sinon false
    }

    // Méthode pour créer un nouvel utilisateur
    public function create($nom, $prenom, $email, $password) {
        $pdo = Database::getInstance()->getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO Utilisateur (Nom, Prénom, Email, Mot_de_passe) VALUES (:nom, :prenom, :email, :password)");
        $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'password' => $hashedPassword]);
        return $pdo->lastInsertId(); // Retourne l'ID du nouvel utilisateur
    }

    // Méthode pour attacher un utilisateur à un projet en fonction de son email
    public function attachToProject($email, $projectId) {
        $userId = $this->exists($email);
        if ($userId) {
            $this->attachToProjectById($userId, $projectId);
        }
    }

    // Méthode pour attacher un utilisateur à un projet en fonction de son ID
    public function attachToProjectById($userId, $projectId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO Participation (ID_Utilisateur, ID_Projet) VALUES (:userId, :projectId)");
        $stmt->execute(['userId' => $userId, 'projectId' => $projectId]);
    }
}

?>
