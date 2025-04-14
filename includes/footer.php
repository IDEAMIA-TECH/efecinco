    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Dirección: [Dirección de la empresa]</li>
                        <li><i class="fas fa-phone me-2"></i> Teléfono: [Teléfono de contacto]</li>
                        <li><i class="fas fa-envelope me-2"></i> Email: <?php echo ADMIN_EMAIL; ?></li>
                    </ul>
                </div>
                
                <div class="col-md-4 mb-4">
                    <h5>Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo SITE_URL; ?>/services.php" class="text-light">Servicios</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/projects.php" class="text-light">Proyectos</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/team.php" class="text-light">Equipo</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/contact.php" class="text-light">Contacto</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 mb-4">
                    <h5>Redes Sociales</h5>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="<?php echo SITE_URL; ?>/privacy.php" class="text-light me-3">Política de Privacidad</a>
                    <a href="<?php echo SITE_URL; ?>/terms.php" class="text-light">Términos y Condiciones</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo SITE_URL; ?>/assets/js/main.js"></script>
</body>
</html> 