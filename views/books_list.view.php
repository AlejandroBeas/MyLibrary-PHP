<?php include 'partials/header.view.php'; ?>

<main class="flex-1">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Mi Librería</h1>
                
                <?php if ($_SESSION['user']): ?>
                    <a href="/add-book" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-red-700 font-semibold flex items-center">
                        <span class="mr-2">+</span> Añadir Libro
                    </a>
                <?php endif; ?>
            </div>

            <!-- Mensajes de éxito/error -->
            <?php if (isset($_GET['success'])): ?>
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                    <?php
                    $messages = [
                        'add' => 'Libro añadido correctamente.',
                        'edit' => 'Libro actualizado correctamente.',
                        'delete' => 'Libro eliminado correctamente.'
                    ];
                    echo $messages[$_GET['success']] ?? 'Operación completada correctamente.';
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <?php
                    $messages = [
                        'add' => 'Error al añadir el libro.',
                        'edit' => 'Error al actualizar el libro.',
                        'delete' => 'Error al eliminar el libro.',
                        'invalid' => 'Datos inválidos.'
                    ];
                    echo $messages[$_GET['error']] ?? 'Ha ocurrido un error.';
                    ?>
                </div>
            <?php endif; ?>

            <?php if (empty($books)): ?>
                <div class="text-center py-12 bg-white rounded-2xl shadow-sm">
                    <div class="text-gray-400 text-6xl mb-4">📚</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay libros en la biblioteca</h3>
                    <p class="text-gray-500 mb-6">Comienza añadiendo tu primer libro a la colección.</p>
                    <?php if ($_SESSION['user']): ?>
                        <a href="/add-book" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-red-700 font-semibold inline-block">
                            Añadir Primer Libro
                        </a>
                    <?php else: ?>
                        <p class="text-gray-500">Inicia sesión para añadir libros.</p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Año</th>
                                    <?php if ($_SESSION['user']): ?>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($books as $book): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="/view-book/<?= $book['id'] ?>"><div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($book['title']) ?> </div></a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?= htmlspecialchars($book['author']) ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?= htmlspecialchars($book['publish_date']) ?></div>
                                            
                                        </td>
                                        <?php if ($_SESSION['user']): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="/view-book/<?= $book['id'] ?>" class="text-green-600 hover:text-green-900 mr-4">Ver Detalles</a>
                                            <a href="/edit-book/<?= $book['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-4">Editar</a>
                                            <form action="/delete-book/<?= $book['id'] ?>" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este libro?')">
                                                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                                <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                            </form>
                                        </td>
                                    <?php endif; ?>
                                    
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include 'partials/footer.view.php'; ?>