<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    
    if ($email && $password && verifyToken()) {
        if (authenticate($db, $email, $password)) {
            header('Location: /books');
            exit;
        } else {
            $error = "Credenciales incorrectas";
        }
    } else {
        $error = "Datos del formulario inválidos";
    }
}

require __DIR__ . '/../views/login.view.php';