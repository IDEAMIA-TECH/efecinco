<?php
// Iniciar el buffer de salida
ob_start();
?>

<div class="bg-white">
    <!-- Hero Section -->
    <section class="hero bg-gradient-primary text-white py-5 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="<?php echo SITE_URL; ?>/assets/images/logo/logof5.png" 
                         alt="Efe Cinco Logo" 
                         class="img-fluid mb-4" 
                         style="max-width: 300px;">
                    <h1 class="display-4 fw-bold">Nuestros Proyectos</h1>
                    <p class="lead">Conoce algunos de nuestros proyectos más destacados y las soluciones que hemos implementado para nuestros clientes.</p>
                </div>
                <div class="col-lg-6">
                    <img src="<?php echo SITE_URL; ?>/assets/images/projects-hero.jpg" 
                         alt="Proyectos" 
                         class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Proyectos Grid -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <?php if (isset($proyectos) && !empty($proyectos)): ?>
                    <?php foreach ($proyectos as $proyecto): ?>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-img-top" style="height: 200px; overflow: hidden;">
                                <?php if ($proyecto['imagen']): ?>
                                <img src="<?php echo htmlspecialchars($proyecto['imagen']); ?>" 
                                     alt="<?php echo htmlspecialchars($proyecto['titulo']); ?>"
                                     class="w-100 h-100 object-fit-cover">
                                <?php else: ?>
                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0">
                                        <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" 
                                              style="width: 40px; height: 40px;">
                                            <?php echo strtoupper(substr($proyecto['cliente'], 0, 1)); ?>
                                        </span>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0"><?php echo htmlspecialchars($proyecto['cliente']); ?></h5>
                                        <small class="text-muted"><?php echo htmlspecialchars($proyecto['fecha_proyecto']); ?></small>
                                    </div>
                                </div>
                                <h4 class="card-title h5"><?php echo htmlspecialchars($proyecto['titulo']); ?></h4>
                                <p class="card-text"><?php echo htmlspecialchars($proyecto['descripcion']); ?></p>
                                <div class="mb-3">
                                    <span class="badge bg-primary">
                                        <?php echo htmlspecialchars($proyecto['tipo_solucion']); ?>
                                    </span>
                                </div>
                                <a href="/proyectos/<?php echo htmlspecialchars($proyecto['slug']); ?>" 
                                   class="btn btn-outline-primary">
                                    Ver detalles
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No hay proyectos disponibles en este momento.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section bg-gradient-primary text-black py-5">
        <div class="container text-center">
            <h2 class="mb-4">¿Tienes un proyecto en mente?</h2>
            <p class="lead mb-4">Contáctanos para una cotización personalizada</p>
            <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-light btn-lg shadow">
                <i class="fas fa-envelope me-2"></i>
                Contáctanos
            </a>
        </div>
    </section>
</div>

<?php
// Obtener el contenido del buffer y limpiarlo
$content = ob_get_clean();

// Incluir el layout principal
include VIEWS_PATH . '/layouts/main.php';
?> 