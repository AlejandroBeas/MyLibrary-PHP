<?php
requireAuth();

$params = $_GET['params'] ?? [];
$id = $params[0] ?? null;
if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
    header('Location: /books?error=invalid');
    exit;
}

require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../models/books.php';
require_once __DIR__ . '/../models/functions.php';

$book = getBookById($db, $id);
if (!$book) {
    header('Location: /books?error=notfound');
    exit;
}

$averageData = getAverageRating($db, $book['id']);
$averageRating = $averageData['avg_rating'];
$totalReviews = $averageData['total_reviews'];

// Cargar comentarios
$comments = getCommentsByBookId($db, $id);

include __DIR__ . '/../views/book_detail.view.php';