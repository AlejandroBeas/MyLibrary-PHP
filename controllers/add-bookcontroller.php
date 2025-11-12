<?php
requireAuth();
require_once __DIR__ . '/../database.php'; // Asegúrate de tener una conexión PDO en este archivo

session_start();

// Validar token CSRF
if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
    http_response_code(403);
    echo "Acceso no autorizado.";
    exit;
}

// Recoger y sanitizar datos del formulario
$id          = isset($_POST['id']) ? intval($_POST['id']) : null;
$title       = trim($_POST['title']);
$author      = trim($_POST['author']);
$publishDate = $_POST['year'];
$ageGroup    = $_POST['age_group'];
$synopsis    = trim($_POST['synopsis']);

// Validación básica
if (!$title || !$author || !$publishDate || !$ageGroup || !$synopsis) {
    $_SESSION['error'] = "Todos los campos son obligatorios.";
    header("Location: /books");
    exit;
}

try {

    if ($id) {
        // Actualizar libro existente
        $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, publish_date = ?, age_group = ?, synopsis = ? WHERE id = ?");
        $stmt->execute([$title, $author, $publishDate, $ageGroup, $synopsis, $id]);
        $_SESSION['success'] = "Libro actualizado correctamente.";
    } else {
        // Insertar nuevo libro
        $stmt = $pdo->prepare("INSERT INTO books (title, author, publish_date, age_group, synopsis) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $author, $publishDate, $ageGroup, $synopsis]);
        $_SESSION['success'] = "Libro guardado correctamente.";
    }

    header("Location: /books");
    exit;

} catch (PDOException $e) {
    error_log("Error al guardar el libro: " . $e->getMessage());
    $_SESSION['error'] = "Hubo un problema al guardar el libro.";
    header("Location: /books");
    exit;
}
