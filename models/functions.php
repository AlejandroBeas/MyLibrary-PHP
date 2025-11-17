<?php


function readGenres($db) {
    try {
        $stmt = $db->query("SELECT genre FROM genres");  // Asume tabla 'genres' con columna 'genre'
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error reading genres: " . $e->getMessage());
        return [];
    }
}
// Obtener comentarios de un libro
function getCommentsByBookId($db, $bookId) {
    try {
        // Quita el JOIN para probar
        $stmt = $db->prepare("
            SELECT c.id, c.comment, c.created_at, c.user_id, u.name AS username
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.book_id = ?
            ORDER BY c.created_at DESC
        ");
        $stmt->execute([$bookId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting comments: " . $e->getMessage());
        return [];
    }
}

// Agregar comentario
function addComment($db, $bookId, $userId, $comment) {
    try {
        $stmt = $db->prepare("INSERT INTO comments (book_id, user_id, comment) VALUES (?, ?, ?)");
        return $stmt->execute([$bookId, $userId, $comment]);
    } catch (PDOException $e) {
        error_log("Error adding comment: " . $e->getMessage());
        return false;
    }
}

// Editar comentario (solo si es del usuario)
function updateComment($db, $commentId, $userId, $comment) {
    try {
        $stmt = $db->prepare("UPDATE comments SET comment = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ? AND user_id = ?");
        return $stmt->execute([$comment, $commentId, $userId]);
    } catch (PDOException $e) {
        error_log("Error updating comment: " . $e->getMessage());
        return false;
    }
}

// Eliminar comentario (solo si es del usuario)
function deleteComment($db, $commentId, $userId) {
    try {
        $stmt = $db->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
        return $stmt->execute([$commentId, $userId]);
    } catch (PDOException $e) {
        error_log("Error deleting comment: " . $e->getMessage());
        return false;
    }
}