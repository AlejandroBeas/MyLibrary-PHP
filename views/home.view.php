<?php include 'partials/header.view.php'; ?>

<main class="flex-1 bg-white">
    <!-- Hero -->
    <section class="py-20 text-center">
        <div class="max-w-3xl mx-auto px-6">
            <h1 class="text-4xl font-bold text-gray-900">
                Bienvenido a <span class="text-primary"><?= APP_NAME ?></span>
            </h1>
            <p class="mt-4 text-gray-600 text-lg">
                Tu espacio digital para descubrir y disfrutar de libros.
            </p>

            <!-- Botones principales -->
            <div class="mt-8 flex justify-center gap-4">
                <a href="/register" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Crear Cuenta
                </a>
                <a href="/books" class="border border-primary text-primary px-6 py-3 rounded-lg font-semibold hover:bg-primary hover:text-white transition">
                    Explorar Librería
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-primary text-white py-16">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold">¿Listo para comenzar?</h2>
            <p class="mt-4 text-lg">Únete hoy y forma parte de una comunidad que valora el conocimiento.</p>
            <a href="/register" class="mt-6 inline-block bg-white text-primary px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Crear Cuenta Gratis
            </a>
        </div>
    </section>
</main>

<?php include 'partials/footer.view.php'; ?>
