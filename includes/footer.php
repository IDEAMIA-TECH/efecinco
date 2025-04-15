<?php
require_once __DIR__ . '/db.php';

// Conexión a la base de datos
$conexion = conectarDB();

// Obtener información de la empresa
$query = "SELECT facebook, instagram, linkedin, whatsapp, email, telefono, direccion, horario FROM empresa WHERE id = 1";
$resultado = mysqli_query($conexion, $query);
$empresa = mysqli_fetch_assoc($resultado);
?>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>Contacto</h3>
            <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($empresa['direccion']); ?></p>
            <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($empresa['telefono']); ?></p>
            <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($empresa['email']); ?></p>
            <p><i class="fas fa-clock"></i> <?php echo htmlspecialchars($empresa['horario']); ?></p>
        </div>

        <div class="footer-section">
            <h3>Síguenos</h3>
            <div class="social-links">
                <?php if (!empty($empresa['facebook'])): ?>
                    <a href="<?php echo htmlspecialchars($empresa['facebook']); ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($empresa['instagram'])): ?>
                    <a href="<?php echo htmlspecialchars($empresa['instagram']); ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-instagram"></i>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($empresa['linkedin'])): ?>
                    <a href="<?php echo htmlspecialchars($empresa['linkedin']); ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($empresa['whatsapp'])): ?>
                    <a href="https://wa.me/<?php echo htmlspecialchars($empresa['whatsapp']); ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="footer-section">
            <h3>Enlaces Rápidos</h3>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="quienes-somos.php">Quiénes Somos</a></li>
                <li><a href="servicios.php">Servicios</a></li>
                <li><a href="proyectos.php">Proyectos</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Efecinco. Todos los derechos reservados.</p>
    </div>
</footer>

<style>
.footer {
    background: linear-gradient(90deg, #00B4DB 0%, #0072ff 100%);
    color: #fff;
    padding: 3rem 0 1rem;
    margin-top: 4rem;
    font-family: 'Montserrat', Arial, Helvetica, sans-serif;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.footer-section h3 {
    color: #fff;
    margin-bottom: 1.5rem;
    font-size: 1.2rem;
    letter-spacing: 1px;
    font-weight: 700;
}

.footer-section p {
    margin-bottom: 0.8rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.footer-section i {
    color: #fff;
    width: 20px;
}

.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.social-links a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: #fff;
    border-radius: 50%;
    color: #0072ff;
    font-size: 1.3rem;
    box-shadow: 0 2px 8px rgba(0,180,219,0.10);
    transition: all 0.3s;
}

.social-links a:hover {
    background: linear-gradient(90deg, #00B4DB 0%, #0072ff 100%);
    color: #fff;
    transform: translateY(-3px) scale(1.08);
    box-shadow: 0 6px 18px rgba(0,114,255,0.18);
}

.social-links a[href*='whatsapp'] {
    background: #25D366;
    color: #fff;
}

.social-links a[href*='whatsapp']:hover {
    background: #128C7E;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 0.8rem;
}

.footer-section ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

.footer-section ul li a:hover {
    color: #00B4DB;
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    margin-top: 2rem;
    border-top: 1px solid #fff3;
    font-size: 1rem;
    letter-spacing: 1px;
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }
    .footer-section p {
        justify-content: center;
    }
    .social-links {
        justify-content: center;
    }
}
</style> 