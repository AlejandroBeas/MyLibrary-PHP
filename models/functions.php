<?php


function readGenres($db) {
    try {
        $stmt = $db->query("SELECT genre FROM genres");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error reading genres: " . $e->getMessage());
        return [];
    }
}
function getAverageRating($db, $bookId) {
    $stmt = $db->prepare("SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews 
                          FROM comments 
                          WHERE book_id = ?");
    $stmt->execute([$bookId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getCommentsByBookId($db, $bookId) {
    try {
        $stmt = $db->prepare("
            SELECT c.id, c.comment, c.created_at, c.rating, c.user_id, u.name AS username
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

function addComment($db, $bookId, $userId, $comment, $rating) {
    try {
        $stmt = $db->prepare("INSERT INTO comments (book_id, user_id, comment, rating) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$bookId, $userId, $comment, $rating]);
    } catch (PDOException $e) {
        error_log("Error adding comment: " . $e->getMessage());
        return false;
    }
}

function updateComment($db, $commentId, $userId, $comment, $rating) {
    try {
        $stmt = $db->prepare("UPDATE comments SET comment = ?, rating = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ? AND user_id = ?");
        return $stmt->execute([$comment, $rating, $commentId, $userId]);
    } catch (PDOException $e) {
        error_log("Error updating comment: " . $e->getMessage());
        return false;
    }
}

function deleteComment($db, $commentId, $userId) {
    try {
        $stmt = $db->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
        return $stmt->execute([$commentId, $userId]);
    } catch (PDOException $e) {
        error_log("Error deleting comment: " . $e->getMessage());
        return false;
    }
}