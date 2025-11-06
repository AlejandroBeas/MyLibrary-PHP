<?php

function router(array $routes): string {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, '/');
    $segments = explode('/', $uri);
    
    $route = $segments[0] ?? 'home';
    if ($route === '') {
        $route = 'home';
    }
    
    // Manejo de parámetros
    if (count($segments) > 1) {
        $_GET['params'] = array_slice($segments, 1);
    }
    
    // Si la ruta no existe, mostrar 404
    if (!in_array($route, $routes)) {
        http_response_code(404);
        require __DIR__ . '/views/404.view.php';
        exit;
    }
    
    return $route . 'controller';
}

function dd($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}