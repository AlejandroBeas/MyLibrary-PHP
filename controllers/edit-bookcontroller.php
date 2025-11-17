<?php
requireAuth();
require_once __DIR__ . '/../database.php';  // Asegúrate de incluir la BD si no está global
require_once __DIR__ . '/../models/books.php';
require_once __DIR__ . '/../models/functions.php';

$id = $_GET['params'][0] ?? null;
$book = null;
$genres = readGenres($db);  // <-- Agrega esta línea para cargar géneros

if ($id) {
    $book = getBookById($db, $id);  // Usa getBookById en lugar de getBook (asume que existe)
    if (!$book) {
        header('Location: /books');
        exit;
    }
}

require __DIR__ . '/../views/book_form.view.php';