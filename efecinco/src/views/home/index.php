<?php
$content = ob_get_clean();
ob_start();
?>

<!-- Hero Section -->
<section class="hero bg-gradient-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="<?php echo SITE_URL; ?>/assets/images/logo/logof5.png" alt="Efe Cinco Logo" class="img-fluid mb-4" style="max-width: 300px;">
                <h1 class="display-4 fw-bold"><?php echo $data['hero']['title']; ?></h1>
                <p class="lead"><?php echo $data['hero']['subtitle']; ?></p>
                <a href="<?php echo $data['hero']['cta_link']; ?>" class="btn btn-light btn-lg">
                    <?php echo $data['hero']['cta_text']; ?>
                </a>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab" 
                     alt="Edificio moderno con tecnología" 
                     class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Nuestros Servicios</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1557597774-9d475d5e8142" 
                         class="card-img-top" 
                         alt="Sistemas de Seguridad">
                    <div class="card-body text-center">
                        <i class="fas fa-shield-alt fa-3x mb-3 text-primary"></i>
                        <h3 class="card-title h5">Sistemas de Seguridad</h3>
                        <p class="card-text">Soluciones integrales de videovigilancia y monitoreo para su tranquilidad.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1562516155-e0c1ee44059b" 
                         class="card-img-top" 
                         alt="Control de Acceso">
                    <div class="card-body text-center">
                        <i class="fas fa-key fa-3x mb-3 text-primary"></i>
                        <h3 class="card-title h5">Control de Acceso</h3>
                        <p class="card-text">Sistemas biométricos y tarjetas inteligentes para control de acceso seguro.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31" 
                         class="card-img-top" 
                         alt="Redes y Conectividad">
                    <div class="card-body text-center">
                        <i class="fas fa-network-wired fa-3x mb-3 text-primary"></i>
                        <h3 class="card-title h5">Redes y Conectividad</h3>
                        <p class="card-text">Infraestructura de red robusta y soluciones de conectividad empresarial.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1558002038-1055907df827" 
                         class="card-img-top" 
                         alt="Automatización">
                    <div class="card-body text-center">
                        <i class="fas fa-cogs fa-3x mb-3 text-primary"></i>
                        <h3 class="card-title h5">Automatización</h3>
                        <p class="card-text">Sistemas inteligentes para automatización y control de edificios.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Proyectos Section -->
<section class="projects-section bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Proyectos Destacados</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1581092795360-fd1ca04f0952" 
                         class="card-img-top" 
                         alt="Centro de Monitoreo">
                    <div class="card-body">
                        <h5 class="card-title">Centro de Monitoreo</h5>
                        <p class="card-text">Implementación de centro de monitoreo para empresa de seguridad.</p>
                        <p class="card-text"><small class="text-muted">2024</small></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1541746972996-4e0b0f43e02a" 
                         class="card-img-top" 
                         alt="Control de Acceso Corporativo">
                    <div class="card-body">
                        <h5 class="card-title">Control de Acceso Corporativo</h5>
                        <p class="card-text">Sistema de control de acceso para edificio empresarial.</p>
                        <p class="card-text"><small class="text-muted">2023</small></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    <img src="https://images.unsplash.com/photo-1551703599-6b3e8379aa8b" 
                         class="card-img-top" 
                         alt="Infraestructura de Red">
                    <div class="card-body">
                        <h5 class="card-title">Infraestructura de Red</h5>
                        <p class="card-text">Implementación de red corporativa para multinacional.</p>
                        <p class="card-text"><small class="text-muted">2023</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonios Section -->
<section class="testimonials-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Lo que dicen nuestros clientes</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d" 
                             class="rounded-circle mb-3" 
                             alt="Cliente 1" 
                             width="100">
                        <p class="card-text">"Excelente servicio y profesionalismo en la implementación de nuestro sistema de seguridad."</p>
                        <h5 class="card-title">Juan Pérez</h5>
                        <p class="text-muted">Gerente de Operaciones</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330" 
                             class="rounded-circle mb-3" 
                             alt="Cliente 2" 
                             width="100">
                        <p class="card-text">"La automatización implementada ha mejorado significativamente nuestra eficiencia."</p>
                        <h5 class="card-title">María García</h5>
                        <p class="text-muted">Directora de Tecnología</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" 
                             class="rounded-circle mb-3" 
                             alt="Cliente 3" 
                             width="100">
                        <p class="card-text">"El sistema de control de acceso ha revolucionado la seguridad de nuestras instalaciones."</p>
                        <h5 class="card-title">Carlos Rodríguez</h5>
                        <p class="text-muted">Gerente de Seguridad</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section bg-gradient-primary text-white py-5">
    <div class="container text-center">
        <h2 class="mb-4">¿Listo para comenzar tu proyecto?</h2>
        <p class="lead mb-4">Contáctanos hoy mismo para una consulta gratuita.</p>
        <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-light btn-lg shadow">Solicitar Cotización</a>
    </div>
</section>

<?php
$content = ob_get_clean();
require_once VIEWS_PATH . '/layout/main.php';
?> 