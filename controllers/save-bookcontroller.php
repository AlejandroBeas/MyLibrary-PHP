<?php
requireAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyToken()) {
    $title = filter_input(INPUT_POST, 'title');
    $author = filter_input(INPUT_POST, 'author');
    $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    
    if ($title && $author && $year) {
        require_once __DIR__ . '/../models/books.php';
        
        // Verificar si el libro ya existe (solo para nuevos libros)
        if (!$id && bookExists($db, $title, $author, $year)) {
            header('Location: /books?error=duplicate');
            exit;
        }
        
        if ($id) {
            // Editar libro existente
            if (updateBook($db, $id, $title, $author, $year)) {
                header('Location: /books?success=edit');
            } else {
                header('Location: /books?error=edit');
            }
        } else {
            // Crear nuevo libro
            if (addBook($db, $title, $author, $year)) {
                header('Location: /books?success=add');
            } else {
                header('Location: /books?error=add');
            }
        }
        exit;
    }
}

header('Location: /books?error=invalid');
exit;