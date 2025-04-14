<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efecinco - Soluciones en Seguridad y Tecnología</title>
    <meta name="description" content="Efecinco ofrece soluciones integrales en seguridad y tecnología, incluyendo cableado estructurado, CCTV, control de acceso y más.">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <img src="assets/images/logo.png" alt="Efecinco Logo">
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="quienes-somos.php">¿Quiénes Somos?</a></li>
                    <li><a href="servicios.php">Servicios</a></li>
                    <li><a href="proyectos.php">Proyectos</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <li class="admin-link">
                            <a href="admin/dashboard.php">
                                <i class="fas fa-user-shield"></i> Panel Admin
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>
    <main>

<style>
.admin-link a {
    color: #25D366;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.admin-link a:hover {
    color: #1da851;
}

@media (max-width: 768px) {
    .admin-link {
        margin-top: 1rem;
        border-top: 1px solid #444;
        padding-top: 1rem;
    }
}
</style>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/whatsapp-button.php'; ?>
</body>
</html> 