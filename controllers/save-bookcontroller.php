<?php
requireAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyToken()) {
    // Filtrar y sanitizar todos los inputs
    $title = filter_input(INPUT_POST, 'title');
    $author = filter_input(INPUT_POST, 'author');
    $year = filter_input(INPUT_POST, 'year'); // Cambié a string porque es una fecha (tipo date)
    $age_group = filter_input(INPUT_POST, 'age_group');
    $genres = $_POST['genre'] ?? []; // Array múltiple, no se filtra con filter_input
    $synopsis = filter_input(INPUT_POST, 'synopsis');
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    
    // Convertir genres a string (como en add-bookcontroller.php, pero corregido)
    $genresStr = "";
    if (!empty($genres)) {
        foreach ($genres as $genre) {
            $genresStr .= $genre . "; "; // $genre es string, no array
        }
        $genresStr = rtrim($genresStr, "; "); // Quitar el último "; "
    }
    
    // Validación: Todos los campos obligatorios
    if ($title && $author && $year && $age_group && !empty($genres) && $synopsis) {
        require_once __DIR__ . '/../models/books.php';
        
        // Verificar si el libro ya existe (solo para nuevos libros)
        if (!$id && bookExists($db, $title, $author, $year)) {
            header('Location: /books?error=duplicate');
            exit;
        }
        
        if ($id) {
            // Editar libro existente (actualizar con todos los campos)
            if (updateBook($db, $id, $title, $author, $year, $age_group, $genresStr, $synopsis)) {
                header('Location: /books?success=edit');
            } else {
                header('Location: /books?error=edit');
            }
        } else {
            // Crear nuevo libro (con todos los campos)
            if (addBook($db, $title, $author, $year, $age_group, $genresStr, $synopsis)) {
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