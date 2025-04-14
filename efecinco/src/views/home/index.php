<?php
// Iniciamos el buffer de salida
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
                <img src="https://images.unsplash.com/photo-1557683316-973673baf926" 
                     alt="Tecnología de seguridad" 
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
                    <div class="image-container" style="height: 200px; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1557683311-eac922347aa1" 
                             class="card-img-top" 
                             alt="Sistemas de Seguridad"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body text-center">
                        <i class="fas fa-shield-alt fa-3x mb-3 text-primary"></i>
                        <h3 class="card-title h5">Sistemas de Seguridad</h3>
                        <p class="card-text">Soluciones integrales de videovigilancia y monitoreo para su tranquilidad.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="image-container" style="height: 200px; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1558002038-1055907df827" 
                             class="card-img-top" 
                             alt="Control de Acceso"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body text-center">
                        <i class="fas fa-key fa-3x mb-3 text-primary"></i>
                        <h3 class="card-title h5">Control de Acceso</h3>
                        <p class="card-text">Sistemas biométricos y tarjetas inteligentes para control de acceso seguro.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="image-container" style="height: 200px; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1573164713714-d95e436ab8d6" 
                             class="card-img-top" 
                             alt="Redes y Conectividad"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body text-center">
                        <i class="fas fa-network-wired fa-3x mb-3 text-primary"></i>
                        <h3 class="card-title h5">Redes y Conectividad</h3>
                        <p class="card-text">Infraestructura de red robusta y soluciones de conectividad empresarial.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="image-container" style="height: 200px; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f" 
                             class="card-img-top" 
                             alt="Automatización"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
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
                    <div class="image-container" style="height: 250px; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1581092795360-fd1ca04f0952" 
                             class="card-img-top" 
                             alt="Centro de Monitoreo"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Centro de Monitoreo</h5>
                        <p class="card-text">Implementación de centro de monitoreo para empresa de seguridad.</p>
                        <p class="card-text"><small class="text-muted">2024</small></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    <div class="image-container" style="height: 250px; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1541746972996-4e0b0f43e02a" 
                             class="card-img-top" 
                             alt="Control de Acceso Corporativo"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Control de Acceso Corporativo</h5>
                        <p class="card-text">Sistema de control de acceso para edificio empresarial.</p>
                        <p class="card-text"><small class="text-muted">2023</small></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    <div class="image-container" style="height: 250px; overflow: hidden;">
                        <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31" 
                             class="card-img-top" 
                             alt="Infraestructura de Red"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
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
                        <div class="testimonial-image-container mb-4">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d" 
                                 class="rounded-circle" 
                                 alt="Cliente 1" 
                                 style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #f8f9fa; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        </div>
                        <p class="card-text">"Excelente servicio y profesionalismo en la implementación de nuestro sistema de seguridad."</p>
                        <h5 class="card-title">Juan Pérez</h5>
                        <p class="text-muted">Gerente de Operaciones</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="testimonial-image-container mb-4">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330" 
                                 class="rounded-circle" 
                                 alt="Cliente 2" 
                                 style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #f8f9fa; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        </div>
                        <p class="card-text">"La automatización implementada ha mejorado significativamente nuestra eficiencia."</p>
                        <h5 class="card-title">María García</h5>
                        <p class="text-muted">Directora de Tecnología</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="testimonial-image-container mb-4">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" 
                                 class="rounded-circle" 
                                 alt="Cliente 3" 
                                 style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #f8f9fa; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        </div>
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
<section class="cta-section bg-gradient-primary text-black py-5">
    <div class="container text-center">
        <h2 class="mb-4">¿Listo para comenzar tu proyecto?</h2>
        <p class="lead mb-4">Contáctanos hoy mismo para una consulta gratuita.</p>
        <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-light btn-lg shadow">Solicitar Cotización</a>
    </div>
</section>

<?php
// Solo obtenemos el contenido del buffer, el layout se manejará en el controlador
$content = ob_get_clean();
return $content;
?> 