<?php ob_start(); ?>

<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative bg-blue-900">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="/assets/images/about-hero.jpg" alt="Efecinco Team">
            <div class="absolute inset-0 bg-blue-900 mix-blend-multiply"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">¿Quiénes Somos?</h1>
            <p class="mt-6 text-xl text-blue-100 max-w-3xl">
                Somos una empresa líder en soluciones tecnológicas y de seguridad, comprometida con la excelencia y la innovación.
            </p>
        </div>
    </div>

    <!-- Misión y Visión -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
            <div class="bg-blue-50 rounded-lg p-8">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Nuestra Misión</h2>
                <p class="text-gray-600"><?= htmlspecialchars($empresa['mision']) ?></p>
            </div>
            <div class="bg-blue-50 rounded-lg p-8">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Nuestra Visión</h2>
                <p class="text-gray-600"><?= htmlspecialchars($empresa['vision']) ?></p>
            </div>
        </div>
    </div>

    <!-- Valores -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">Nuestros Valores</h2>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <?php foreach ($empresa['valores'] as $titulo => $descripcion): ?>
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <h3 class="text-xl font-bold text-blue-900 mb-4"><?= htmlspecialchars($titulo) ?></h3>
                    <p class="text-gray-600"><?= htmlspecialchars($descripcion) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Línea de Tiempo -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">Nuestra Historia</h2>
        <div class="relative">
            <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-0.5 bg-blue-200"></div>
            <?php foreach ($empresa['linea_tiempo'] as $anio => $evento): ?>
            <div class="relative mb-8">
                <div class="flex items-center">
                    <div class="flex-1 <?= $loop->iteration % 2 == 0 ? 'order-2' : '' ?>">
                        <div class="bg-white rounded-lg shadow-lg p-6 <?= $loop->iteration % 2 == 0 ? 'ml-8' : 'mr-8' ?>">
                            <h3 class="text-xl font-bold text-blue-900"><?= htmlspecialchars($anio) ?></h3>
                            <p class="text-gray-600"><?= htmlspecialchars($evento) ?></p>
                        </div>
                    </div>
                    <div class="flex-1 <?= $loop->iteration % 2 == 0 ? 'order-1' : '' ?>"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Clientes -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">Nuestros Clientes</h2>
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-5">
                <?php foreach ($empresa['clientes'] as $cliente): ?>
                <div class="flex items-center justify-center">
                    <img src="/assets/images/clientes/<?= strtolower(str_replace(' ', '-', $cliente)) ?>.png" 
                         alt="<?= htmlspecialchars($cliente) ?>" 
                         class="max-h-16 grayscale hover:grayscale-0 transition duration-300">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Certificaciones -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">Certificaciones y Alianzas</h2>
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($empresa['certificaciones'] as $certificacion): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="<?= htmlspecialchars($certificacion['imagen']) ?>" 
                     alt="<?= htmlspecialchars($certificacion['nombre']) ?>" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-2"><?= htmlspecialchars($certificacion['nombre']) ?></h3>
                    <p class="text-gray-600"><?= htmlspecialchars($certificacion['descripcion']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-blue-900">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">¿Listo para comenzar?</span>
                <span class="block text-blue-200">Contáctanos hoy mismo.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="/contacto" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-900 bg-white hover:bg-blue-50">
                        Contáctanos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include VIEWS_PATH . '/layout.php';
?> 