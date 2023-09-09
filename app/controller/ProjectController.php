<?php

namespace App\Controller;

use App\Model\User;
use App\Model\Project;
use App\Model\Task;
use App\Model\Database;

include_once __DIR__ . '/../model/Project.php';
include_once __DIR__ . '/../model/User.php';
include_once __DIR__ . '/../model/Task.php';

class ProjectController {

    // Cette fonction s'assure qu'une session est active. Si ce n'est pas le cas, elle démarre une session.
    private function ensureSessionStarted() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Affiche la page de gestion de projet
    public function showProjectManagementPage() {
        $this->ensureSessionStarted();

        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = new User();
        $projects = $user->getUserProjects($_SESSION['user_id']);

        include __DIR__ . '/../view/project/project-management.php';
    }

    // Crée un nouveau projet
    public function createProject() {
        $this->ensureSessionStarted();

        $project = new Project();
        $project->create($_POST['title'], $_POST['description'], $_SESSION['user_id']);

        header('Location: /project-management');
    }

    // Crée une nouvelle tâche pour un projet
    public function createTask() {
        $this->ensureSessionStarted();

        $task = new Task();
        $task->create($_POST['title'], $_POST['description'], $_POST['priority'], 'Non débuté', $_POST['projectId'], $_SESSION['user_id']);

        header('Location: /project-management');
    }

    // Affiche les projets de l'utilisateur
    public function showUserProjects() {
        $this->ensureSessionStarted();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = new User();
        $projects = $user->getUserProjects($_SESSION['user_id']);

        foreach ($projects as $index => $project) {
            $projectId = $project['ID_Projet'];
            $tasks = $this->getTasksByProjectId($projectId);
            $projects[$index]['tasks'] = $tasks;
            $projects[$index]['isAdmin'] = ($project['ID_Administrateur'] == $_SESSION['user_id']);
        }

        include __DIR__ . '/../view/project/projects-list.php';
    }

    // Récupère les tâches associées à un projet
    private function getTasksByProjectId($projectId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM Tâche WHERE ID_Projet = :projectId");
        $stmt->execute(['projectId' => $projectId]);
        return $stmt->fetchAll();
    }

    // Affiche les détails d'un projet
    public function showProjectDetails() {
        $this->ensureSessionStarted();

        $projectId = $_GET['id'];
        $project = new Project();
        $projectDetails = $project->getProjectById($projectId);

        include __DIR__ . '/../view/project/project-details.php';
    }

    // Ajoute une tâche à un projet
    public function addTaskToProject() {
        $this->ensureSessionStarted();

        $task = new Task();
        $task->create($_POST['title'], $_POST['description'], $_POST['priority'], 'Non débuté', $_POST['projectId'], $_SESSION['user_id']);

        header('Location: /my-projects');
    }

    // Affiche le formulaire pour ajouter des utilisateurs à un projet
    public function showAddUsersForm() {
        $this->ensureSessionStarted();

        $projectId = $_GET['id'];

        $project = new Project();
        $projectDetails = $project->getProjectById($projectId);

        if ($_SESSION['user_id'] != $projectDetails['ID_Administrateur']) {
            echo "Vous n'avez pas les droits pour ajouter des utilisateurs à ce projet.";
            exit;
        }

        include_once __DIR__ . '../../view/project/add-users-form.php';
    }

    // Modifie un projet
    public function editProject() {
        $this->ensureSessionStarted();

        $projectId = $_GET['id'];
        $project = new Project();
        $projectDetails = $project->getProjectById($projectId);

        if ($_SESSION['user_id'] != $projectDetails['ID_Administrateur']) {
            echo "Vous n'avez pas les droits pour modifier ce projet.";
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $description = $_POST['description'];

            $project->update($projectId, $title, $description);
            header('Location: /my-projects');
        } else {
            include __DIR__ . '/../view/project/edit-project-form.php';
        }
    }

    // Supprime un projet
    public function deleteProject() {
        $this->ensureSessionStarted();

        $projectId = $_GET['id'];
        $project = new Project();
        $projectDetails = $project->getProjectById($projectId);

        if ($_SESSION['user_id'] != $projectDetails['ID_Administrateur']) {
            echo "Vous n'avez pas les droits pour supprimer ce projet.";
            exit;
        }

        $project->delete($projectId);
        header('Location: /my-projects');
    }

    // Modifie une tâche
    public function editTask() {
        $this->ensureSessionStarted();

        $taskId = $_GET['id'];
        $taskModel = new Task();
        $taskDetails = $taskModel->getTaskById($taskId);

        $project = new Project();
        $projectDetails = $project->getProjectById($taskDetails->ID_Projet);

        if ($_SESSION['user_id'] != $projectDetails['ID_Administrateur']) {
            echo "Vous n'avez pas les droits pour modifier cette tâche.";
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $priority = $_POST['priority'];
            $status = $_POST['status'];

            $taskModel->update($taskId, $title, $description, $priority, $status);
            header('Location: /my-projects');
        } else {
            $task = $taskDetails;
            include __DIR__ . '/../view/project/edit-task.php';
        }
    }

    // Supprime une tâche
    public function deleteTask() {
        $this->ensureSessionStarted();

        $taskId = $_GET['id'];
        $task = new Task();
        $taskDetails = $task->getTaskById($taskId);

        $project = new Project();
        $projectDetails = $project->getProjectById($taskDetails['ID_Projet']);

        if ($_SESSION['user_id'] != $projectDetails['ID_Administrateur']) {
            echo "Vous n'avez pas les droits pour supprimer cette tâche.";
            exit;
        }

        $task->delete($taskId);
        header('Location: /my-projects');
    }

    // Met à jour une tâche
    public function updateTask() {
        $this->ensureSessionStarted();

        $taskId = $_POST['task_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];

        $task = new Task();
        $task->update($taskId, $title, $description, $priority, $status);

        header('Location: /my-projects');
    }
}

?>
