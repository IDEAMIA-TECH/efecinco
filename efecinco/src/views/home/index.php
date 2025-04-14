<?php
$content = ob_get_clean();
ob_start();
?>

<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold">Soluciones en Seguridad y Tecnología</h1>
                <p class="lead">Expertos en sistemas de seguridad, cableado estructurado y soluciones tecnológicas para tu empresa.</p>
                <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-light btn-lg">Contáctanos</a>
            </div>
            <div class="col-lg-6">
                <img src="<?php echo SITE_URL; ?>/assets/images/hero-image.jpg" alt="Soluciones Tecnológicas" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<!-- Servicios Section -->
<section class="services-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Nuestros Servicios</h2>
        <div class="row">
            <?php foreach ($servicios as $servicio): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if ($servicio['imagen_fondo']): ?>
                    <img src="<?php echo SITE_URL; ?>/uploads/<?php echo $servicio['imagen_fondo']; ?>" class="card-img-top" alt="<?php echo $servicio['titulo']; ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <?php if ($servicio['icono']): ?>
                        <i class="<?php echo $servicio['icono']; ?> fa-2x mb-3"></i>
                        <?php endif; ?>
                        <h5 class="card-title"><?php echo $servicio['titulo']; ?></h5>
                        <p class="card-text"><?php echo $servicio['descripcion']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Proyectos Section -->
<section class="projects-section bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Proyectos Destacados</h2>
        <div class="row">
            <?php foreach ($proyectos as $proyecto): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if ($proyecto['imagen']): ?>
                    <img src="<?php echo SITE_URL; ?>/uploads/<?php echo $proyecto['imagen']; ?>" class="card-img-top" alt="<?php echo $proyecto['titulo']; ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $proyecto['cliente']; ?></h5>
                        <p class="card-text"><?php echo $proyecto['tipo_solucion']; ?></p>
                        <p class="card-text"><small class="text-muted"><?php echo $proyecto['fecha_proyecto']; ?></small></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimonios Section -->
<section class="testimonials-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Lo que dicen nuestros clientes</h2>
        <div class="row">
            <?php foreach ($testimonios as $testimonio): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <?php if ($testimonio['imagen']): ?>
                        <img src="<?php echo SITE_URL; ?>/uploads/<?php echo $testimonio['imagen']; ?>" class="rounded-circle mb-3" alt="<?php echo $testimonio['nombre_cliente']; ?>" width="100">
                        <?php endif; ?>
                        <p class="card-text">"<?php echo $testimonio['testimonio']; ?>"</p>
                        <h5 class="card-title"><?php echo $testimonio['nombre_cliente']; ?></h5>
                        <p class="text-muted"><?php echo $testimonio['empresa']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section bg-primary text-white py-5">
    <div class="container text-center">
        <h2 class="mb-4">¿Listo para comenzar tu proyecto?</h2>
        <p class="lead mb-4">Contáctanos hoy mismo para una consulta gratuita.</p>
        <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-light btn-lg">Solicitar Cotización</a>
    </div>
</section>

<?php
$content = ob_get_clean();
include VIEWS_PATH . '/layouts/main.php';
?> 