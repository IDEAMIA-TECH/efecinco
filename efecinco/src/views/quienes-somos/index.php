<?php
// El contenido se capturará automáticamente por el buffer
?>

<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative bg-blue-900" style="max-height: 200px;">
        <div class="absolute inset-0">
            <img class="w-full h-[200px] object-cover" 
                 src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&h=200&q=80" 
                 alt="Efecinco Team">
            <div class="absolute inset-0 bg-blue-900 mix-blend-multiply opacity-80"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-8 px-4">
            <img src="<?php echo SITE_URL; ?>/assets/images/logo/logof5.png" 
                 alt="Efe Cinco Logo" 
                 class="h-12 mb-4" 
                 style="max-width: 150px;">
            <h1 class="text-2xl font-bold text-white">¿Quiénes Somos?</h1>
            <p class="mt-2 text-sm text-blue-100 max-w-2xl">
                Somos una empresa líder en soluciones tecnológicas y de seguridad, comprometida con la excelencia y la innovación.
            </p>
        </div>
    </div>

    <!-- Misión y Visión -->
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 shadow-lg transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center mb-4">
                    <i class="fas fa-bullseye text-3xl text-blue-600 mr-3"></i>
                    <h2 class="text-xl font-bold text-blue-900">Nuestra Misión</h2>
                </div>
                <p class="text-gray-700 leading-relaxed text-sm"><?= htmlspecialchars($empresa['mision']) ?></p>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 shadow-lg transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center mb-4">
                    <i class="fas fa-eye text-3xl text-blue-600 mr-3"></i>
                    <h2 class="text-xl font-bold text-blue-900">Nuestra Visión</h2>
                </div>
                <p class="text-gray-700 leading-relaxed text-sm"><?= htmlspecialchars($empresa['vision']) ?></p>
            </div>
        </div>
    </div>

    <!-- Valores -->
    <div class="bg-gradient-to-b from-gray-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">Nuestros Valores</h2>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <?php 
                $iconos = [
                    'Excelencia' => 'fa-star',
                    'Innovación' => 'fa-lightbulb',
                    'Integridad' => 'fa-shield-alt',
                    'Compromiso' => 'fa-handshake'
                ];
                foreach ($empresa['valores'] as $titulo => $descripcion): 
                ?>
                <div class="bg-white rounded-lg shadow-sm p-4 text-center transform hover:scale-105 transition-transform duration-300">
                    <div class="inline-block p-3 rounded-full bg-blue-100 mb-3">
                        <i class="fas <?= $iconos[$titulo] ?> text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 mb-2"><?= htmlspecialchars($titulo) ?></h3>
                    <p class="text-gray-600 text-sm"><?= htmlspecialchars($descripcion) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Línea de Tiempo -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">Nuestra Historia</h2>
        <div class="relative">
            <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-blue-200 to-blue-500"></div>
            <?php $counter = 0; foreach ($empresa['linea_tiempo'] as $anio => $evento): $counter++; ?>
            <div class="relative mb-8">
                <div class="flex items-center">
                    <div class="flex-1 <?= $counter % 2 == 0 ? 'order-2' : '' ?>">
                        <div class="bg-white rounded-lg shadow-lg p-6 <?= $counter % 2 == 0 ? 'ml-8' : 'mr-8' ?> transform hover:scale-105 transition-transform duration-300">
                            <h3 class="text-xl font-bold text-blue-900 mb-2"><?= htmlspecialchars($anio) ?></h3>
                            <p class="text-gray-700"><?= htmlspecialchars($evento) ?></p>
                        </div>
                    </div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-blue-500 rounded-full border-4 border-white shadow"></div>
                    <div class="flex-1 <?= $counter % 2 == 0 ? 'order-1' : '' ?>"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Clientes -->
    <div class="bg-gradient-to-b from-gray-50 to-white py-8">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-xl font-bold text-gray-900 text-center mb-6">Nuestros Clientes</h2>
            <div class="grid grid-cols-3 gap-3 md:grid-cols-5">
                <?php
                $logos = [
                    'Walmart' => 'https://upload.wikimedia.org/wikipedia/commons/c/ca/Walmart_logo.svg',
                    'Importex Green' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?auto=format&fit=crop&w=100&h=100&q=80',
                    'Banco Azteca' => 'https://upload.wikimedia.org/wikipedia/commons/8/86/Banco_Azteca_logo.svg',
                    'Henkel' => 'https://upload.wikimedia.org/wikipedia/commons/2/23/Henkel-Logo.svg',
                    'Otros clientes destacados' => 'https://images.unsplash.com/photo-1557426272-fc759fdf7a8d?auto=format&fit=crop&w=100&h=100&q=80'
                ];
                foreach ($empresa['clientes'] as $cliente): ?>
                <div class="flex items-center justify-center p-2 bg-white rounded shadow-sm">
                    <div class="w-12 h-12 flex items-center justify-center" style="max-width: 48px; max-height: 48px;">
                        <img src="<?= $logos[$cliente] ?>" 
                             alt="<?= htmlspecialchars($cliente) ?>" 
                             class="w-full h-full object-contain filter hover:brightness-100 transition duration-300"
                             style="filter: grayscale(100%) brightness(90%); max-width: 100%; max-height: 100%;">
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Certificaciones -->
    <div class="max-w-7xl mx-auto py-8 px-4">
        <h2 class="text-xl font-bold text-gray-900 text-center mb-6">Certificaciones y Alianzas</h2>
        <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
            <?php 
            $certificacionesImagenes = [
                'Certificación en Seguridad' => 'https://images.unsplash.com/photo-1562813733-b31f71025d54?auto=format&fit=crop&w=300&h=150&q=80',
                'Certificación en TI' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=300&h=150&q=80'
            ];
            foreach ($empresa['certificaciones'] as $certificacion): ?>
            <div class="bg-white rounded shadow-sm overflow-hidden">
                <div style="height: 120px; max-height: 120px; overflow: hidden;">
                    <img src="<?= $certificacionesImagenes[$certificacion['nombre']] ?>" 
                         alt="<?= htmlspecialchars($certificacion['nombre']) ?>" 
                         class="w-full h-full object-cover"
                         style="max-height: 120px;">
                </div>
                <div class="p-3">
                    <h3 class="text-sm font-bold text-blue-900 mb-1"><?= htmlspecialchars($certificacion['nombre']) ?></h3>
                    <p class="text-gray-600 text-xs"><?= htmlspecialchars($certificacion['descripcion']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-blue-800 to-blue-900 py-6">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
            <h2 class="text-xl font-bold text-white mb-4 md:mb-0">
                <span class="block">¿Listo para comenzar?</span>
                <span class="block text-blue-200 text-sm">Contáctanos hoy mismo.</span>
            </h2>
            <div class="flex">
                <a href="<?php echo SITE_URL; ?>/contacto" 
                   class="inline-flex items-center px-3 py-2 text-sm font-medium rounded bg-white text-blue-900 hover:bg-blue-50">
                    <i class="fas fa-envelope mr-2"></i>
                    Contáctanos
                </a>
            </div>
        </div>
    </div>
</div> 