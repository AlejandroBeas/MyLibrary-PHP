<?php include 'partials/header.view.php'; ?>

<main class="flex-1 bg-gradient-to-br from-gray-50 to-gray-100 py-12">
    <div class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Detalles del Libro</h1>
                <a href="/books" class="bg-gray-100 text-gray-800 py-2 px-6 rounded-lg hover:bg-gray-200 font-semibold">
                    ← Volver a la Librería
                </a>
            </div>

            <?php if ($book): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4"><?= htmlspecialchars($book['title']) ?></h2>
                        <p class="text-lg text-gray-700 mb-2"><strong>Autor:</strong> <?= htmlspecialchars($book['author']) ?></p>
                        <p class="text-lg text-gray-700 mb-2"><strong>Fecha de Publicación:</strong> <?= htmlspecialchars($book['publish_date']) ?></p>
                        <p class="text-lg text-gray-700 mb-2"><strong>Sección de Edad:</strong> <?= htmlspecialchars($book['Etiqueta']) ?></p>
                        <p class="text-lg text-gray-700 mb-4"><strong>Género:</strong> <?= htmlspecialchars($book['genres']) ?></p>
                        <?php if ($averageRating): ?>
                            <p class="text-lg text-gray-700 mb-4">
                                <strong>Valoración promedio:</strong>
                                <?= number_format($averageRating, 1) ?> / 5
                                <br> 
                                (<?= $totalReviews ?> reseñas)
                            </p>
                        <?php else: ?>
                            <p class="text-lg text-gray-500 mb-4">Este libro aún no tiene reseñas.</p>
                        <?php endif; ?>

                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Sinopsis</h3>
                        <p class="text-gray-700 leading-relaxed"><?= nl2br(htmlspecialchars($book['sinopsis'])) ?></p>
                    </div>
                </div>
                <!-- Sección de Comentarios -->
                <?php
                    $userHasComment = false;
                    foreach ($comments as $c) {
                        if ($c['user_id'] == $_SESSION['user']['id']) {
                            $userHasComment = true;
                            break;
                        }
                    }
                ?>
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Comentarios</h2>
                    
                    <!-- Formulario para agregar comentario -->
                     <?php if (!$userHasComment): ?>
                        <form method="POST" action="/add-comment" class="mb-8">
                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                            <input type="hidden" name="book_id" value="<?= $book['id'] ?>">

                            <!-- Valoración en estrellas -->
                            <label class="block mb-2 font-semibold text-gray-700">Tu valoración:</label>
                            <select name="rating" required class="px-4 py-2 border border-gray-300 rounded-lg">
                                <option value="5">★★★★★ - Excelente</option>
                                <option value="4">★★★★☆ - Muy bueno</option>
                                <option value="3">★★★☆☆ - Bueno</option>
                                <option value="2">★★☆☆☆ - Regular</option>
                                <option value="1">★☆☆☆☆ - Malo</option>
                            </select>

                            <!-- Comentario -->
                            <textarea name="comment" rows="3" required
                                    class="w-full mt-4 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                    placeholder="Escribe tu reseña..."></textarea>

                            <button type="submit" class="mt-2 bg-primary text-white px-6 py-2 rounded-lg hover:bg-red-700">
                                Agregar Reseña
                            </button>
                        </form>
                    <?php else: ?>
                        <p class="text-gray-500">Ya has reseñado este libro. Puedes editar o eliminar tu reseña.</p>
                    <?php endif; ?>

                    <!-- Lista de comentarios -->
                    <?php if (!empty($comments)): ?>
                        <div class="space-y-4">
                            <?php foreach ($comments as $comment): ?>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-yellow-500">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                            
                                                <?= $i <= $comment['rating'] ? '★' : '☆' ?>
                                            <?php endfor; ?>
                                            </p>
                                            <p class="font-semibold text-gray-900"><?= htmlspecialchars($comment['username']) ?></p>
                                            <p class="text-gray-700 mt-1"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                                            <p class="text-sm text-gray-500 mt-2"><?= htmlspecialchars($comment['created_at']) ?></p>
                                        </div>
                                        <?php if ($comment['user_id'] == $_SESSION['user']['id']): ?>
                                            <div class="flex space-x-2">
                                                <!-- Editar -->
                                                <button onclick="editComment(<?= $comment['id'] ?>, '<?= addslashes($comment['comment']) ?>', <?= $comment['rating'] ?>)"
                                                class="text-blue-600 hover:text-blue-900">Editar</button>

                                                <!-- Eliminar -->
                                                <form method="POST" action="/delete-comment" class="inline" onsubmit="return confirm('¿Eliminar comentario?')">
                                                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                                    <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                                    <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-500">No hay comentarios aún. ¡Sé el primero en comentar!</p>
                    <?php endif; ?>
                </div>

                <div id="editCommentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white p-6 rounded-lg w-96">
                        <h3 class="text-lg font-bold mb-4">Editar Reseña</h3>
                        <form method="POST" action="/edit-comment">
                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                            <input type="hidden" name="comment_id" id="editCommentId">
                            <input type="hidden" name="book_id" value="<?= $book['id'] ?>">

                            <!-- Rating -->
                            <label class="block mb-2 font-semibold text-gray-700">Valoración:</label>
                            <select id="editCommentRating" name="rating" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                <option value="5">★★★★★ - Excelente</option>
                                <option value="4">★★★★☆ - Muy bueno</option>
                                <option value="3">★★★☆☆ - Bueno</option>
                                <option value="2">★★☆☆☆ - Regular</option>
                                <option value="1">★☆☆☆☆ - Malo</option>
                            </select>

                            <!-- Comentario -->
                            <textarea id="editCommentText" name="comment" rows="3" required 
                                    class="w-full mt-4 px-4 py-2 border border-gray-300 rounded-lg"></textarea>

                            <div class="mt-4 flex justify-end space-x-2">
                                <button type="button" onclick="closeEditModal()" class="bg-gray-300 px-4 py-2 rounded">Cancelar</button>
                                <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function editComment(id, text, rating) {
                        document.getElementById('editCommentId').value = id;
                        document.getElementById('editCommentText').value = text;
                        document.getElementById('editCommentRating').value = rating;
                        document.getElementById('editCommentModal').classList.remove('hidden');
                    }

                    function closeEditModal() {
                        document.getElementById('editCommentModal').classList.add('hidden');
                    }
                </script>
            <?php else: ?>
                <p class="text-red-600">Libro no encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include 'partials/footer.view.php'; ?>