<?php
// app/model/Project.php

// Définition de l'espace de noms pour cette classe
namespace App\Model;

// Inclusion du fichier db.php pour accéder aux constantes de connexion à la base de données
include_once 'db.php';

class Project {

    // Méthode pour créer un nouveau projet
    public function create($title, $description, $adminId) {
        // Obtention de l'instance de la connexion à la base de données
        $pdo = Database::getInstance()->getConnection();

        // Préparation de la requête SQL pour insérer un nouveau projet
        $stmt = $pdo->prepare("INSERT INTO Projet (Titre, Description, ID_Administrateur) VALUES (:title, :description, :adminId)");
        // Exécution de la requête avec les paramètres fournis
        return $stmt->execute(['title' => $title, 'description' => $description, 'adminId' => $adminId]);
    }

    // Méthode pour obtenir les détails d'un projet par son ID
    public function getProjectById($projectId) {
        $pdo = Database::getInstance()->getConnection();
    
        $stmt = $pdo->prepare("SELECT * FROM Projet WHERE ID_Projet = :projectId");
        $stmt->execute(['projectId' => $projectId]);
    
        // Retourne le projet trouvé
        return $stmt->fetch();
    }

    // Méthode pour mettre à jour les détails d'un projet
    public function update($projectId, $title, $description) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare("UPDATE Projet SET Titre = :title, Description = :description WHERE ID_Projet = :projectId");
        return $stmt->execute(['title' => $title, 'description' => $description, 'projectId' => $projectId]);
    }

    // Méthode pour supprimer un projet
    public function delete($projectId) {
        $pdo = Database::getInstance()->getConnection();
    
        // Supprimez d'abord les enregistrements dépendants (participation et tâches associées au projet)
        $stmt = $pdo->prepare("DELETE FROM participation WHERE ID_Projet = :projectId");
        $stmt->execute(['projectId' => $projectId]);

        $stmt = $pdo->prepare("DELETE FROM tâche WHERE ID_Projet = :projectId");
        $stmt->execute(['projectId' => $projectId]);
    
        // Ensuite, supprimez le projet lui-même
        $stmt = $pdo->prepare("DELETE FROM Projet WHERE ID_Projet = :projectId");
        $stmt->execute(['projectId' => $projectId]);
    }
}
?>
