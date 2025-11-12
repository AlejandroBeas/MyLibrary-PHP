<?php include 'partials/header.view.php'; ?>

<main class="flex-1 bg-gradient-to-br from-white to-gray-100">
    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 text-center">
            <h1 class="text-5xl font-extrabold text-gray-900 leading-tight">
                Bienvenido a <span class="text-primary"><?= APP_NAME ?></span>
            </h1>
            <p class="mt-6 text-lg text-gray-600 max-w-2xl mx-auto">
                Tu espacio digital para explorar, aprender y crecer. Descubre miles de recursos al alcance de un clic.
            </p>
            <div class="mt-8 flex justify-center space-x-4">
                <a href="/register" class="bg-primary text-white px-6 py-3 rounded-md font-medium hover:bg-blue-800 transition">
                    Crear Cuenta
                </a>
                <a href="/books" class="px-6 py-3 border border-primary text-primary rounded-md font-medium hover:bg-primary hover:text-white transition">
                    Explorar Librería
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">¿Por qué elegir <?= APP_NAME ?>?</h2>
                <p class="mt-4 text-gray-600">Una plataforma pensada para facilitar tu acceso al conocimiento.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                    <div class="text-primary text-4xl mb-4">📚</div>
                    <h3 class="text-xl font-semibold text-gray-800">Amplia colección</h3>
                    <p class="mt-2 text-gray-600">Miles de libros, artículos y recursos digitales disponibles para ti.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                    <div class="text-primary text-4xl mb-4">⚡</div>
                    <h3 class="text-xl font-semibold text-gray-800">Acceso rápido</h3>
                    <p class="mt-2 text-gray-600">Encuentra lo que necesitas en segundos con nuestro buscador inteligente.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center">
                    <div class="text-primary text-4xl mb-4">🔒</div>
                    <h3 class="text-xl font-semibold text-gray-800">Seguridad y privacidad</h3>
                    <p class="mt-2 text-gray-600">Tu información está protegida con los más altos estándares de seguridad.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-primary text-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold">¿Listo para comenzar?</h2>
            <p class="mt-4 text-lg">Únete hoy y forma parte de una comunidad que valora el conocimiento.</p>
            <a href="/register" class="mt-6 inline-block bg-white text-primary px-6 py-3 rounded-md font-semibold hover:bg-gray-100 transition">
                Crear Cuenta Gratis
            </a>
        </div>
    </section>
</main>

<?php include 'partials/footer.view.php'; ?>
