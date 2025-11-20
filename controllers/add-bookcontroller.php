<?php
requireAuth();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../models/functions.php';
require_once __DIR__ . '/../models/books.php';
require_once __DIR__ . '/../models/functions.php';

$genres = readGenres($db);
$genresStr = "";
file_put_contents(__DIR__ . '/../data/Genres.json', json_encode($genres, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Para añadir libro (GET), no hay $book, así que pasamos null
$book = null;  // Agrega esto para que la vista sepa que es añadir

include __DIR__ . '/../views/book_form.view.php';

// El resto solo se ejecuta si es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar token CSRF
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        http_response_code(403);
        echo "Acceso no autorizado.";
        exit;
    }

    // Recoger y sanitizar datos del formulario
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $publishDate = $_POST['year'] ?? '';  // String, no array
    $ageGroup = $_POST['age_group'] ?? '';  // String, no array
    $BookGenres = $_POST['genre'] ?? [];
    $synopsis = trim($_POST['synopsis']);

    // Construir string de géneros
    $genresStr = "";
    foreach ($BookGenres as $genre) {
        $genresStr .= $genre . "; ";  // $genre es string, no array
    }
    $genresStr = rtrim($genresStr, "; ");

    // Validación básica
    if (!$title || !$author || !$publishDate || !$ageGroup || !$synopsis || empty($BookGenres)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: /books");
        exit;
    }

    try {
        if ($id) {
            // Actualizar libro existente (pero este controlador es para añadir; si quieres editar aquí, ajusta)
            $stmt = $db->prepare("UPDATE books SET title = ?, author = ?, publish_date = ?, age_group = ?, genre = ?, synopsis = ? WHERE id = ?");
            $stmt->execute([$title, $author, $publishDate, $ageGroup, $genresStr, $synopsis, $id]);
            $_SESSION['success'] = "Libro actualizado correctamente.";
        } else {
            // Añadir nuevo libro
            if (addBook($db, $title, $author, $publishDate, $ageGroup, $genresStr, $synopsis)) {
                $_SESSION['success'] = "Libro guardado correctamente.";
            } else {
                $_SESSION['error'] = "Error al guardar el libro.";
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
}