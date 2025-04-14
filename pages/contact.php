<?php
// Establecer el título de la página
$pageTitle = 'Contacto';

// Incluir el header
include '../includes/header.php';

// Procesar el formulario de contacto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $subject = sanitize($_POST['subject']);
    $message = sanitize($_POST['message']);
    
    // Validar los datos
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'El nombre es requerido';
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'El email es inválido';
    }
    
    if (empty($message)) {
        $errors[] = 'El mensaje es requerido';
    }
    
    // Si no hay errores, enviar el email
    if (empty($errors)) {
        $to = ADMIN_EMAIL;
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $emailBody = "
            <h2>Nuevo mensaje de contacto</h2>
            <p><strong>Nombre:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Teléfono:</strong> $phone</p>
            <p><strong>Asunto:</strong> $subject</p>
            <p><strong>Mensaje:</strong></p>
            <p>$message</p>
        ";
        
        if (mail($to, "Nuevo mensaje de contacto: $subject", $emailBody, $headers)) {
            flash('success', 'Tu mensaje ha sido enviado correctamente. Nos pondremos en contacto contigo pronto.', 'success');
            redirect('contact');
        } else {
            flash('error', 'Hubo un error al enviar tu mensaje. Por favor, inténtalo de nuevo.', 'danger');
        }
    }
}
?>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <h1 class="text-center mb-5">Contáctanos</h1>
        
        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Información de Contacto</h3>
                        
                        <div class="mb-4">
                            <h5><i class="fas fa-map-marker-alt me-2 text-primary"></i> Dirección</h5>
                            <p class="mb-0">[Dirección de la empresa]</p>
                        </div>
                        
                        <div class="mb-4">
                            <h5><i class="fas fa-phone me-2 text-primary"></i> Teléfono</h5>
                            <p class="mb-0">[Teléfono de contacto]</p>
                        </div>
                        
                        <div class="mb-4">
                            <h5><i class="fas fa-envelope me-2 text-primary"></i> Email</h5>
                            <p class="mb-0"><?php echo ADMIN_EMAIL; ?></p>
                        </div>
                        
                        <div class="mb-4">
                            <h5><i class="fas fa-clock me-2 text-primary"></i> Horario</h5>
                            <p class="mb-0">Lunes a Viernes: 9:00 - 18:00</p>
                            <p class="mb-0">Sábado: 9:00 - 14:00</p>
                        </div>
                        
                        <div class="social-links mt-4">
                            <a href="#" class="me-3"><i class="fab fa-facebook-f fa-2x"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-linkedin-in fa-2x"></i></a>
                            <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Envíanos un Mensaje</h3>
                        
                        <?php if (isset($_SESSION['flash_messages'])): ?>
                            <?php foreach ($_SESSION['flash_messages'] as $message): ?>
                                <div class="alert alert-<?php echo $message['class']; ?>">
                                    <?php echo $message['message']; ?>
                                </div>
                            <?php endforeach; ?>
                            <?php unset($_SESSION['flash_messages']); ?>
                        <?php endif; ?>
                        
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nombre completo</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <div class="invalid-feedback">
                                        Por favor, ingresa tu nombre.
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">
                                        Por favor, ingresa un email válido.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="subject" class="form-label">Asunto</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                    <div class="invalid-feedback">
                                        Por favor, ingresa un asunto.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Mensaje</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                <div class="invalid-feedback">
                                    Por favor, ingresa tu mensaje.
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="ratio ratio-21x9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d[LATITUD]!2d[LONGITUD]!3d[ZOOM]!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzDCsDQzJzUyLjQiTiA2NMKwMDAnMDAuMCJX!5e0!3m2!1ses!2sus!4v1234567890!5m2!1ses!2sus" 
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?> 