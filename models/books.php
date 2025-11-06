<?php

function getAllBooks(PDO $db): array {
    $stmt = $db->query("SELECT id, title, author, publish_date FROM books ORDER BY id DESC");
    return $stmt->fetchAll();
}

function getBook(PDO $db, int $id): ?array {
    $stmt = $db->prepare("SELECT id, title, author, publish_date FROM books WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

function addBook(PDO $db, string $title, string $author, int $year): bool {
    $stmt = $db->prepare("INSERT INTO books (title, author, publish_date) VALUES (?, ?, ?)");
    return $stmt->execute([$title, $author, $year]);
}

function updateBook(PDO $db, int $id, string $title, string $author, int $year): bool {
    $stmt = $db->prepare("UPDATE books SET title = ?, author = ?, publish_date = ? WHERE id = ?");
    return $stmt->execute([$title, $author, $year, $id]);
}

function deleteBook(PDO $db, int $id): bool {
    $stmt = $db->prepare("DELETE FROM books WHERE id = ?");
    return $stmt->execute([$id]);
}

function bookExists(PDO $db, string $title, string $author, int $year): bool {
    $stmt = $db->prepare("SELECT COUNT(*) FROM books WHERE LOWER(title) = LOWER(?) AND LOWER(author) = LOWER(?) AND publish_date = ?");
    $stmt->execute([$title, $author, $year]);
    return $stmt->fetchColumn() > 0;
}