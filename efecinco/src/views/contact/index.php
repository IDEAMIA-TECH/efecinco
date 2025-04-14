<?php
// El buffer y el layout se manejan en main.php
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
                    <h1 class="display-4 fw-bold">Contáctanos</h1>
                    <p class="lead">Estamos aquí para ayudarte con tus necesidades de seguridad y tecnología</p>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&h=400&q=80" 
                         alt="Contacto" 
                         class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Formulario de Contacto -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Formulario -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="h3 mb-4">Envíanos un mensaje</h2>
                            <form action="/contacto/enviar" method="POST" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre completo</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>

                                <div class="mb-3">
                                    <label for="empresa" class="form-label">Empresa</label>
                                    <input type="text" class="form-control" id="empresa" name="empresa">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono">
                                </div>

                                <div class="mb-3">
                                    <label for="mensaje" class="form-label">Mensaje</label>
                                    <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITE_KEY; ?>"></div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    Enviar mensaje
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Información de Contacto -->
                <div class="col-lg-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h2 class="h3 mb-4">Información de contacto</h2>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                                <div>
                                    <h5 class="mb-1">Dirección</h5>
                                    <p class="mb-0"><?php echo $config['contact_info']['direccion']; ?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-phone text-primary me-3 mt-1"></i>
                                <div>
                                    <h5 class="mb-1">Teléfono</h5>
                                    <p class="mb-0"><?php echo $config['contact_info']['telefono']; ?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-envelope text-primary me-3 mt-1"></i>
                                <div>
                                    <h5 class="mb-1">Email</h5>
                                    <p class="mb-0"><?php echo $config['contact_info']['email']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Horarios de Atención -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h2 class="h3 mb-4">Horarios de atención</h2>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Lunes a Viernes:</span>
                                <span class="fw-bold"><?php echo $config['contact_info']['horario_laboral']; ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Sábados:</span>
                                <span class="fw-bold">9:00 AM - 2:00 PM</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Domingos:</span>
                                <span class="fw-bold">Cerrado</span>
                            </div>
                        </div>
                    </div>

                    <!-- Mapa -->
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="h3 mb-4">Ubicación</h2>
                            <div class="ratio ratio-16x9">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.7854!2d-74.0817!3d4.6097!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDM2JzM0LjkiTiA3NMKwMDQnNTQuMSJX!5e0!3m2!1ses!2sco!4v1620000000000!5m2!1ses!2sco"
                                    width="100%"
                                    height="300"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> 