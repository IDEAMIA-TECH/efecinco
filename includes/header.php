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
    <style>
        .header {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }

        .logo {
            display: flex;
            align-items: center;
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
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #00B4DB;
        }

        .mobile-menu {
            display: none;
            font-size: 24px;
            cursor: pointer;
        }

        main {
            margin-top: 80px; /* Igual a la altura del header */
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
                background: white;
                padding: 20px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
            color: #00B4DB;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .admin-link a:hover, .login-link a:hover {
            color: #0083a3;
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
        });
    </script>
</body>
</html> 