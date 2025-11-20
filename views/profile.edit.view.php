<?php include 'partials/header.view.php'; ?>

<main class="flex-1 bg-gradient-to-br from-gray-50 to-white py-10">
    <div class="max-w-3xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="bg-white rounded-3xl shadow-lg p-10 border border-gray-200">
            <h1 class="text-2xl font-bold mb-6">Editar Perfil</h1>

            <form method="POST" action="/profile">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                <!-- Nombre -->
                <label class="block mb-2 font-semibold">Nombre</label>
                <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>"
                       class="w-full px-4 py-2 border rounded-lg mb-4">

                <!-- Email -->
                <label class="block mb-2 font-semibold">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
                       class="w-full px-4 py-2 border rounded-lg mb-4">

                <label class="block mb-2 font-semibold">Gustos</label>
                <select id="Preferencias" name="Preferencias[]" required multiple
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
                    <option value="Ficción">Ficción</option>
                    <option value="Poesía">Poesía</option>
                    <option value="Juvenil">Juvenil</option>
                    <option value="Infantil">Infantil</option>
                    <option value="Autoayuda">Autoayuda</option>
                    <option value="Salut">Salut</option>
                    <option value="Cocina">Cocina</option>
                    <option value="Ciencia Ficción">Ciencia Ficción</option>
                    <option value="Terror">Terror</option>
                    <option value="Romántica">Romántica</option>
                    <option value="Novela">Novela</option>
                    <option value="Novela Cavalleresca">Novela Cavalleresca</option>
                </select>
                <!-- Contraseña actual -->
                <label class="block mb-2 font-semibold">Contraseña actual</label>
                <input type="password" name="current_password"
                       class="w-full px-4 py-2 border rounded-lg mb-4">

                <!-- Nueva contraseña -->
                <label class="block mb-2 font-semibold">Nueva contraseña</label>
                <input type="password" name="new_password"
                       class="w-full px-4 py-2 border rounded-lg mb-4">

                <!-- Confirmar nueva contraseña -->
                <label class="block mb-2 font-semibold">Confirmar nueva contraseña</label>
                <input type="password" name="confirm_password"
                       class="w-full px-4 py-2 border rounded-lg mb-6">

                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Guardar cambios
                </button>
            </form>
        </div>
    </div>
</main>

<?php include 'partials/footer.view.php'; ?>
