<?php

function getAllBooks(PDO $db): array {
    $stmt = $db->query("SELECT id, title, author, publish_date FROM books ORDER BY id DESC");
    return $stmt->fetchAll();
}

function getBook(PDO $db, int $id): ?array {
    $stmt = $db->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}
function getBookById($db, $id) {
    try {
        $stmt = $db->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting book by ID: " . $e->getMessage());
        return false;
    }
}

function addBook($db, $title, $author, $year, $age_group, $genresStr, $synopsis) {
    try {
        // Agrega esto para debug
        error_log("Intentando añadir libro: title=$title, author=$author, year=$year, age_group=$age_group, genres=$genresStr, synopsis=$synopsis");
        
        $stmt = $db->prepare("INSERT INTO books (title, author, publish_date, Etiqueta, genres, sinopsis) VALUES (?, ?, ?, ?, ?, ?)");
        $result = $stmt->execute([$title, $author, $year, $age_group, $genresStr, $synopsis]);
        
        // Agrega esto para debug
        if ($result) {
            error_log("Libro añadido exitosamente.");
        } else {
            error_log("Fallo en execute: " . print_r($stmt->errorInfo(), true));
        }
        
        return $result;
    } catch (PDOException $e) {
        error_log("Error en addBook: " . $e->getMessage());
        return false;
    }
}

function updateBook($db, $id, $title, $author, $year, $age_group, $genresStr, $synopsis) {
    try {
        $stmt = $db->prepare("UPDATE books SET title = ?, author = ?, publish_date = ?, Etiqueta = ?, genres = ?, sinopsis = ? WHERE id = ?");
        return $stmt->execute([$title, $author, $year, $age_group, $genresStr, $synopsis, $id]);
    } catch (PDOException $e) {
        error_log("Error updating book: " . $e->getMessage());
        return false;
    }
}

function deleteBook(PDO $db, int $id): bool {
    $stmt = $db->prepare("DELETE FROM books WHERE id = ?");
    return $stmt->execute([$id]);
}

function bookExists($db, $title, $author, $year) {
    $stmt = $db->prepare("SELECT id FROM books WHERE title = ? AND author = ? AND publish_date = ?");
    $stmt->execute([$title, $author, $year]);
    return $stmt->fetch() !== false;
}