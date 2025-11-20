<?php
requireAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyToken()) {
    $bookId = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
    $comment = trim(filter_input(INPUT_POST, 'comment'));
    $rating = $_POST['rating'] ?? 0;

    if ($bookId && $comment && $rating >= 1 && $rating <= 5) {
        require_once __DIR__ . '/../database.php';
        require_once __DIR__ . '/../models/books.php';
        require_once __DIR__ . '/../models/functions.php';

        $userId = $_SESSION['user']['id'];

        // Verificar si ya existe reseña
        $stmt = $db->prepare("SELECT id FROM comments WHERE user_id = ? AND book_id = ?");
        $stmt->execute([$userId, $bookId]);
        $existing = $stmt->fetch();

        if ($existing) {
            header('Location: /view-book/' . $bookId . '?error=already_commented');
            exit;
        }

        // Insertar reseña con rating
        if (addComment($db, $bookId, $userId, $comment, $rating)) {
            header('Location: /view-book/' . $bookId . '?success=review_added');
        } else {
            header('Location: /view-book/' . $bookId . '?error=review_add');
        }
    } else {
        header('Location: /view-book/' . $bookId . '?error=invalid');
    }
    exit;
}
header('Location: /books');
