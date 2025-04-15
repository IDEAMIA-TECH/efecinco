<?php
require_once('includes/db.php');
require_once('includes/functions.php');

$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = conectarDB();
    
    // Validar y sanitizar datos
    $nombre = limpiarDatos($_POST['nombre'] ?? '');
    $telefono = limpiarDatos($_POST['telefono'] ?? '');
    $email = limpiarDatos($_POST['email'] ?? '');
    $empresa = limpiarDatos($_POST['empresa'] ?? '');
    $referencia = limpiarDatos($_POST['referencia'] ?? '');
    $referencia_otro = limpiarDatos($_POST['referencia_otro'] ?? '');
    
    $direccion = limpiarDatos($_POST['direccion'] ?? '');
    $tipo_propiedad = limpiarDatos($_POST['tipo_propiedad'] ?? '');
    $tipo_propiedad_otro = limpiarDatos($_POST['tipo_propiedad_otro'] ?? '');
    
    $cantidad_camaras = limpiarDatos($_POST['cantidad_camaras'] ?? '');
    $tipo_camaras = limpiarDatos($_POST['tipo_camaras'] ?? '');
    $vision_nocturna = limpiarDatos($_POST['vision_nocturna'] ?? '');
    $visualizacion_remota = limpiarDatos($_POST['visualizacion_remota'] ?? '');
    $almacenamiento = limpiarDatos($_POST['almacenamiento'] ?? '');
    
    $red_electrica = limpiarDatos($_POST['red_electrica'] ?? '');
    $red_internet = limpiarDatos($_POST['red_internet'] ?? '');
    $infraestructura_previo = limpiarDatos($_POST['infraestructura_previo'] ?? '');
    
    $tiempo_instalacion = limpiarDatos($_POST['tiempo_instalacion'] ?? '');
    $horario_contacto = limpiarDatos($_POST['horario_contacto'] ?? '');
    $comentarios = limpiarDatos($_POST['comentarios'] ?? '');
    
    // Validar campos requeridos
    if (empty($nombre) || empty($telefono) || empty($email) || empty($direccion)) {
        $error = "Por favor complete todos los campos requeridos.";
    } else {
        // Insertar en la base de datos
        $sql = "INSERT INTO cotizaciones_camaras (
            nombre, telefono, email, empresa, referencia, referencia_otro,
            direccion, tipo_propiedad, tipo_propiedad_otro,
            cantidad_camaras, tipo_camaras, vision_nocturna, visualizacion_remota, almacenamiento,
            red_electrica, red_internet, infraestructura_previo,
            tiempo_instalacion, horario_contacto, comentarios,
            fecha_creacion, estado
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'pendiente')";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssssssssssssssssss", 
            $nombre, $telefono, $email, $empresa, $referencia, $referencia_otro,
            $direccion, $tipo_propiedad, $tipo_propiedad_otro,
            $cantidad_camaras, $tipo_camaras, $vision_nocturna, $visualizacion_remota, $almacenamiento,
            $red_electrica, $red_internet, $infraestructura_previo,
            $tiempo_instalacion, $horario_contacto, $comentarios
        );
        
        if ($stmt->execute()) {
            // Enviar correos
            enviarCorreoCliente($email, $nombre);
            enviarCorreoAdmin($nombre, $telefono, $email);
            
            $mensaje = "¡Gracias por su cotización! Nos pondremos en contacto con usted pronto.";
        } else {
            $error = "Hubo un error al procesar su solicitud. Por favor intente nuevamente.";
        }
    }
}

function enviarCorreoCliente($email, $nombre) {
    $asunto = "Confirmación de Cotización - Efecinco";
    $mensaje = "Estimado/a $nombre,\n\n";
    $mensaje .= "Hemos recibido su solicitud de cotización para la instalación de cámaras de seguridad.\n";
    $mensaje .= "Uno de nuestros asesores se pondrá en contacto con usted en breve.\n\n";
    $mensaje .= "Saludos cordiales,\n";
    $mensaje .= "Equipo Efecinco";
    
    $headers = "From: cotizaciones@efecinco.com.mx\r\n";
    $headers .= "Reply-To: cotizaciones@efecinco.com.mx\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    mail($email, $asunto, $mensaje, $headers);
}

function enviarCorreoAdmin($nombre, $telefono, $email) {
    $asunto = "Nueva Cotización de Cámaras";
    $mensaje = "Se ha recibido una nueva cotización:\n\n";
    $mensaje .= "Nombre: $nombre\n";
    $mensaje .= "Teléfono: $telefono\n";
    $mensaje .= "Email: $email\n\n";
    $mensaje .= "Por favor revise el panel de administración para más detalles.";
    
    $headers = "From: sistema@efecinco.com.mx\r\n";
    $headers .= "Reply-To: sistema@efecinco.com.mx\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    mail("admin@efecinco.com.mx", $asunto, $mensaje, $headers);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización de Cámaras de Seguridad - Efecinco</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main>
        <section class="cotizacion-form">
            <div class="container">
                <h1>Cotización de Cámaras de Seguridad</h1>
                <?php if ($mensaje): ?>
                    <div class="alert alert-success"><?php echo $mensaje; ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="" class="form-cotizacion">
                    <div class="form-section">
                        <h2>1. Información General</h2>
                        <div class="form-group">
                            <label for="nombre">Nombre completo del cliente *</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono de contacto *</label>
                            <input type="tel" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="empresa">Empresa (si aplica)</label>
                            <input type="text" id="empresa" name="empresa">
                        </div>
                        <div class="form-group">
                            <label>¿Cómo se enteró de nosotros? *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="referencia" value="Google" required> Google</label>
                                <label><input type="radio" name="referencia" value="Redes Sociales"> Redes Sociales</label>
                                <label><input type="radio" name="referencia" value="Recomendación"> Recomendación</label>
                                <label><input type="radio" name="referencia" value="Otro"> Otro:</label>
                                <input type="text" name="referencia_otro" id="referencia_otro" style="display: none;">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2>2. Ubicación del Proyecto</h2>
                        <div class="form-group">
                            <label for="direccion">Dirección completa de instalación *</label>
                            <textarea id="direccion" name="direccion" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tipo de propiedad *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="tipo_propiedad" value="Casa habitación" required> Casa habitación</label>
                                <label><input type="radio" name="tipo_propiedad" value="Negocio pequeño"> Negocio pequeño</label>
                                <label><input type="radio" name="tipo_propiedad" value="Oficina"> Oficina</label>
                                <label><input type="radio" name="tipo_propiedad" value="Bodega"> Bodega</label>
                                <label><input type="radio" name="tipo_propiedad" value="Planta industrial"> Planta industrial</label>
                                <label><input type="radio" name="tipo_propiedad" value="Otro"> Otro:</label>
                                <input type="text" name="tipo_propiedad_otro" id="tipo_propiedad_otro" style="display: none;">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2>3. Requerimientos Técnicos</h2>
                        <div class="form-group">
                            <label>¿Cuántas cámaras necesita? *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="cantidad_camaras" value="1-4" required> 1-4</label>
                                <label><input type="radio" name="cantidad_camaras" value="5-8"> 5-8</label>
                                <label><input type="radio" name="cantidad_camaras" value="9-16"> 9-16</label>
                                <label><input type="radio" name="cantidad_camaras" value="Más de 16"> Más de 16</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>¿Qué tipo de cámaras prefiere? *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="tipo_camaras" value="Interior" required> Interior</label>
                                <label><input type="radio" name="tipo_camaras" value="Exterior"> Exterior</label>
                                <label><input type="radio" name="tipo_camaras" value="Ambas"> Ambas</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>¿Necesita visión nocturna? *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="vision_nocturna" value="Sí" required> Sí</label>
                                <label><input type="radio" name="vision_nocturna" value="No"> No</label>
                                <label><input type="radio" name="vision_nocturna" value="No estoy seguro"> No estoy seguro</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>¿Requiere visualización remota desde celular o computadora? *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="visualizacion_remota" value="Sí" required> Sí</label>
                                <label><input type="radio" name="visualizacion_remota" value="No"> No</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>¿Desea almacenamiento en? *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="almacenamiento" value="Disco duro (DVR/NVR)" required> Disco duro (DVR/NVR)</label>
                                <label><input type="radio" name="almacenamiento" value="Nube"> Nube</label>
                                <label><input type="radio" name="almacenamiento" value="Ambos"> Ambos</label>
                                <label><input type="radio" name="almacenamiento" value="No estoy seguro"> No estoy seguro</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2>4. Condiciones del Sitio</h2>
                        <div class="form-group">
                            <label>¿Cuenta con red eléctrica cerca de donde irán las cámaras? *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="red_electrica" value="Sí" required> Sí</label>
                                <label><input type="radio" name="red_electrica" value="No"> No</label>
                                <label><input type="radio" name="red_electrica" value="No estoy seguro"> No estoy seguro</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>¿Cuenta con red de internet/WiFi en el lugar? *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="red_internet" value="Sí" required> Sí</label>
                                <label><input type="radio" name="red_internet" value="No"> No</label>
                                <label><input type="radio" name="red_internet" value="No estoy seguro"> No estoy seguro</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>¿Hay infraestructura previa para CCTV (canaletas, cableado, etc.)? *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="infraestructura_previo" value="Sí" required> Sí</label>
                                <label><input type="radio" name="infraestructura_previo" value="No"> No</label>
                                <label><input type="radio" name="infraestructura_previo" value="Parcialmente"> Parcialmente</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2>5. Preferencias de Instalación</h2>
                        <div class="form-group">
                            <label>¿Qué tan pronto necesita la instalación? *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="tiempo_instalacion" value="Urgente (1-3 días)" required> Urgente (1-3 días)</label>
                                <label><input type="radio" name="tiempo_instalacion" value="En menos de una semana"> En menos de una semana</label>
                                <label><input type="radio" name="tiempo_instalacion" value="Sin prisa, solo quiero cotizar"> Sin prisa, solo quiero cotizar</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>¿En qué horario podemos contactarlo? *</label>
                            <div class="checkbox-group">
                                <label><input type="radio" name="horario_contacto" value="Mañana" required> Mañana</label>
                                <label><input type="radio" name="horario_contacto" value="Tarde"> Tarde</label>
                                <label><input type="radio" name="horario_contacto" value="Noche"> Noche</label>
                                <label><input type="radio" name="horario_contacto" value="Cualquier hora"> Cualquier hora</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2>6. Comentarios adicionales</h2>
                        <div class="form-group">
                            <label for="comentarios">Comentarios o necesidades especiales</label>
                            <textarea id="comentarios" name="comentarios" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary">Enviar Cotización</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <style>
        .cotizacion-form {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .cotizacion-form h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
            font-size: 2.5rem;
        }

        .form-cotizacion {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .form-section h2 {
            color: #00B4DB;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: normal;
        }

        .form-submit {
            text-align: center;
            margin-top: 40px;
        }

        .btn-primary {
            background-color: #00B4DB;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0099b8;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .cotizacion-form {
                padding: 40px 0;
            }

            .form-cotizacion {
                padding: 20px;
            }

            .cotizacion-form h1 {
                font-size: 2rem;
            }
        }
    </style>

    <script>
        // Mostrar/ocultar campos "Otro" según selección
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'Otro') {
                    const inputOtro = this.parentElement.nextElementSibling;
                    if (inputOtro && inputOtro.tagName === 'INPUT') {
                        inputOtro.style.display = 'block';
                        inputOtro.required = true;
                    }
                } else {
                    const inputOtro = this.parentElement.nextElementSibling;
                    if (inputOtro && inputOtro.tagName === 'INPUT') {
                        inputOtro.style.display = 'none';
                        inputOtro.required = false;
                    }
                }
            });
        });
    </script>
</body>
</html> 