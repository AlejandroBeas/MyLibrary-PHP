<?php
session_start();

// Configuración de la base de datos
define('DB_CONNECTION', 'sqlite');  
define('DB_SQLITE_PATH', __DIR__ . '/db/db.sqlite');
define('DB_HOST', 'localhost');
define('DB_NAME', 'mylibrary');
define('DB_USER', 'root');
define('DB_PASS', '');

define('APP_NAME', 'My Library');
define('APP_VERSION', '1.0');

$routes = [
    'home', 'books', 'login', 'logout', 'register', 'auth',
    'add-book', 'edit-book', 'delete-book', 'save-book', 'book_form'
];

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = null;
}
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}