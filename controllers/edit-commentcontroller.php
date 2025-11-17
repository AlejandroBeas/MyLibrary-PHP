<?php
requireAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyToken()) {
    $commentId = filter_input(INPUT_POST, 'comment_id', FILTER_VALIDATE_INT);
    $comment = trim(filter_input(INPUT_POST, 'comment'));
    $bookId = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);  // <-- Mueve esto aquí, fuera del if
    
    if ($commentId && $comment && $bookId) {  // <-- Agrega $bookId a la validación
        require_once __DIR__ . '/../database.php';
        require_once __DIR__ . '/../models/books.php';
        require_once __DIR__ . '/../models/functions.php';
        
        
        if (updateComment($db, $commentId, $_SESSION['user']['id'], $comment)) {
            header('Location: /view-book/' . $bookId . '?success=comment_edited');
        } else {
            header('Location: /view-book/' . $bookId . '?error=comment_edit');
        }
    } else {
        // Si $bookId no está definido, redirige a books
        $redirectId = $bookId ?? null;
        header('Location: /view-book/' . ($redirectId ?: '') . '?error=invalid');
    }
    exit;
}
header('Location: /books');
