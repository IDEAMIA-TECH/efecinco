<?php
require_once('includes/db.php');
$conexion = conectarDB();

// Obtener información de la empresa
$sql = "SELECT * FROM empresa WHERE id = 1";
$resultado = $conexion->query($sql);
$empresa = $resultado->fetch_assoc();

// Obtener clientes destacados
$sql = "SELECT * FROM clientes WHERE destacado = 1 ORDER BY nombre";
$resultado = $conexion->query($sql);
$clientes = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efecinco - Soluciones en Seguridad y Tecnología</title>
    <meta name="description" content="Efecinco ofrece soluciones integrales en seguridad y tecnología para empresas. Expertos en CCTV, control de acceso y más.">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main>
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Empowering Ideas<br>with Technological Excellence</h1>
                    <p>Highly tailored technology, development & support services for your business success.</p>
                    <div class="cta-buttons">
                        <a href="contacto.php" class="btn btn-primary">Get Started</a>
                        <a href="contacto.php" class="btn btn-secondary">Contact Us</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://images.pexels.com/photos/1181696/pexels-photo-1181696.jpeg?auto=compress&w=600&q=80" alt="IT Professional">
                </div>
            </div>
        </section>
        <section class="services-section">
            <div class="services-title">Our IT Services</div>
            <div class="services-grid">
                <div class="service-card">
                    <i class="fas fa-network-wired"></i>
                    <h3>Network Cabling</h3>
                    <p>Professional network solutions for your company.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-video"></i>
                    <h3>CCTV</h3>
                    <p>Next-generation video surveillance systems.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-lock"></i>
                    <h3>Access Control</h3>
                    <p>Secure management of access to your facilities.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-bell"></i>
                    <h3>Alarm Systems</h3>
                    <p>Comprehensive protection for your home or business.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-robot"></i>
                    <h3>Automation</h3>
                    <p>Smart solutions for your space.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-volume-up"></i>
                    <h3>Audio Systems</h3>
                    <p>Professional sound experience.</p>
                </div>
            </div>
        </section>
        <section class="stats-section">
            <div class="stats-title">We run all kinds of IT services that wow your success</div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">24+</div>
                    <div class="stat-label">Years of Experience</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Client Satisfaction</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">6795+</div>
                    <div class="stat-label">Projects Delivered</div>
                </div>
            </div>
        </section>
        <section class="dark-section">
            <h2>Technological Applications Play a Role in Improving Our Community</h2>
            <p>Accelerate innovation with world-class tech teams. We'll match you to vetted senior remote technology talent.</p>
            <a href="contacto.php" class="btn btn-primary">Request a Quote</a>
        </section>
    </main>

    <style>
        body {
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            background: #f4f8fb;
            color: #222;
        }
        .hero {
            background: linear-gradient(135deg, #0a2e73 0%, #1e90ff 100%);
            position: relative;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            overflow: hidden;
        }
        .hero .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 1200px;
            padding: 60px 30px 60px 30px;
        }
        .hero-content {
            flex: 1 1 50%;
            color: #fff;
            text-align: left;
            z-index: 2;
        }
        .hero-content h1 {
            font-size: 3.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.1;
        }
        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 35px;
            color: #e0eaff;
        }
        .cta-buttons {
            display: flex;
            gap: 18px;
        }
        .btn {
            padding: 15px 32px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(30,144,255,0.08);
        }
        .btn-primary {
            background: #fff;
            color: #1e90ff;
        }
        .btn-primary:hover {
            background: #e0eaff;
        }
        .btn-secondary {
            background: transparent;
            color: #fff;
            border: 2px solid #fff;
        }
        .btn-secondary:hover {
            background: #1e90ff;
            color: #fff;
            border-color: #1e90ff;
        }
        .hero-image {
            flex: 1 1 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }
        .hero-image img {
            width: 370px;
            height: 470px;
            object-fit: cover;
            border-radius: 30px 30px 120px 30px;
            box-shadow: 0 8px 32px rgba(10,46,115,0.18);
            background: #fff;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -120px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, #fff 0%, #1e90ff00 80%);
            opacity: 0.18;
            z-index: 1;
        }
        .services-section {
            background: #fff;
            margin-top: -80px;
            border-radius: 30px;
            box-shadow: 0 8px 32px rgba(30,144,255,0.08);
            padding: 60px 0 40px 0;
            position: relative;
            z-index: 3;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        .services-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 40px;
            color: #0a2e73;
        }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 32px;
            margin: 0 30px;
        }
        .service-card {
            background: #f4f8fb;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(30,144,255,0.07);
            padding: 36px 24px 28px 24px;
            text-align: center;
            transition: box-shadow 0.2s, transform 0.2s;
            position: relative;
        }
        .service-card:hover {
            box-shadow: 0 8px 32px rgba(30,144,255,0.13);
            transform: translateY(-6px) scale(1.03);
        }
        .service-card i {
            font-size: 2.8rem;
            color: #1e90ff;
            margin-bottom: 18px;
        }
        .service-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0a2e73;
            margin-bottom: 10px;
        }
        .service-card p {
            color: #555;
            font-size: 1rem;
        }
        /* Sección de estadísticas */
        .stats-section {
            background: #f4f8fb;
            padding: 60px 0 30px 0;
            text-align: center;
        }
        .stats-title {
            font-size: 2.1rem;
            color: #0a2e73;
            font-weight: 700;
            margin-bottom: 18px;
        }
        .stats-grid {
            display: flex;
            justify-content: center;
            gap: 60px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        .stat-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(30,144,255,0.07);
            padding: 36px 32px 28px 32px;
            min-width: 220px;
            text-align: center;
        }
        .stat-number {
            font-size: 2.5rem;
            color: #1e90ff;
            font-weight: 700;
        }
        .stat-label {
            color: #0a2e73;
            font-size: 1.1rem;
            margin-top: 8px;
        }
        /* Sección fondo oscuro */
        .dark-section {
            background: linear-gradient(135deg, #0a2e73 0%, #1e90ff 100%);
            color: #fff;
            padding: 70px 0 60px 0;
            text-align: center;
            border-radius: 30px;
            margin: 60px 0 0 0;
        }
        .dark-section h2 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 18px;
        }
        .dark-section p {
            font-size: 1.1rem;
            color: #e0eaff;
            margin-bottom: 30px;
        }
        .dark-section .btn {
            background: #fff;
            color: #1e90ff;
            border: none;
        }
        .dark-section .btn:hover {
            background: #e0eaff;
        }
        /* Responsive */
        @media (max-width: 900px) {
            .hero .container {
                flex-direction: column;
                text-align: center;
                padding: 40px 10px 40px 10px;
            }
            .hero-content, .hero-image {
                flex: 1 1 100%;
                margin: 0;
            }
            .hero-image {
                margin-top: 30px;
            }
        }
        @media (max-width: 600px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            .services-title, .dark-section h2, .stats-title {
                font-size: 1.3rem;
            }
            .service-card {
                padding: 20px 10px 18px 10px;
            }
            .stat-card {
                padding: 20px 10px 18px 10px;
            }
            .dark-section {
                padding: 40px 0 30px 0;
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