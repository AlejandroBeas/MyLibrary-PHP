<?php
requireAuth();

$user = $_SESSION['user'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyToken()) {
    $name = trim(filter_input(INPUT_POST, 'name'));
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $preferencias = $_POST['Preferencias'] ?? [];
    $current_password = filter_input(INPUT_POST, 'current_password');
    $new_password = filter_input(INPUT_POST, 'new_password');
    $confirm_password = filter_input(INPUT_POST, 'confirm_password');

    // 🔹 Actualizar nombre
    if ($name && $name !== $user['name']) {
        $stmt = $db->prepare("UPDATE users SET name = ? WHERE id = ?");
        if ($stmt->execute([$name, $user['id']])) {
            $_SESSION['user']['name'] = $name;
            $success = "Nombre actualizado correctamente";
        } else {
            $error = "Error al actualizar el nombre";
        }
    }

    // 🔹 Actualizar email
    if ($email && $email !== $user['email']) {
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $stmt->execute([$email, $user['id']]);
        if ($stmt->fetch()) {
            $error = "Este email ya está en uso por otro usuario.";
        } else {
            $stmt = $db->prepare("UPDATE users SET email = ? WHERE id = ?");
            if ($stmt->execute([$email, $user['id']])) {
                $_SESSION['user']['email'] = $email;
                $success = $success ? $success . " y email actualizado" : "Email actualizado correctamente";
            } else {
                $error = "Error al actualizar el email";
            }
        }
    }

    // 🔹 Actualizar gustos / preferencias
    if ($preferencias && $preferencias !== $user['Preferencias']) {
        $stmt = $db->prepare("UPDATE users SET Preferencias = ? WHERE id = ?");
        if ($stmt->execute([$preferencias, $user['id']])) {
            $_SESSION['user']['Preferencias'] = $preferencias;
            $success = $success ? $success . " y gustos actualizados" : "Gustos actualizados correctamente";
        } else {
            $error = "Error al actualizar los gustos";
        }
    }

    // 🔹 Actualizar contraseña
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

    $user = $_SESSION['user']; // refrescar datos
}

require __DIR__ . '/../views/profile.view.php';
