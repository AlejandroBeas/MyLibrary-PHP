    <?php
require 'config.php';
require 'database.php';
require 'helper.php';

// Conectar a la base de datos
try {
    $db = dbConnect();
} catch (Exception $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Obtener la ruta desde la URL
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
$segments = explode('/', $uri);

$route = $segments[0] ?? 'home';
if ($route === '') {
    $route = 'home';
}

if (count($segments) > 1) {
    $_GET['params'] = array_slice($segments, 1);
}

$controller = $route . 'controller';

$controllerPath = "controllers/{$controller}.php";
if (file_exists($controllerPath)) {
    require $controllerPath;
} else {
    http_response_code(404);
    require 'views/404.view.php';
}