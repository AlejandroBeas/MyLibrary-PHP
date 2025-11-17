<?php
requireAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyToken()) {
    $bookId = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
    $comment = trim(filter_input(INPUT_POST, 'comment'));
    
    if ($bookId && $comment) {
        require_once __DIR__ . '/../database.php';
        require_once __DIR__ . '/../models/books.php';
        require_once __DIR__ . '/../models/functions.php';
        if (addComment($db, $bookId, $_SESSION['user']['id'], $comment)) {
            header('Location: /view-book/' . $bookId . '?success=comment_added');
        } else {
            header('Location: /view-book/' . $bookId . '?error=comment_add');
        }
    } else {
        header('Location: /view-book/' . $bookId . '?error=invalid');
    }
    exit;
}
header('Location: /books');