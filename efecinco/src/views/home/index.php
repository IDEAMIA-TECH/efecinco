<?php
// El buffer y el layout se manejan en main.php
?>

<div class="bg-white">
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="<?php echo SITE_URL; ?>/assets/images/logo/logof5.png" 
                         alt="Efe Cinco Logo" 
                         class="img-fluid mb-4" 
                         style="max-width: 300px;">
                    <h1 class="display-4 fw-bold">Soluciones en Seguridad y Tecnología</h1>
                    <p class="lead">Protegiendo tu presente, construyendo tu futuro</p>
                    <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-primary btn-lg">Contáctanos</a>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&h=400&q=80" 
                         alt="Seguridad y Tecnología" 
                         class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Nuestros Servicios</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                            <h3 class="h4 mb-3">Sistemas de Seguridad</h3>
                            <p class="card-text">Soluciones integrales de videovigilancia y monitoreo para su tranquilidad.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-key fa-3x text-primary mb-3"></i>
                            <h3 class="h4 mb-3">Control de Acceso</h3>
                            <p class="card-text">Sistemas biométricos y tarjetas inteligentes para control de acceso seguro.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-network-wired fa-3x text-primary mb-3"></i>
                            <h3 class="h4 mb-3">Redes y Conectividad</h3>
                            <p class="card-text">Infraestructura de red robusta y soluciones de conectividad empresarial.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Proyectos Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Proyectos Destacados</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <h3 class="h4 mb-3">Centro de Monitoreo</h3>
                            <p class="card-text">Implementación de centro de monitoreo para empresa de seguridad.</p>
                            <a href="<?php echo SITE_URL; ?>/proyectos" class="btn btn-outline-primary">Ver más</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <h3 class="h4 mb-3">Control de Acceso Corporativo</h3>
                            <p class="card-text">Sistema de control de acceso para edificio empresarial.</p>
                            <a href="<?php echo SITE_URL; ?>/proyectos" class="btn btn-outline-primary">Ver más</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <h3 class="h4 mb-3">Infraestructura de Red</h3>
                            <p class="card-text">Implementación de red corporativa para multinacional.</p>
                            <a href="<?php echo SITE_URL; ?>/proyectos" class="btn btn-outline-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-4">¿Listo para comenzar tu proyecto?</h2>
                    <p class="lead mb-4">Contáctanos hoy mismo para una consulta gratuita.</p>
                    <a href="<?php echo SITE_URL; ?>/contacto" class="btn btn-primary btn-lg">Solicitar Cotización</a>
                </div>
            </div>
        </div>
    </section>
</div> 