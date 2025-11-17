<?php
requireAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyToken()) {
    $commentId = filter_input(INPUT_POST, 'comment_id', FILTER_VALIDATE_INT);
    $bookId = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
    
    if ($commentId && $bookId) {
        require_once __DIR__ . '/../database.php';
        require_once __DIR__ . '/../models/books.php';
        require_once __DIR__ . '/../models/functions.php';
        
        if (deleteComment($db, $commentId, $_SESSION['user']['id'])) {
            header('Location: /view-book/' . $bookId . '?success=comment_deleted');
        } else {
            header('Location: /view-book/' . $bookId . '?error=comment_delete');
        }
    } else {
        header('Location: /view-book/' . $bookId . '?error=invalid');
    }
    exit;
}
header('Location: /books');