<?php
session_start();
require_once __DIR__ . '/db.php';
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
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/4u89qw1ptzfqell0ybjhqth1cc16ilb1y0792h3momw4lk8l/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        }
        .header {
            background: linear-gradient(90deg, #00B4DB 0%, #0072ff 100%);
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }
        .logo img {
            height: 50px;
            width: auto;
        }
        nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 2rem;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
            letter-spacing: 1px;
        }
        nav a:hover {
            color: #00B4DB;
            background: #fff;
            border-radius: 20px;
            padding: 6px 18px;
        }
        .mobile-menu {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: #fff;
        }
        @media (max-width: 768px) {
            .mobile-menu {
                display: block;
            }
            nav {
                display: none;
                position: absolute;
                top: 80px;
                left: 0;
                width: 100%;
                background: linear-gradient(90deg, #00B4DB 0%, #0072ff 100%);
                padding: 20px 0;
                box-shadow: 0 2px 5px rgba(0,0,0,0.08);
            }
            nav.active {
                display: block;
            }
            nav ul {
                flex-direction: column;
                gap: 1rem;
            }
            .logo img {
                height: 40px;
            }
        }
        .admin-link a, .login-link a {
            color: #fff;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .admin-link a:hover, .login-link a:hover {
            color: #00B4DB;
        }
        .dropdown {
            position: relative;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            min-width: 260px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
            border-radius: 8px;
            padding: 10px 0;
            z-index: 1000;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .dropdown-menu a {
            color: #0072ff;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background 0.3s, color 0.3s;
        }
        .dropdown-menu a:hover {
            background: #e3f0fa;
            color: #00B4DB;
        }
        @media (max-width: 768px) {
            .dropdown-menu {
                position: static;
                box-shadow: none;
                padding: 0;
                display: none;
            }
            .dropdown.active .dropdown-menu {
                display: block;
            }
            .dropdown-menu a {
                padding: 10px 20px;
                border-left: 3px solid #00B4DB;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <img src="assets/images/logof5.png" alt="Efecinco - Sistemas de Seguridad y Tecnología">
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="servicios.php">Servicios</a></li>
                    <li><a href="proyectos.php">Proyectos</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Cotizaciones</a>
                        <ul class="dropdown-menu">
                            <li><a href="cotizacion-camaras.php">Cámaras de Seguridad</a></li>
                            <li><a href="cotizacion-acceso.php">Control de Acceso</a></li>
                            <li><a href="cotizacion-cableado.php">Cableado Estructurado</a></li>
                        </ul>
                    </li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <li class="admin-link">
                            <a href="admin/dashboard.php">
                                <i class="fas fa-user-shield"></i> Panel Admin
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="login-link">
                            <a href="admin/login.php">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenu = document.querySelector('.mobile-menu');
            const nav = document.querySelector('nav');

            mobileMenu.addEventListener('click', function() {
                nav.classList.toggle('active');
                const icon = mobileMenu.querySelector('i');
                icon.classList.toggle('fa-bars');
                icon.classList.toggle('fa-times');
            });

            // Add mobile dropdown functionality
            const dropdowns = document.querySelectorAll('.dropdown');
            
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                
                toggle.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        dropdown.classList.toggle('active');
                    }
                });
            });
        });
    </script>
    <script>
        tinymce.init({
            selector: '.tinymce',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            language: 'es',
            height: 300,
            branding: false
        });
    </script>
</body>
</html> 