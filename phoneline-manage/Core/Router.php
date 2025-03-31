<?php
namespace Core;

class Router {
    private static $routes = [];

    public static function loadRoutes() {
        self::$routes = require __DIR__ . '/../App/routes.php';
    }

    public static function dispatch() {
        self::loadRoutes(); // Charger les routes

        $url = $_SERVER['REQUEST_URI'];
        $url = strtok($url, '?');
        $url = '/' . trim($url, '/');
    
        // Vérifier les routes statiques
        if (array_key_exists($url, self::$routes)) {
            [$controllerClass, $method] = self::$routes[$url];  
            if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
                $controller = new $controllerClass();
                $controller->$method();
                return;
            }
        }
    
        // Vérifier les routes dynamiques (ex: /stagiaire/modifier/12)
        foreach (self::$routes as $route => [$controllerClass, $method]) {
            $routePattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([^/]+)', $route);
            if (preg_match("#^$routePattern$#", $url, $matches)) {
                array_shift($matches); // Supprime le premier élément (l'URL entière)
                $controller = new $controllerClass();
                call_user_func_array([$controller, $method], $matches);
                return;
            }
        }
    
        http_response_code(404);
        echo "Erreur 404 - Page non trouvée.";
    }
}
