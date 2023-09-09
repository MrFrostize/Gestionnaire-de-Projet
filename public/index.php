<?php

// Démarrage de la session pour gérer les données de session utilisateur
session_start();

// Inclusion du routeur principal pour gérer les routes de l'application
require_once '../core/Router.php';

// Inclusion de l'autoloader Composer pour charger automatiquement les classes nécessaires
require_once __DIR__ . '/../vendor/autoload.php';

// Instanciation de l'objet Router
$router = new \Core\Router();

// Définition des routes pour le HomeController
// Ces routes gèrent les pages principales de l'application
$router->add('/', 'HomeController', 'index');
$router->add('/home', 'HomeController', 'index');

// Définition des routes pour le UserController
// Ces routes gèrent l'authentification et la gestion des utilisateurs
$router->add('/login', 'UserController', 'showLoginForm');
$router->add('/register', 'UserController', 'showRegisterForm');
$router->add('/register-process', 'UserController', 'register');
$router->add('/login-process', 'UserController', 'login');
$router->add('/logout', 'UserController', 'logout');
$router->add('/process-add-users', 'UserController', 'addUserToProject');

// Définition des routes pour le ProjectController
// Ces routes gèrent les projets et leurs fonctionnalités associées
$router->add('/project-management', 'ProjectController', 'showProjectManagementPage');
$router->add('/create-project', 'ProjectController', 'createProject');
$router->add('/create-task', 'ProjectController', 'createTask');
$router->add('/add-task-to-project', 'ProjectController', 'addTaskToProject');
$router->add('/my-projects', 'ProjectController', 'showUserProjects');
$router->add('/project-details', 'ProjectController', 'showProjectDetails'); 
$router->add('/add-users-to-project', 'ProjectController', 'showAddUsersForm'); 
$router->add('/edit-project', 'ProjectController', 'editProject');
$router->add('/delete-project', 'ProjectController', 'deleteProject');
$router->add('/edit-task', 'ProjectController', 'editTask');
$router->add('/delete-task', 'ProjectController', 'deleteTask');
$router->add('/update-task', 'ProjectController', 'updateTask');

// Définition des routes pour le TaskController
// Ces routes gèrent les tâches et leurs fonctionnalités associées
$router->add('/update-task-priority', 'TaskController', 'updatePriority');
$router->add('/update-task-status', 'TaskController', 'updateStatus');
$router->add('/update-task-attribute', 'TaskController', 'updateTaskAttribute');

// Exécution du routeur pour traiter la requête actuelle et diriger vers le bon contrôleur
$router->dispatch();
?>
