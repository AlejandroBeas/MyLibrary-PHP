<?php
requireAuth();
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../models/functions.php';
require_once __DIR__ . '/../models/books.php';
$genres = readGenres($db);
$genresStr = "";
file_put_contents(__DIR__ . '/../data/Genres.json', json_encode($genres, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
include __DIR__ . '/../views/book_form.view.php';
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
$publishDate = $_POST['year'] ?? [];
$ageGroup    = $_POST['age_group'] ?? [];
$BookGenres = $_POST['genre'] ?? [];
var_dump($title, $author, $publishDate, $ageGroup, $BookGenres);
foreach ($BookGenres as $genre){
    $genresStr .= $genre["genre"] . "; ";
}
$synopsis    = trim($_POST['synopsis']);

// Validación básica.02

if (!$title || !$author || !$publishDate || !$ageGroup || !$synopsis || $BookdGenres) {
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
        if (addBook($db, $title, $author, $publishDate, $ageGroup, $synopsis, $genresStr)){
            $_SESSION['success'] = "Libro guardado correctamente.";
        } else {
            $_SESSION['error'] = $_SESSION['error'] . "AQUI";
            
        }
    }

    header("Location: /books");
    exit;

} catch (PDOException $e) {
    error_log("Error al guardar el libro: " . $e->getMessage());
    $_SESSION['error'] = "Hubo un problema al guardar el libro.";
    header("Location: /books");
    exit;
}
