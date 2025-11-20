<?php include 'partials/header.view.php'; ?>

<main class="flex-1 bg-gradient-to-br from-gray-50 to-white py-10">
    <div class="max-w-3xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="bg-white rounded-3xl shadow-lg p-10 border border-gray-200">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900">👤 Mi Perfil</h1>
                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                    Usuario activo
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-800">
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="text-sm text-gray-500 font-medium mb-1">ID de Usuario</div>
                    <div class="text-lg font-semibold"><?= htmlspecialchars($user['id']) ?></div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="text-sm text-gray-500 font-medium mb-1">Nombre</div>
                    <div class="text-lg"><?= htmlspecialchars($user['name']) ?></div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="text-sm text-gray-500 font-medium mb-1">Email</div>
                    <div class="text-lg"><?= htmlspecialchars($user['email']) ?></div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="text-sm text-gray-500 font-medium mb-1">Categoría de Edad</div>
                    <div class="text-lg"><?= htmlspecialchars($user['EtiquetaEdad']) ?></div>
                </div>
                <?php
                $preferencias = $user['Preferencias'] ?? '';
                $preferenciasArray = $preferencias ? explode(';', $preferencias) : [];
                ?>

                <div class="bg-gray-50 rounded-xl p-4 sm:col-span-2">
                    <div class="text-sm text-gray-500 font-medium mb-1">Gustos</div>
                    <div class="text-lg">
                        <?= $preferenciasArray ? htmlspecialchars(implode(", ", $preferenciasArray)) : "Sin gustos registrados" ?>
                    </div>
                </div>

            </div>

            <div class="flex flex-col sm:flex-row gap-4 mt-10">
                <a href="/profile-edit"
                   class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-xl text-center font-semibold hover:bg-blue-700 transition">
                    ✏️ Editar Perfil
                </a>
                <a href="/books"
                   class="flex-1 bg-gray-100 text-gray-800 py-3 px-6 rounded-xl text-center font-semibold hover:bg-gray-200 transition">
                    📚 Volver a Librería
                </a>
            </div>
        </div>
    </div>
</main>

<?php include 'partials/footer.view.php'; ?>
