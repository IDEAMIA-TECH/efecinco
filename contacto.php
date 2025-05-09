<?php
require_once('includes/db.php');
$conexion = conectarDB();

$mensaje = '';
$tipo_mensaje = '';

// Procesar el formulario de contacto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $empresa = $_POST['empresa'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';
    $captcha = $_POST['captcha'] ?? '';
    $captcha_respuesta = $_POST['captcha_respuesta'] ?? '';

    // Validar campos requeridos
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        $mensaje = 'Por favor complete todos los campos requeridos';
        $tipo_mensaje = 'danger';
    } 
    // Validar email
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = 'Por favor ingrese un email válido';
        $tipo_mensaje = 'danger';
    }
    // Validar captcha
    elseif ($captcha !== $captcha_respuesta) {
        $mensaje = 'La respuesta del captcha es incorrecta';
        $tipo_mensaje = 'danger';
    } else {
        // Guardar en la base de datos
        $sql = "INSERT INTO contactos (nombre, empresa, email, telefono, mensaje) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = consultaSegura($conexion, $sql, [$nombre, $empresa, $email, $telefono, $mensaje]);
        
        if ($stmt->affected_rows > 0) {
            // Enviar email de notificación
            $asunto = "Nuevo mensaje de contacto - Efecinco";
            $cuerpo = "Nombre: $nombre\n";
            $cuerpo .= "Empresa: $empresa\n";
            $cuerpo .= "Email: $email\n";
            $cuerpo .= "Teléfono: $telefono\n";
            $cuerpo .= "Mensaje: $mensaje\n";
            
            $headers = "From: $email\r\n";
            $headers .= "Reply-To: $email\r\n";
            
            mail("contacto@efecinco.com", $asunto, $cuerpo, $headers);
            
            $mensaje = 'Gracias por contactarnos. Nos pondremos en contacto contigo pronto.';
            $tipo_mensaje = 'success';
        } else {
            $mensaje = 'Hubo un error al enviar el mensaje. Por favor intente nuevamente.';
            $tipo_mensaje = 'danger';
        }
    }
}

// Generar captcha
$num1 = rand(1, 10);
$num2 = rand(1, 10);
$captcha_respuesta = $num1 + $num2;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Efecinco</title>
    <meta name="description" content="Contáctanos para conocer más sobre nuestras soluciones en seguridad y tecnología.">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main>
       

        <section class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1520869562399-e772f042f422?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') no-repeat center center; background-size: cover;">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-logo-wrapper">
                        <img src="assets/images/logof5.png" alt="Logo F5" class="hero-logo">
                    </div>
                    <h1>Contacto</h1>
                <p>Estamos aquí para ayudarte. Envíanos un mensaje y nos pondremos en contacto contigo.</p>
                   
                </div>
            </div>
        </section>

        <section class="contacto">
            <div class="container">
                <div class="contacto-grid">
                    <div class="contacto-form">
                        <h2>Envíanos un mensaje</h2>
                        
                        <?php if ($mensaje): ?>
                            <div class="alert alert-<?php echo $tipo_mensaje; ?>">
                                <?php echo htmlspecialchars($mensaje); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="nombre">Nombre *</label>
                                <input type="text" id="nombre" name="nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="empresa">Empresa</label>
                                <input type="text" id="empresa" name="empresa">
                            </div>

                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="tel" id="telefono" name="telefono">
                            </div>

                            <div class="form-group">
                                <label for="mensaje">Mensaje *</label>
                                <textarea id="mensaje" name="mensaje" rows="5" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="captcha">¿Cuánto es <?php echo $num1; ?> + <?php echo $num2; ?>? *</label>
                                <input type="number" id="captcha" name="captcha" required>
                                <input type="hidden" name="captcha_respuesta" value="<?php echo $captcha_respuesta; ?>">
                            </div>

                            <button type="submit" class="btn btn-primary">Enviar mensaje</button>
                        </form>
                    </div>

                    <div class="contacto-info">
                        <h2>Información de contacto</h2>
                        
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h3>Dirección</h3>
                                <p>Sandías 1153B, La Tuzania, 44150 Zapopan, Jal.</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h3>Teléfono</h3>
                                <p>+52 33 3146 2579</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h3>Email</h3>
                                <p>ventas@efecinco.com</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h3>Horario de atención</h3>
                                <p>Lunes a Viernes: 9:00 - 18:00</p>
                                <p>Sábados: 9:00 - 12:00</p>
                            </div>
                        </div>

                        <div class="contacto-item">
                            <div class="contacto-icono">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="contacto-info">
                                <h3>WhatsApp</h3>
                                <p>+52 33 3146 2579</p>
                                <a href="https://wa.me/523331462579" target="_blank" class="btn btn-whatsapp">
                                    <i class="fab fa-whatsapp"></i> Enviar mensaje
                                </a>
                            </div>
                        </div>

                        <div class="mapa">
                            <iframe 
                                src="https://www.google.com/maps?q=Sand%C3%ADas+1153B,+La+Tuzania,+44150+Zapopan,+Jal.&output=embed"
                                width="100%" 
                                height="300" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 0;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .contacto {
            padding: 80px 0;
        }

        .contacto-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .contacto-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .contacto-form h2 {
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .contacto-info {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .info-item i {
            font-size: 1.5rem;
            color: #007bff;
            margin-right: 15px;
            margin-top: 5px;
        }

        .info-item h3 {
            margin-bottom: 5px;
            color: #333;
        }

        .info-item p {
            color: #666;
            margin: 0;
        }

        .contacto-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .contacto-icono {
            background: #007bff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .contacto-info {
            flex: 1;
        }

        .contacto-info h3 {
            margin-bottom: 5px;
            color: #333;
        }

        .contacto-info p {
            color: #666;
            margin: 0;
        }

        .btn-whatsapp {
            background: #25d366;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .mapa {
            margin-top: 30px;
            border-radius: 10px;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .contacto-grid {
                grid-template-columns: 1fr;
            }

            .hero {
                padding: 60px 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }
        }
        .hero-logo-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.95);
            border-radius: 50%;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0,114,255,0.25), 0 2px 8px rgba(0,180,219,0.15);
            border: 4px solid #00B4DB;
            transition: transform 0.3s, box-shadow 0.3s;
            animation: logo-glow 2s infinite alternate;
            max-width: 320px;
            margin: 0 auto 30px auto;
        }
        .hero-logo {
            max-width: 180px;
            max-height: 180px;
            width: auto;
            height: auto;
            display: block;
            border-radius: 0;
            box-shadow: none;
            background: none;
            padding: 0;
        }
        @keyframes logo-glow {
            from {
                box-shadow: 0 8px 32px rgba(0,114,255,0.25), 0 2px 8px rgba(0,180,219,0.15);
            }
            to {
                box-shadow: 0 0 40px 10px #00B4DB, 0 2px 8px rgba(0,180,219,0.25);
            }
        }
    </style>
</body>
</html> 