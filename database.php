<?php

function connectSqlite() {
    $path = DB_SQLITE_PATH;
    
    // Crear directorio si no existe
    $dir = dirname($path);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
    $pdo = new PDO("sqlite:$path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    return $pdo;
}

function connectMysql() {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
}

function dbConnect() {
    try {
        if (DB_CONNECTION === 'sqlite') {
            return connectSqlite();
        } else {
            return connectMysql();
        }
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

function dbQuery($db, $sql, $params = []) {
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function dbQueryOne($db, $sql, $params = []) {
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch();
}

function dbExecute($db, $sql, $params = []) {
    $stmt = $db->prepare($sql);
    return $stmt->execute($params);
}

function authenticate(PDO $db, string $email, string $password): bool {
    $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
    $stmt = $db->prepare($sql);
    
    if ($stmt->execute([$email])) {
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            $_SESSION['token'] = bin2hex(random_bytes(32));
            $_SESSION['welcome_message'] = "¡Bienvenido de nuevo! Has iniciado sesión correctamente.";
            return true;
        }
    }
    return false;
}

function registerUser(PDO $db, string $email, string $password, string $name, string $age, string $likes): bool {

    $checkSql = "SELECT id FROM users WHERE email = ?";
    $checkStmt = $db->prepare($checkSql);
    $checkStmt->execute([$email]);
    
    if ($checkStmt->fetch()) {
        return false; 
    }
    
    $sql = "INSERT INTO users (email, password, name, EtiquetaEdad, Preferencias) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    return $stmt->execute([$email, $hashedPassword, $name, $age, $likes]);
}

function requireAuth() {
    if (!isset($_SESSION['user']) || $_SESSION['user'] === null) {
        header('Location: /login');
        exit;
    }
}

function verifyToken(): bool {
    return isset($_POST['token']) && $_POST['token'] === $_SESSION['token'];
}