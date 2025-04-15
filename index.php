<?php
include('includes/header.php');
?>

<section class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1557862921-37829c7c0958?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') no-repeat center center; background-size: cover;">
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
                <div class="servicio-imagen">
                    <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Cableado Estructurado">
                </div>
                <i class="fas fa-network-wired"></i>
                <h3>Cableado Estructurado</h3>
                <p>Soluciones de red profesional para tu empresa</p>
            </div>
            <div class="servicio-card">
                <div class="servicio-imagen">
                    <img src="https://images.unsplash.com/photo-1557862921-37829c7c0958?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="CCTV">
                </div>
                <i class="fas fa-video"></i>
                <h3>CCTV</h3>
                <p>Sistemas de videovigilancia de última generación</p>
            </div>
            <div class="servicio-card">
                <div class="servicio-imagen">
                    <img src="https://images.unsplash.com/photo-1558002038-76f45789c4a4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Control de Acceso">
                </div>
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
            <div class="proyecto-card">
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Proyecto Corporativo">
                <div class="proyecto-info">
                    <h3>Centro Corporativo</h3>
                    <p>Implementación de sistema integral de seguridad</p>
                </div>
            </div>
            <div class="proyecto-card">
                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Proyecto Comercial">
                <div class="proyecto-info">
                    <h3>Centro Comercial</h3>
                    <p>Sistema de CCTV y control de acceso</p>
                </div>
            </div>
            <div class="proyecto-card">
                <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Proyecto Industrial">
                <div class="proyecto-info">
                    <h3>Complejo Industrial</h3>
                    <p>Infraestructura de red y seguridad</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero {
    color: white;
    text-align: center;
    padding: 150px 0;
    margin-bottom: 60px;
}

.hero h1 {
    font-size: 3.5rem;
    margin-bottom: 20px;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 30px;
}

.cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
}

.btn {
    padding: 15px 30px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #00B4DB;
    color: white;
}

.btn-secondary {
    background-color: transparent;
    border: 2px solid white;
    color: white;
}

.servicios-destacados, .proyectos-destacados {
    padding: 80px 0;
}

.servicios-grid, .proyectos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.servicio-card {
    text-align: center;
    padding: 30px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.servicio-card:hover {
    transform: translateY(-10px);
}

.servicio-imagen {
    margin-bottom: 20px;
    border-radius: 10px;
    overflow: hidden;
}

.servicio-imagen img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.servicio-card:hover .servicio-imagen img {
    transform: scale(1.1);
}

.servicio-card i {
    font-size: 2.5rem;
    color: #00B4DB;
    margin: 20px 0;
}

.proyecto-card {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.proyecto-card img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.proyecto-card:hover img {
    transform: scale(1.1);
}

.proyecto-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
    color: white;
}

.proyecto-info h3 {
    margin-bottom: 10px;
}

@media (max-width: 768px) {
    .hero h1 {
        font-size: 2.5rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .servicios-grid, .proyectos-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php
include('includes/footer.php');
?> 