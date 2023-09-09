<?php

namespace App\Controller;

use App\Model\Task;

include_once __DIR__ . '/../model/Task.php';

class TaskController {

    // Cette fonction s'assure qu'une session est active. Si ce n'est pas le cas, elle démarre une session.
    private function ensureSessionStarted() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Met à jour la priorité d'une tâche
    public function updatePriority() {
        $this->ensureSessionStarted();

        // Récupère les données envoyées en JSON
        $data = json_decode(file_get_contents("php://input"));

        // Vérifie si les données nécessaires sont présentes
        if (!isset($data->taskId, $data->priority)) {
            echo json_encode(['success' => false, 'message' => 'Données manquantes']);
            return;
        }

        $task = new Task();
        $success = $task->updatePriority($data->taskId, $data->priority);

        // Renvoie le résultat sous forme de JSON
        echo json_encode(['success' => $success]);
    }

    // Met à jour le statut d'une tâche
    public function updateStatus() {
        $this->ensureSessionStarted();

        // Récupère les données envoyées en JSON
        $data = json_decode(file_get_contents("php://input"));

        // Vérifie si les données nécessaires sont présentes
        if (!isset($data->taskId, $data->status)) {
            echo json_encode(['success' => false, 'message' => 'Données manquantes']);
            return;
        }

        $task = new Task();
        $success = $task->updateStatus($data->taskId, $data->status);

        // Renvoie le résultat sous forme de JSON
        echo json_encode(['success' => $success]);
    }

    // Met à jour un attribut spécifique d'une tâche
    public function updateTaskAttribute() {
        // Récupère les données envoyées en JSON
        $data = json_decode(file_get_contents("php://input"));

        $task = new Task();
        $success = $task->updateAttribute($data->taskId, $data->attribute, $data->value);

        // Renvoie le résultat sous forme de JSON
        echo json_encode(['success' => $success]);
    }
}

?>
