<?php
// Obtener la información de contacto desde la base de datos
$db = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
    DB_USER,
    DB_PASS
);

try {
    // Obtener información de contacto
    $stmt = $db->query("SELECT * FROM contact_info WHERE id = 1");
    $contactInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    // Obtener redes sociales
    $stmt = $db->query("SELECT * FROM social_media");
    $socialMedia = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('Error al obtener información del footer: ' . $e->getMessage());
    $contactInfo = [
        'address' => 'Calle 123 #45-67, Bogotá, Colombia',
        'phone' => '+57 1 234 5678',
        'email' => 'contacto@efecinco.com',
        'business_hours' => 'Lunes a Viernes: 8:00 AM - 6:00 PM'
    ];
    $socialMedia = [
        ['platform' => 'facebook', 'url' => 'https://facebook.com/efecinco'],
        ['platform' => 'instagram', 'url' => 'https://instagram.com/efecinco'],
        ['platform' => 'linkedin', 'url' => 'https://linkedin.com/company/efecinco']
    ];
}
?>

<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Contacto</h5>
                <p>
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <?php echo htmlspecialchars($contactInfo['address']); ?>
                </p>
                <p>
                    <i class="fas fa-phone me-2"></i>
                    <?php echo htmlspecialchars($contactInfo['phone']); ?>
                </p>
                <p>
                    <i class="fas fa-envelope me-2"></i>
                    <?php echo htmlspecialchars($contactInfo['email']); ?>
                </p>
            </div>
            <div class="col-md-4">
                <h5>Horario</h5>
                <p><?php echo htmlspecialchars($contactInfo['business_hours']); ?></p>
            </div>
            <div class="col-md-4">
                <h5>Síguenos</h5>
                <div class="social-links">
                    <?php foreach ($socialMedia as $social): ?>
                        <a href="<?php echo htmlspecialchars($social['url']); ?>" class="text-white me-2" target="_blank">
                            <i class="fab fa-<?php echo htmlspecialchars($social['platform']); ?>"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</footer> 