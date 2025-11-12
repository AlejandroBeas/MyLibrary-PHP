<!DOCTYPE html>
<html lang="es" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-primary { background-color: #1e40af; } /* Azul profesional */
        .text-primary { color: #1e40af; }
        .border-primary { border-color: #1e40af; }
        .hover\:bg-primary:hover { background-color: #1e3a8a; }
        .hover\:text-primary:hover { color: #1e40af; }
    </style>
</head>
<body class="h-full flex flex-col bg-white text-gray-800 antialiased">
<header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="/home" class="flex items-center space-x-2 text-xl font-semibold text-gray-900 hover:text-primary transition-colors">
                <span class="text-primary">📘 My Library</span>
            </a>

            <!-- Navegación -->
            <nav class="flex items-center space-x-6 text-sm font-medium">
                <a href="/home" class="text-gray-700 hover:text-primary transition-colors">Inicio</a>
                <a href="/books" class="text-gray-700 hover:text-primary transition-colors">Librería</a>

                <?php if ($_SESSION['user']): ?>
                    <!-- Menú de usuario -->
                    <div class="relative group">
    <button class="flex items-center space-x-2 text-gray-700 hover:text-primary transition-colors focus:outline-none">
        <span><?= htmlspecialchars($_SESSION['user']['email']) ?></span>
        <img src="../../styles/userLogo.webp" class="w-18 h-9" alt="">

        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <!-- Dropdown -->
    <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg 
                opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
        <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mi Perfil</a>
        <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar Sesión</a>
    </div>
</div>

                <?php else: ?>
                    <a href="/register" class="text-gray-700 hover:text-primary transition-colors"><img src="../../styles/userLogo.webp" class="w-18 h-9" alt="">
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>
