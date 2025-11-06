<?php include 'partials/header.view.php'; ?>

<main class="flex-1 bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">
                <?= isset($book) ? 'Editar Libro' : 'Añadir Nuevo Libro' ?>
            </h1>

            <form method="POST" action="/save-book" class="space-y-6">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                
                <?php if (isset($book)): ?>
                    <input type="hidden" name="id" value="<?= $book['id'] ?>">
                <?php endif; ?>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título del Libro</label>
                    <input type="text" id="title" name="title" required
                           value="<?= isset($book) ? htmlspecialchars($book['title']) : '' ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                           placeholder="Ingresa el título del libro">
                </div>

                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Autor</label>
                    <input type="text" id="author" name="author" required
                           value="<?= isset($book) ? htmlspecialchars($book['author']) : '' ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                           placeholder="Ingresa el nombre del autor">
                </div>

                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Año de Publicación</label>
                    <input type="date" id="year" name="year" required min="1000" max="<?= date('Y') + 5 ?>"
                           value="<?= isset($book) ? htmlspecialchars($book['publish_date']) : '' ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                           placeholder="Ej: 2023">
                </div>

                <div class="flex space-x-4 pt-4">
                    <button type="submit"
                            class="flex-1 bg-primary text-white py-3 px-6 rounded-lg hover:bg-red-700 font-semibold transition-colors">
                        <?= isset($book) ? 'Actualizar Libro' : 'Guardar Libro' ?>
                    </button>
                    <a href="/books"
                       class="flex-1 bg-gray-200 text-gray-800 py-3 px-6 rounded-lg hover:bg-gray-300 font-semibold text-center transition-colors">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include 'partials/footer.view.php'; ?>