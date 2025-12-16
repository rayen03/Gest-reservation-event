<?php
/**
 * Entry point 
 */


session_start();


error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASE_PATH', dirname(__DIR__));

$routes = require_once BASE_PATH . '/config/routes.php';

// Get  URI
$requestUri = $_SERVER['REQUEST_URI'];
$requestUri = strtok($requestUri, '?'); // Remove query string
$requestUri = trim($requestUri, '/');

// Default route
if (empty($requestUri)) {
    $requestUri = 'events';
}

// Find  route
if (isset($routes[$requestUri])) {
    $route = $routes[$requestUri];
    $controllerName = $route['controller'];
    $actionName = $route['action'];

    $controllerPath = BASE_PATH . '/app/controllers/' . $controllerName . '.php';
    
    if (file_exists($controllerPath)) {
        require_once $controllerPath;
  
        $controller = new $controllerName();

        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            http_response_code(404);
            echo "<h1>404 - Action not found</h1>";
            echo "<p>Action '{$actionName}' not found in controller '{$controllerName}'</p>";
        }
    } else {
        http_response_code(404);
        echo "<h1>404 - Controller not found</h1>";
        echo "<p>Controller file not found: {$controllerPath}</p>";
    }
} else {
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
    echo "<p>The requested page '{$requestUri}' does not exist.</p>";
    echo "<a href='/events'>Return to events</a>";
}
?>
