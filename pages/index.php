<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once '../includes/models/Service.php';
require_once '../includes/models/Project.php';
require_once '../includes/models/Testimonial.php';

// Obtener datos para la página
$service = new Service();
$project = new Project();
$testimonial = new Testimonial();

$featuredServices = $service->getFeaturedServices();
$recentProjects = $project->getRecentProjects(3);
$activeTestimonials = $testimonial->getActiveTestimonials();

// Incluir el header
include 'components/header.php';
?>

<!-- Hero Section -->
<section class="hero-section position-relative">
    <div class="container">
        <div class="row min-vh-100 align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Soluciones Inteligentes en Seguridad y Tecnología</h1>
                <p class="lead mb-4">Protegemos lo que más valoras, conectando tecnología con confianza.</p>
                <p class="mb-4">Más de 10 años ofreciendo servicios especializados en cableado estructurado, CCTV, control de acceso, enlaces inalámbricos y soporte TI.</p>
                <div class="d-flex gap-3">
                    <a href="#contacto" class="btn btn-primary btn-lg">Solicita una Cotización</a>
                    <a href="#quienes-somos" class="btn btn-outline-primary btn-lg">Conócenos</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="<?php echo SITE_URL; ?>/assets/images/hero-image.jpg" alt="Efecinco Soluciones" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="quienes-somos" class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title">Conectamos seguridad y tecnología para tu empresa</h2>
                <p class="lead">En <strong>Efecinco</strong>, somos una empresa mexicana con más de una década de experiencia ofreciendo soluciones integrales en tecnología, seguridad y telecomunicaciones.</p>
                <p>Nuestro compromiso es asesorar, implementar y acompañar a nuestros clientes en cada etapa de sus proyectos, adaptándonos a sus necesidades y garantizando calidad en cada servicio.</p>
                <p>Trabajamos con un equipo de profesionales certificados y con amplia experiencia en el diseño, implementación y mantenimiento de sistemas tecnológicos.</p>
            </div>
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Seguridad</h5>
                                <p class="card-text">Soluciones integrales en seguridad física y tecnológica</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-network-wired fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Infraestructura</h5>
                                <p class="card-text">Cableado estructurado y redes empresariales</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-wifi fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Conectividad</h5>
                                <p class="card-text">Enlaces inalámbricos y soluciones de red</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Soporte</h5>
                                <p class="card-text">Soporte técnico especializado y mantenimiento</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Nuestros Servicios</h2>
            <p class="lead">Soluciones Tecnológicas a tu Medida</p>
        </div>
        <div class="row g-4">
            <?php foreach ($featuredServices as $service): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <?php if ($service['image']): ?>
                    <img src="<?php echo SITE_URL; ?>/uploads/services/<?php echo $service['image']; ?>" class="card-img-top" alt="<?php echo $service['title']; ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $service['title']; ?></h5>
                        <p class="card-text"><?php echo $service['description']; ?></p>
                        <a href="<?php echo SITE_URL; ?>/services/<?php echo $service['slug']; ?>" class="btn btn-outline-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Casos de Éxito</h2>
            <p class="lead">Proyectos Destacados</p>
        </div>
        <div class="row g-4">
            <?php foreach ($recentProjects as $project): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <?php if ($project['image']): ?>
                    <img src="<?php echo SITE_URL; ?>/uploads/projects/<?php echo $project['image']; ?>" class="card-img-top" alt="<?php echo $project['title']; ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $project['title']; ?></h5>
                        <p class="card-text"><?php echo $project['description']; ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted"><?php echo $project['client_name']; ?></span>
                            <a href="<?php echo SITE_URL; ?>/projects/<?php echo $project['slug']; ?>" class="btn btn-sm btn-outline-primary">Ver detalles</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Testimonios</h2>
            <p class="lead">Lo que dicen nuestros clientes</p>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="testimonials-slider">
                    <?php foreach ($activeTestimonials as $testimonial): ?>
                    <div class="testimonial-item">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <?php if ($testimonial['image']): ?>
                                    <img src="<?php echo SITE_URL; ?>/uploads/testimonials/<?php echo $testimonial['image']; ?>" class="rounded-circle me-3" width="60" height="60" alt="<?php echo $testimonial['client_name']; ?>">
                                    <?php endif; ?>
                                    <div>
                                        <h5 class="mb-1"><?php echo $testimonial['client_name']; ?></h5>
                                        <?php if ($testimonial['company']): ?>
                                        <p class="text-muted mb-0"><?php echo $testimonial['company']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <p class="card-text"><?php echo $testimonial['content']; ?></p>
                                <?php if ($testimonial['rating']): ?>
                                <div class="rating">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= $testimonial['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contacto" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="section-title">¿Quieres cotizar un proyecto o recibir asesoría?</h2>
                <p class="lead mb-4">Contáctanos y te ayudaremos a encontrar la mejor solución para tu empresa.</p>
                
                <div class="contact-info mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-envelope fa-lg text-primary me-3"></i>
                        <span>contacto@efecinco.com.mx</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-phone fa-lg text-primary me-3"></i>
                        <span>(teléfono actual de la empresa)</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-map-marker-alt fa-lg text-primary me-3"></i>
                        <span>Dirección física (si aplica)</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock fa-lg text-primary me-3"></i>
                        <span>Lunes a Viernes: 9:00 am – 6:00 pm</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form id="contactForm" action="<?php echo SITE_URL; ?>/api/contact.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="company" class="form-label">Empresa</label>
                                <input type="text" class="form-control" id="company" name="company">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Mensaje</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?> 