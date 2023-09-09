<?php

namespace Core;

class Router {
    // Tableau pour stocker les routes (URLs) et leurs contrôleurs/méthodes associés
    private $routes = [];

    /**
     * Ajoute une route à la table de routage.
     * 
     * @param string $url - L'URL de la route.
     * @param string $controller - Le nom du contrôleur associé à l'URL.
     * @param string $method - La méthode du contrôleur à appeler.
     */
    public function add($url, $controller, $method) {
        $this->routes[$url] = ['controller' => $controller, 'method' => $method];
    }

    /**
     * Traite l'URL demandée, trouve le contrôleur et la méthode associés,
     * et exécute cette méthode.
     */
    public function dispatch() {
        $url = $this->parseUrl();
    
        foreach ($this->routes as $route => $info) {
            if ($route === $url) {
                $controllerName = $info['controller'];
                $methodName = $info['method'];
    
                // Inclure le fichier du contrôleur
                require_once '../app/controller/' . $controllerName . '.php';
    
                // Vérifie si le contrôleur existe
                if (!class_exists("\\App\\Controller\\" . $controllerName)) {
                    die("Contrôleur non trouvé.");
                }
    
                $controller = new ("\\App\\Controller\\" . $controllerName)();
                $controller->$methodName();
                return;
            }
        }
    
        // Si aucune route ne correspond, affichez une erreur 404
        echo "404 Page non trouvée";
    }
    
    /**
     * Analyse l'URL pour obtenir le chemin sans les paramètres GET.
     * 
     * @return string - L'URL analysée.
     */
    private function parseUrl() {
        $url = $_SERVER['REQUEST_URI'];
        $url = strtok($url, '?'); // Supprime les paramètres GET
        $parsedUrl = rtrim($url, '/'); // Supprime le slash final
    
        // Si l'URL est vide, retournez '/'
        if (empty($parsedUrl)) {
            return '/';
        }
    
        return $parsedUrl;
    }
    
}
