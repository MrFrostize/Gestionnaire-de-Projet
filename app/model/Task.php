<?php
// app/model/Task.php

// Définition de l'espace de noms pour cette classe
namespace App\Model;

// Inclusion du fichier db.php pour accéder aux constantes de connexion à la base de données
include_once 'db.php';

class Task {

    // Méthode pour créer une nouvelle tâche
    public function create($title, $description, $priority, $status, $projectId, $userId) {
        $pdo = Database::getInstance()->getConnection();
    
        // Préparation de la requête SQL pour insérer une nouvelle tâche
        $stmt = $pdo->prepare("INSERT INTO Tâche (Titre, Description, Priorité, Statut, ID_Utilisateur, ID_Projet) VALUES (:title, :description, :priority, :status, :userId, :projectId)");
        return $stmt->execute([
            'title' => $title,
            'description' => $description,
            'priority' => $priority,
            'status' => $status,
            'userId' => $userId,
            'projectId' => $projectId
        ]);
    }

    // Méthode pour mettre à jour la priorité d'une tâche
    public function updatePriority($taskId, $priority) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE Tâche SET Priorité = :priority WHERE ID_Tâche = :taskId");
        return $stmt->execute(['priority' => $priority, 'taskId' => $taskId]);
    }

    // Méthode pour mettre à jour le statut d'une tâche
    public function updateStatus($taskId, $status) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE Tâche SET Statut = :status WHERE ID_Tâche = :taskId");
        return $stmt->execute(['status' => $status, 'taskId' => $taskId]);
    }

    // Méthode pour mettre à jour un attribut spécifique d'une tâche
    public function updateAttribute($taskId, $attribute, $value) {
        $pdo = Database::getInstance()->getConnection();
    
        $stmt = $pdo->prepare("UPDATE Tâche SET $attribute = :value WHERE ID_Tâche = :taskId");
        return $stmt->execute(['value' => $value, 'taskId' => $taskId]);
    }

    // Méthode pour obtenir les détails d'une tâche par son ID
    public function getTaskById($taskId) {
        $pdo = Database::getInstance()->getConnection();
    
        $stmt = $pdo->prepare("SELECT * FROM Tâche WHERE ID_Tâche = :taskId");
        $stmt->execute(['taskId' => $taskId]);
    
        // Renvoyer les données sous forme d'objet
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    // Méthode pour mettre à jour les détails d'une tâche
    public function update($taskId, $title, $description, $priority, $status) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare("UPDATE Tâche SET Titre = :title, Description = :description, Priorité = :priority, Statut = :status WHERE ID_Tâche = :taskId");
        return $stmt->execute(['title' => $title, 'description' => $description, 'priority' => $priority, 'status' => $status, 'taskId' => $taskId]);
    }

    // Méthode pour supprimer une tâche
    public function delete($taskId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM Tâche WHERE ID_Tâche = :taskId");
        $stmt->execute(['taskId' => $taskId]);
    }
}
?>
