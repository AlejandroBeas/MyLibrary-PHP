<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $name = $_POST['name'] ?? "";
    $UserLikes = $_POST['UserLikes'] ?? [];
    $dob = $_POST['dob'] ?? [];
    $password = filter_input(INPUT_POST, 'password');
    $confirm_password = filter_input(INPUT_POST, 'confirm_password');
    $likesStr = '';
    foreach ($UserLikes as $like){
        $likesStr .= $like . ";";
    }
    $ageCategory = '';

    if ($dob) {
        $birthDate = DateTime::createFromFormat('Y-m-d', $dob);
        $today = new DateTime();
        $age = $birthDate ? $birthDate->diff($today)->y : null;

        if ($age !== null) {
            if ($age < 13) {
                $ageCategory = 'Infantil';
            } elseif ($age < 18) {
                $ageCategory = 'Juvenil';
            } elseif ($age < 30) {
                $ageCategory = 'Adulto joven';
            } elseif ($age < 60) {
                $ageCategory = 'Adulto';
            } else {
                $ageCategory = 'Mayor';
            }
        }
    }

    if ($email && $password && $confirm_password && verifyToken()) {
        if (strlen($password) >= 6) {
            if ($password === $confirm_password) {
                if (registerUser($db, $email, $password, $name, $ageCategory, $likesStr)) {
                    $success = "Usuario registrado correctamente. Ahora puedes iniciar sesión.";
                } else {
                    $error = "Error al registrar el usuario. El email ya existe.";
                }
            } else {
                $error = "Las contraseñas no coinciden";
            }
        } else {
            $error = "La contraseña debe tener al menos 6 caracteres";
        }
    } else {
        $error = "Por favor, complete todos los campos correctamente";
    }
}

require __DIR__ . '/../views/register.view.php';