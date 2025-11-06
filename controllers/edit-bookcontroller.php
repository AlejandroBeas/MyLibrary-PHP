<?php
requireAuth();
require_once __DIR__ . '/../models/books.php';

$id = $_GET['params'][0] ?? null;
$book = null;

if ($id) {
    $book = getBook($db, $id);
    if (!$book) {
        header('Location: /books');
        exit;
    }
}

require __DIR__ . '/../views/book_form.view.php';