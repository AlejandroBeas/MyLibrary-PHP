<!DOCTYPE html>
<html lang="es" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-primary { background-color: #dc2626; }
        .text-primary { color: #dc2626; }
        .border-primary { border-color: #dc2626; }
        .hover\:bg-primary:hover { background-color: #b91c1c; }
        .hover\:text-primary:hover { color: #dc2626; }
    </style>
</head>
<body class="h-full flex flex-col bg-white">
<header class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <a href="/home" class="text-2xl font-bold text-gray-900 hover:text-primary transition-colors">
                    <span class="text-primary">📚 My Library</span>
                </a>
            </div>
            
            <nav class="flex items-center space-x-6">
                <a href="/home" class="text-gray-700 hover:text-primary font-medium transition-colors">Inicio</a>
                <a href="/books" class="text-gray-700 hover:text-primary font-medium transition-colors">Librería</a>
                
                <?php if ($_SESSION['user']): ?>
                    <div class="flex items-center space-x-4">
                        <!-- Menú desplegable del usuario -->
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-primary font-medium transition-colors">
                                <span><?= htmlspecialchars($_SESSION['user']['email']) ?></span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Menú desplegable -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">Mi Perfil</a>
                                <a href="/logout" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">Cerrar Sesión</a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/login" class="text-gray-700 hover:text-primary font-medium transition-colors">Iniciar Sesión</a>
                    <a href="/register" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-red-700 font-medium transition-colors">
                        Registrarse
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>