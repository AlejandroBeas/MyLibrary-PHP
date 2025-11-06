<?php
requireAuth();

$user = $_SESSION['user'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyToken()) {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $current_password = filter_input(INPUT_POST, 'current_password');
    $new_password = filter_input(INPUT_POST, 'new_password');
    $confirm_password = filter_input(INPUT_POST, 'confirm_password');
    
    if ($email && $email !== $user['email']) {
        // Verificar si el nuevo email ya existe
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $stmt->execute([$email, $user['id']]);
        
        if ($stmt->fetch()) {
            $error = "Este email ya está en uso por otro usuario.";
        } else {
            // Actualizar email
            $stmt = $db->prepare("UPDATE users SET email = ? WHERE id = ?");
            if ($stmt->execute([$email, $user['id']])) {
                $_SESSION['user']['email'] = $email;
                $success = "Email actualizado correctamente";
            } else {
                $error = "Error al actualizar el email";
            }
        }
    }
    
    if ($new_password) {
        if ($current_password && password_verify($current_password, $user['password'])) {
            if ($new_password === $confirm_password) {
                if (strlen($new_password) >= 6) {
                    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                    $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
                    if ($stmt->execute([$hashedPassword, $user['id']])) {
                        $success = $success ? $success . " y contraseña actualizada" : "Contraseña actualizada correctamente";
                    } else {
                        $error = "Error al actualizar la contraseña";
                    }
                } else {
                    $error = "La nueva contraseña debe tener al menos 6 caracteres";
                }
            } else {
                $error = "Las nuevas contraseñas no coinciden";
            }
        } else {
            $error = "La contraseña actual es incorrecta";
        }
    }
    
    $user = $_SESSION['user']; // Actualizar datos
}

require __DIR__ . '/../views/profile.view.php';