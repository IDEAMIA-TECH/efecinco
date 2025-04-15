<?php
include('includes/header.php');
?>

<section class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1520869562399-e772f042f422?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') no-repeat center center; background-size: cover;">
    <div class="container">
        <div class="hero-content">
            <h1>Soluciones en Seguridad y Tecnología</h1>
            <p>Expertos en implementación de sistemas de seguridad y tecnología para tu empresa</p>
            <div class="cta-buttons">
                <a href="contacto.php" class="btn btn-primary">Contáctanos</a>
                <a href="contacto.php" class="btn btn-secondary">Solicita una cotización</a>
            </div>
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
                    <img src="https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="CCTV">
                </div>
                <i class="fas fa-video"></i>
                <h3>CCTV</h3>
                <p>Sistemas de videovigilancia de última generación</p>
            </div>
            <div class="servicio-card">
                <div class="servicio-imagen">
                    <img src="https://images.unsplash.com/photo-1516992654410-9309d4587e94?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Control de Acceso">
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

<section class="testimonios">
    <div class="container">
        <h2>Lo que dicen nuestros clientes</h2>
        <div class="testimonios-carousel">
            <?php
            require_once('includes/db.php');
            $conexion = conectarDB();
            
            // Verificar la conexión
            if (!$conexion) {
                echo '<div class="alert alert-danger">Error al conectar con la base de datos</div>';
            } else {
                $sql = "SELECT * FROM testimonios WHERE activo = 1 AND destacado = 1 ORDER BY fecha_creacion DESC LIMIT 5";
                $stmt = consultaSegura($conexion, $sql, []);
                
                if ($stmt) {
                    $result = $stmt->get_result();
                    $testimonios = $result->fetch_all(MYSQLI_ASSOC);
                    
                    if (empty($testimonios)) {
                        echo '<div class="alert alert-info">No hay testimonios destacados disponibles</div>';
                    } else {
                        foreach ($testimonios as $testimonio):
                        ?>
                        <div class="testimonio-card">
                            <div class="testimonio-content">
                                <div class="testimonio-text">
                                    <i class="fas fa-quote-left"></i>
                                    <p><?php echo htmlspecialchars($testimonio['testimonio']); ?></p>
                                </div>
                                <div class="testimonio-author">
                                    <?php if ($testimonio['imagen']): ?>
                                        <img src="<?php echo htmlspecialchars($testimonio['imagen']); ?>" alt="<?php echo htmlspecialchars($testimonio['cliente']); ?>" class="author-image">
                                    <?php else: ?>
                                        <div class="author-image default">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="author-info">
                                        <h4><?php echo htmlspecialchars($testimonio['cliente']); ?></h4>
                                        <?php if ($testimonio['cargo']): ?>
                                            <p class="cargo"><?php echo htmlspecialchars($testimonio['cargo']); ?></p>
                                        <?php endif; ?>
                                        <?php if ($testimonio['empresa']): ?>
                                            <p class="empresa"><?php echo htmlspecialchars($testimonio['empresa']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        endforeach;
                    }
                } else {
                    echo '<div class="alert alert-danger">Error al ejecutar la consulta</div>';
                }
            }
            ?>
        </div>
        <div class="testimonios-controls">
            <button class="prev-testimonio"><i class="fas fa-chevron-left"></i></button>
            <button class="next-testimonio"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
</section>

<style>
.hero {
    color: white;
    text-align: center;
    padding: 200px 0;
    margin-bottom: 60px;
    position: relative;
}

.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 100%);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
}

.hero h1 {
    font-size: 3.5rem;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 30px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
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

.testimonios {
    padding: 80px 0;
    background-color: #f8f9fa;
}

.testimonios h2 {
    text-align: center;
    margin-bottom: 40px;
    color: #333;
}

.testimonios-carousel {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
    overflow: hidden;
}

.testimonio-card {
    background: white;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin: 0 15px;
    transition: transform 0.3s ease;
}

.testimonio-card:hover {
    transform: translateY(-5px);
}

.testimonio-content {
    text-align: center;
}

.testimonio-text {
    margin-bottom: 20px;
    position: relative;
}

.testimonio-text i {
    color: #00B4DB;
    font-size: 2rem;
    margin-bottom: 15px;
}

.testimonio-text p {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #666;
    font-style: italic;
}

.testimonio-author {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.author-image {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
}

.author-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-image.default {
    background-color: #00B4DB;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.author-image.default i {
    font-size: 1.5rem;
}

.author-info h4 {
    margin: 0;
    color: #333;
}

.author-info p {
    margin: 5px 0 0;
    color: #666;
    font-size: 0.9rem;
}

.testimonios-controls {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}

.testimonios-controls button {
    background: #00B4DB;
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
}

.testimonios-controls button:hover {
    background: #0099b8;
    transform: scale(1.1);
}

.alert {
    padding: 15px;
    margin: 20px 0;
    border-radius: 5px;
    text-align: center;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert-info {
    background-color: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
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
    
    .testimonio-card {
        margin: 0 10px;
        padding: 20px;
    }
    
    .testimonio-text p {
        font-size: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.testimonios-carousel');
    const cards = document.querySelectorAll('.testimonio-card');
    const prevBtn = document.querySelector('.prev-testimonio');
    const nextBtn = document.querySelector('.next-testimonio');
    
    if (cards.length > 0) {
        let currentIndex = 0;
        
        function showTestimonio(index) {
            cards.forEach((card, i) => {
                card.style.display = i === index ? 'block' : 'none';
            });
        }
        
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + cards.length) % cards.length;
            showTestimonio(currentIndex);
        });
        
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % cards.length;
            showTestimonio(currentIndex);
        });
        
        // Show first testimonio initially
        showTestimonio(currentIndex);
    } else {
        // Hide controls if no testimonios
        document.querySelector('.testimonios-controls').style.display = 'none';
    }
});
</script>

<?php
include('includes/footer.php');
?> 