<?php
include('includes/header.php');
?>

<section class="hero">
    <div class="container">
        <h1>Soluciones en Seguridad y Tecnología</h1>
        <p>Expertos en implementación de sistemas de seguridad y tecnología para tu empresa</p>
        <div class="cta-buttons">
            <a href="contacto.php" class="btn btn-primary">Contáctanos</a>
            <a href="contacto.php" class="btn btn-secondary">Solicita una cotización</a>
        </div>
    </div>
</section>

<section class="servicios-destacados">
    <div class="container">
        <h2>Nuestros Servicios</h2>
        <div class="servicios-grid">
            <div class="servicio-card">
                <i class="fas fa-network-wired"></i>
                <h3>Cableado Estructurado</h3>
                <p>Soluciones de red profesional para tu empresa</p>
            </div>
            <div class="servicio-card">
                <i class="fas fa-video"></i>
                <h3>CCTV</h3>
                <p>Sistemas de videovigilancia de última generación</p>
            </div>
            <div class="servicio-card">
                <i class="fas fa-lock"></i>
                <h3>Control de Acceso</h3>
                <p>Gestión segura de accesos a tus instalaciones</p>
            </div>
        </div>
    </div>
</section>

<section class="proyectos-destacados">
    <div class="container">
        <h2>Proyectos Destacados</h2>
        <div class="proyectos-grid">
            <!-- Los proyectos se cargarán dinámicamente desde la base de datos -->
        </div>
    </div>
</section>

<?php
include('includes/footer.php');
?> 