<?php
$content = ob_get_clean();
ob_start();
?>

<!-- Hero Section -->
<div class="relative bg-gray-900">
    <div class="absolute inset-0">
        <?php if ($proyecto['imagen']): ?>
        <img class="w-full h-full object-cover" src="<?= htmlspecialchars($proyecto['imagen']) ?>" alt="<?= htmlspecialchars($proyecto['titulo']) ?>">
        <?php else: ?>
        <div class="w-full h-full bg-gray-800"></div>
        <?php endif; ?>
        <div class="absolute inset-0 bg-gray-900 mix-blend-multiply"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
            <?= htmlspecialchars($proyecto['titulo']) ?>
        </h1>
        <p class="mt-6 text-xl text-gray-300 max-w-3xl">
            <?= htmlspecialchars($proyecto['cliente']) ?>
        </p>
    </div>
</div>

<!-- Project Details -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="prose prose-lg text-gray-500">
                    <h2>Descripción del Proyecto</h2>
                    <p><?= nl2br(htmlspecialchars($proyecto['descripcion'])) ?></p>

                    <?php if (!empty($proyecto['caracteristicas'])): ?>
                    <h3>Características Principales</h3>
                    <ul>
                        <?php foreach ($proyecto['caracteristicas'] as $caracteristica): ?>
                        <li><?= htmlspecialchars($caracteristica) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <?php if (!empty($proyecto['tecnologias'])): ?>
                    <h3>Tecnologías Implementadas</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($proyecto['tecnologias'] as $tecnologia): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <?= htmlspecialchars($tecnologia) ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="mt-12 lg:mt-0 lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900">Detalles del Proyecto</h3>
                    <dl class="mt-4 space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Cliente</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($proyecto['cliente']) ?></dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tipo de Solución</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($proyecto['tipo_solucion']) ?></dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Fecha del Proyecto</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?= date('d/m/Y', strtotime($proyecto['fecha_proyecto'])) ?></dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Estado</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?= $proyecto['estado'] === 'activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                                    <?= ucfirst($proyecto['estado']) ?>
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-6">
                    <a href="/contacto" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Solicitar Información
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Section -->
<?php if (!empty($proyecto['galeria'])): ?>
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Galería del Proyecto</h2>
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($proyecto['galeria'] as $imagen): ?>
            <div class="relative">
                <img src="<?= htmlspecialchars($imagen['url']) ?>" 
                     alt="<?= htmlspecialchars($imagen['titulo']) ?>"
                     class="w-full h-64 object-cover rounded-lg shadow-lg">
                <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-50 transition duration-300 rounded-lg flex items-center justify-center">
                    <span class="text-white opacity-0 hover:opacity-100 transition duration-300">
                        <?= htmlspecialchars($imagen['titulo']) ?>
                    </span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Related Projects Section -->
<section class="related-projects-section bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Proyectos Relacionados</h2>
        <div class="row">
            <?php
            $relatedProjects = $this->projectModel->getProjectsByService($proyecto['tipo_solucion'], 3);
            foreach ($relatedProjects as $related): 
                if ($related['id'] !== $proyecto['id']):
            ?>
            <div class="col-md-4 mb-4">
                <div class="project-card">
                    <div class="project-image">
                        <img src="<?php echo SITE_URL; ?>/uploads/<?php echo $related['imagen']; ?>" 
                             alt="<?php echo htmlspecialchars($related['titulo']); ?>"
                             class="img-fluid">
                    </div>
                    <div class="project-content">
                        <h3 class="project-title"><?php echo htmlspecialchars($related['titulo']); ?></h3>
                        <p class="project-client">
                            <strong>Cliente:</strong> <?php echo htmlspecialchars($related['cliente']); ?>
                        </p>
                        <a href="<?php echo SITE_URL; ?>/proyectos/<?php echo $related['id']; ?>" 
                           class="btn btn-primary">
                            Ver Proyecto
                        </a>
                    </div>
                </div>
            </div>
            <?php 
                endif;
            endforeach; 
            ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="container text-center">
        <h2 class="mb-4">¿Listo para comenzar tu proyecto?</h2>
        <p class="lead mb-4">Contáctanos hoy mismo para una consulta gratuita</p>
        <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-primary btn-lg">
            Solicitar Consulta
        </a>
    </div>
</section>

<?php
$content = ob_get_clean();
include VIEWS_PATH . '/layouts/main.php';
?> 