<?php include 'partials/header.view.php'; ?>

<main class="flex-1 bg-gradient-to-br from-gray-50 to-gray-100 py-12">
    <div class="max-w-3xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="bg-white rounded-3xl shadow-lg p-10 border border-gray-200">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 flex items-center space-x-3">
                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m0 0H3"></path>
                </svg>
                <span><?= isset($book) ? 'Editar Libro' : 'Añadir Nuevo Libro' ?></span>
            </h1>

            <form method="POST" action="/save-book" class="space-y-8">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <?php if (isset($book)): ?>
                    <input type="hidden" name="id" value="<?= $book['id'] ?>">
                <?php endif; ?>

                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Título del Libro</label>
                    <input type="text" id="title" name="title" required
                           value="<?= isset($book) ? htmlspecialchars($book['title']) : '' ?>"
                           class="w-full px-5 py-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-primary focus:border-primary transition"
                           placeholder="Ej: Cien Años de Soledad">
                </div>

                <!-- Autor -->
                <div>
                    <label for="author" class="block text-sm font-semibold text-gray-700 mb-2">Autor</label>
                    <input type="text" id="author" name="author" required
                           value="<?= isset($book) ? htmlspecialchars($book['author']) : '' ?>"
                           class="w-full px-5 py-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-primary focus:border-primary transition"
                           placeholder="Ej: Gabriel García Márquez">
                </div>

                <!-- Año -->
                <div>
                    <label for="year" class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Publicación</label>
                    <input type="date" id="year" name="year" required min="1000" max="<?= date('Y') + 5 ?>"
                           value="<?= isset($book) ? htmlspecialchars($book['publish_date']) : '' ?>"
                           class="w-full px-5 py-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-primary focus:border-primary transition">
                </div>
                <!-- Sección de Edad -->
<div>
    <label for="age_group" class="block text-sm font-semibold text-gray-700 mb-2">Sección de Edad</label>
    <select id="age_group" name="age_group" required
            class="w-full px-5 py-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-primary focus:border-primary transition">
        <option value="" disabled <?= !isset($book) ? 'selected' : '' ?>>Selecciona una categoría</option>
        <option value="infantil" <?= isset($book) && $book['age_group'] === 'infantil' ? 'selected' : '' ?>>Infantil</option>
        <option value="juvenil" <?= isset($book) && $book['age_group'] === 'juvenil' ? 'selected' : '' ?>>Juvenil</option>
        <option value="adulto" <?= isset($book) && $book['age_group'] === 'adulto' ? 'selected' : '' ?>>Adulto</option>
        <option value="general" <?= isset($book) && $book['age_group'] === 'general' ? 'selected' : '' ?>>Para todas las edades</option>
    </select>
</div>

<!-- Sinopsis -->
<div>
    <label for="synopsis" class="block text-sm font-semibold text-gray-700 mb-2">Sinopsis</label>
    <textarea id="synopsis" name="synopsis" rows="5" required
              class="w-full px-5 py-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
              placeholder="Escribe una breve sinopsis del libro..."><?= isset($book) ? htmlspecialchars($book['synopsis']) : '' ?></textarea>
</div>


                <!-- Botones -->
                <div class="flex flex-col sm:flex-row sm:space-x-4 pt-6">
                    <button type="submit"
                            class="w-full sm:w-auto bg-primary text-white py-3 px-8 rounded-xl hover:bg-red-700 font-semibold transition">
                        <?= isset($book) ? 'Actualizar Libro' : 'Guardar Libro' ?>
                    </button>
                    <a href="/books"
                       class="mt-3 sm:mt-0 w-full sm:w-auto bg-gray-100 text-gray-800 py-3 px-8 rounded-xl hover:bg-gray-200 font-semibold text-center transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include 'partials/footer.view.php'; ?>
