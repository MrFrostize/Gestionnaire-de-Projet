<?php

namespace App\Controller;

use App\Model\User;

include_once __DIR__ . '/../model/User.php';

class UserController {

    // Affiche le formulaire d'inscription
    public function showRegisterForm() {
        include __DIR__ . '/../view/user/register.php';
    }

    // Traite l'inscription
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Valide les données
            if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
                echo "Tous les champs sont requis!";
                return;
            }

            // Vérifie le format de l'email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Format d'email invalide!";
                return;
            }

            // Tente d'enregistrer l'utilisateur
            $user = new User();
            $result = $user->register($nom, $prenom, $email, $password);

            // Redirige en fonction du résultat
            if ($result['status']) {
                header('Location: /login');
            } else {
                echo $result['message'];
            }
        }
    }

    // Affiche le formulaire de connexion
    public function showLoginForm() {
        include __DIR__ . '/../view/user/login.php';
    }

    // Traite la connexion
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $result = $user->login($email, $password);

            // Si la connexion est réussie, démarre une session et redirige
            if ($result['status']) {
                session_start();
                $_SESSION['user_id'] = $result['user_id'];
                header('Location: /project-management');
            } else {
                echo $result['message'];
            }
        }
    }

    // Ajoute un utilisateur à un projet
    public function addUserToProject() {
        $projectId = $_POST['project_id'];
        $userEmail = $_POST['user_email'];
        $userNom = $_POST['user_nom'];
        $userPrenom = $_POST['user_prenom'];
        $userPasswordDefault = $_POST['user_password_default'];

        $user = new User();
        if ($user->exists($userEmail)) {
            // Si l'utilisateur existe déjà, le rattache au projet
            $user->attachToProject($userEmail, $projectId);
        } else {
            // Sinon, crée un nouvel utilisateur et le rattache au projet
            $userId = $user->create($userNom, $userPrenom, $userEmail, $userPasswordDefault);
            $user->attachToProjectById($userId, $projectId);
        }

        header('Location: /my-projects');
    }

    // Déconnecte l'utilisateur
    public function logout() {
        session_start();
        session_destroy();
        header('Location: /home');
    }
}

?>
