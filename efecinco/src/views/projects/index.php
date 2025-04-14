<?php
$content = ob_get_clean();
ob_start();
?>

<!-- Hero Section -->
<div class="relative bg-gray-900">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="/assets/images/projects-hero.jpg" alt="Proyectos">
        <div class="absolute inset-0 bg-gray-900 mix-blend-multiply"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
            Nuestros Proyectos
        </h1>
        <p class="mt-6 text-xl text-gray-300 max-w-3xl">
            Conoce algunos de nuestros proyectos más destacados y las soluciones que hemos implementado para nuestros clientes.
        </p>
    </div>
</div>

<!-- Proyectos Grid -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($proyectos as $proyecto): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative h-48">
                    <?php if ($proyecto['imagen']): ?>
                    <img src="<?= htmlspecialchars($proyecto['imagen']) ?>" 
                         alt="<?= htmlspecialchars($proyecto['titulo']) ?>"
                         class="w-full h-full object-cover">
                    <?php else: ?>
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                                <span class="text-lg font-medium leading-none text-blue-600">
                                    <?= strtoupper(substr($proyecto['cliente'], 0, 1)) ?>
                                </span>
                            </span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                <?= htmlspecialchars($proyecto['cliente']) ?>
                            </h3>
                            <p class="text-sm text-gray-500">
                                <?= htmlspecialchars($proyecto['fecha_proyecto']) ?>
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 class="text-xl font-semibold text-gray-900">
                            <?= htmlspecialchars($proyecto['titulo']) ?>
                        </h4>
                        <p class="mt-2 text-gray-600">
                            <?= htmlspecialchars($proyecto['descripcion']) ?>
                        </p>
                    </div>
                    <div class="mt-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <?= htmlspecialchars($proyecto['tipo_solucion']) ?>
                        </span>
                    </div>
                    <div class="mt-6">
                        <a href="/proyectos/<?= htmlspecialchars($proyecto['slug']) ?>" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-500">
                            Ver detalles
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-blue-600">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
            <span class="block">¿Tienes un proyecto en mente?</span>
            <span class="block text-blue-200">Contáctanos para una cotización.</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
            <div class="inline-flex rounded-md shadow">
                <a href="/contacto" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50">
                    Contáctanos
                </a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include VIEWS_PATH . '/layouts/main.php';
?> 