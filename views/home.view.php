<?php include 'partials/header.view.php'; ?>

<main class="flex-1">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-red-50 to-white rounded-2xl shadow-sm p-8 mb-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Bienvenido a <span class="text-primary">My Library</span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Gestiona tu colección de libros personal de manera fácil y profesional. 
                    Añade, edita y organiza tus libros favoritos.
                </p>
                
                <?php if ($_SESSION['user']): ?>
                    <div class="space-x-4">
                        <a href="/books" class="bg-primary text-white px-8 py-3 rounded-lg hover:bg-red-700 font-semibold text-lg inline-block transition-colors">
                            Ver Mi Librería
                        </a>
                    </div>
                <?php else: ?>
                    <div class="space-x-4">
                        <a href="/register" class="bg-primary text-white px-8 py-3 rounded-lg hover:bg-red-700 font-semibold text-lg inline-block transition-colors">
                            Comenzar Ahora
                        </a>
                        <a href="/login" class="border border-primary text-primary px-8 py-3 rounded-lg hover:bg-red-50 font-semibold text-lg inline-block transition-colors">
                            Iniciar Sesión
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Últimos libros -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Últimos Libros Añadidos</h2>
            
            <?php if (empty($books)): ?>
                <div class="text-center py-12">
                    <div class="text-gray-400 text-6xl mb-4">📚</div>
                    <p class="text-gray-500 text-lg">No hay libros en la biblioteca todavía.</p>
                    <?php if ($_SESSION['user']): ?>
                        <a href="/add-book" class="inline-block mt-4 text-primary hover:text-red-700 font-medium">
                            ¡Sé el primero en añadir un libro!
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach (array_slice($books, 0, 6) as $book): ?>
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <h3 class="font-semibold text-lg text-gray-900 mb-2"><?= htmlspecialchars($book['title']) ?></h3>
                            <p class="text-gray-600 mb-1"><strong>Autor:</strong> <?= htmlspecialchars($book['author']) ?></p>
                            <p class="text-gray-600 mb-1"><strong>Año:</strong> <?= htmlspecialchars($book['year']) ?></p>
                            <p class="text-gray-600 text-sm"><strong>Añadido:</strong> <?= formatDate($book['created_at']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if (count($books) > 6): ?>
                    <div class="text-center mt-6">
                        <a href="/books" class="text-primary hover:text-red-700 font-semibold">
                            Ver todos los libros →
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include 'partials/footer.view.php'; ?>