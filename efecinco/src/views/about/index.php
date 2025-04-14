<?php
$content = ob_get_clean();
ob_start();
?>

<!-- Hero Section -->
<div class="relative bg-gray-900">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="/assets/images/about-hero.jpg" alt="Efecinco">
        <div class="absolute inset-0 bg-gray-900 mix-blend-multiply"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
            ¿Quiénes Somos?
        </h1>
    </div>
</div>

<!-- Sobre Nosotros -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Nuestra Historia
                </h2>
                <div class="mt-6 prose prose-lg text-gray-500">
                    <?= nl2br(htmlspecialchars($empresa['historia'])) ?>
                </div>
            </div>
            <div class="mt-12 lg:mt-0">
                <img class="rounded-lg shadow-xl" src="<?= htmlspecialchars($empresa['imagen_historia']) ?>" alt="Historia de Efecinco">
            </div>
        </div>
    </div>
</div>

<!-- Misión -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Nuestra Misión
            </h2>
            <div class="mt-6 max-w-3xl mx-auto prose prose-lg text-gray-500">
                <?= nl2br(htmlspecialchars($empresa['mision'])) ?>
            </div>
        </div>
    </div>
</div>

<!-- Línea de Tiempo -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl text-center">
            Nuestra Trayectoria
        </h2>
        <div class="mt-12 flow-root">
            <ul class="-mb-8">
                <?php foreach ($timeline as $evento): ?>
                <li>
                    <div class="relative pb-8">
                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                        <div class="relative flex space-x-3">
                            <div>
                                <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                <div>
                                    <p class="text-sm text-gray-500"><?= htmlspecialchars($evento['fecha']) ?></p>
                                    <p class="text-lg font-medium text-gray-900"><?= htmlspecialchars($evento['titulo']) ?></p>
                                    <p class="mt-2 text-gray-600"><?= htmlspecialchars($evento['descripcion']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Clientes -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Nuestros Clientes
            </h2>
            <p class="mt-4 text-lg text-gray-600">
                Empresas que confían en nuestros servicios
            </p>
        </div>

        <div class="mt-12 grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-6">
            <?php foreach ($clientes as $cliente): ?>
            <div class="flex items-center justify-center">
                <img src="<?= htmlspecialchars($cliente['logo']) ?>" 
                     alt="<?= htmlspecialchars($cliente['nombre']) ?>"
                     class="h-12 object-contain grayscale hover:grayscale-0 transition duration-300">
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include VIEWS_PATH . '/layouts/main.php';
?> 