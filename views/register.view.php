<?php include 'partials/header.view.php';?>

<main class="flex-1 bg-gradient-to-br from-gray-100 to-white flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full bg-white shadow-xl rounded-xl p-10 space-y-8">
        <div class="text-center">
            <h2 class="text-4xl font-bold text-gray-800">Crear una Cuenta</h2>
            <p class="mt-2 text-sm text-gray-500">
                ¿Ya tienes una cuenta?
                <a href="/login" class="text-blue-600 hover:underline font-medium">Inicia sesión aquí</a>
            </p>
        </div>

        <form method="POST" action="/register" class="space-y-6">
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
<?php if (!empty($error)): ?>
    <div style="color: red; font-weight: bold;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div style="color: green; font-weight: bold;">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

            <div id="name">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" id="name" placeholder="Ingresa tu nombre" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       required>
            </div>

            <div id="selects">
                <label for="UserLikes" class="block text-sm font-medium text-gray-700">Géneros preferidos</label>
                <select name="UserLikes[]" id="UserLikes" multiple class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="Ficción">Ficción</option>
                    <option value="Poesía">Poesía</option>
                    <option value="Juvenil">Juvenil</option>
                    <option value="Infantil">Infantil</option>
                    <option value="Autoayuda">Autoayuda</option>
                    <option value="Salud">Salud</option>
                    <option value="Cocina">Cocina</option>
                    <option value="Ciencia Ficción">Ciencia Ficción</option>
                    <option value="Terror">Terror</option>
                    <option value="Romántica">Romántica</option>
                </select>
                <p class="text-sm" style="color: #525252ff">Manter control derech + click para seleccion multiple</p>
            </div>

            <div id="dob">
                <label for="dob" class="block text-sm font-medium text-gray-700">Fecha de nacimiento</label>
                <input type="date" name="dob" id="dob" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       required>
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input id="email" name="email" type="email" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="ejemplo@correo.com">
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input id="password" name="password" type="password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Mínimo 6 caracteres">
            </div>

            <div class="space-y-2">
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                <input id="confirm_password" name="confirm_password" type="password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Repite tu contraseña">
            </div>

            <div>
                <button type="submit"
                        class="w-full py-3 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Registrarse
                </button>
            </div>
        </form>
    </div>
</main>

<?php include 'partials/footer.view.php'; ?>
