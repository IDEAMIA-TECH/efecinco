<?php
session_start();
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
    $tipo_inmueble = limpiarDatos($_POST['tipo_inmueble'] ?? '');
    $tipo_inmueble_otro = limpiarDatos($_POST['tipo_inmueble_otro'] ?? '');
    
    $cantidad_accesos = limpiarDatos($_POST['cantidad_accesos'] ?? '');
    $tipo_acceso = limpiarDatos($_POST['tipo_acceso'] ?? '');
    $tipo_acceso_otro = limpiarDatos($_POST['tipo_acceso_otro'] ?? '');
    $metodo_autenticacion = limpiarDatos($_POST['metodo_autenticacion'] ?? '');
    $metodo_autenticacion_otro = limpiarDatos($_POST['metodo_autenticacion_otro'] ?? '');
    $bitacora = limpiarDatos($_POST['bitacora'] ?? '');
    $integracion_sistema = limpiarDatos($_POST['integracion_sistema'] ?? '');
    
    $puertas_compatibles = limpiarDatos($_POST['puertas_compatibles'] ?? '');
    $suministro_electrico = limpiarDatos($_POST['suministro_electrico'] ?? '');
    $red_internet = limpiarDatos($_POST['red_internet'] ?? '');
    $infraestructura_comunicaciones = limpiarDatos($_POST['infraestructura_comunicaciones'] ?? '');
    
    $cantidad_usuarios = limpiarDatos($_POST['cantidad_usuarios'] ?? '');
    $gestion_web = limpiarDatos($_POST['gestion_web'] ?? '');
    $horarios_acceso = limpiarDatos($_POST['horarios_acceso'] ?? '');
    
    $tiempo_instalacion = limpiarDatos($_POST['tiempo_instalacion'] ?? '');
    $mantenimiento = limpiarDatos($_POST['mantenimiento'] ?? '');
    $horario_contacto = limpiarDatos($_POST['horario_contacto'] ?? '');
    $comentarios = limpiarDatos($_POST['comentarios'] ?? '');
    
    // Validar campos requeridos
    if (empty($nombre) || empty($telefono) || empty($email) || empty($direccion)) {
        $error = "Por favor complete todos los campos requeridos.";
    } else {
        // Insertar en la base de datos
        $sql = "INSERT INTO cotizaciones_acceso (
            nombre, telefono, email, empresa, referencia, referencia_otro,
            direccion, tipo_inmueble, tipo_inmueble_otro,
            cantidad_accesos, tipo_acceso, tipo_acceso_otro,
            metodo_autenticacion, metodo_autenticacion_otro, bitacora, integracion_sistema,
            puertas_compatibles, suministro_electrico, red_internet, infraestructura_comunicaciones,
            cantidad_usuarios, gestion_web, horarios_acceso,
            tiempo_instalacion, mantenimiento, horario_contacto, comentarios,
            fecha_creacion, estado
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'pendiente')";
        
        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
        
        $stmt->bind_param("sssssssssssssssssssssssssss", 
            $nombre, $telefono, $email, $empresa, $referencia, $referencia_otro,
            $direccion, $tipo_inmueble, $tipo_inmueble_otro,
            $cantidad_accesos, $tipo_acceso, $tipo_acceso_otro,
            $metodo_autenticacion, $metodo_autenticacion_otro, $bitacora, $integracion_sistema,
            $puertas_compatibles, $suministro_electrico, $red_internet, $infraestructura_comunicaciones,
            $cantidad_usuarios, $gestion_web, $horarios_acceso,
            $tiempo_instalacion, $mantenimiento, $horario_contacto, $comentarios
        );
        
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }
        
        // Enviar correos
        enviarCorreoCliente($email, $nombre);
        enviarCorreoAdmin(
            $nombre,
            $telefono,
            $email,
            'acceso',
            [
                'empresa' => $empresa,
                'direccion' => $direccion,
                'tipo_inmueble' => $tipo_inmueble,
                'cantidad_accesos' => $cantidad_accesos,
                'tipo_acceso' => $tipo_acceso,
                'metodo_autenticacion' => $metodo_autenticacion,
                'bitacora' => $bitacora,
                'integracion_sistema' => $integracion_sistema,
                'puertas_compatibles' => $puertas_compatibles,
                'suministro_electrico' => $suministro_electrico,
                'red_internet' => $red_internet,
                'infraestructura_comunicaciones' => $infraestructura_comunicaciones,
                'cantidad_usuarios' => $cantidad_usuarios,
                'gestion_web' => $gestion_web,
                'horarios_acceso' => $horarios_acceso,
                'tiempo_instalacion' => $tiempo_instalacion,
                'mantenimiento' => $mantenimiento,
                'horario_contacto' => $horario_contacto,
                'comentarios' => $comentarios
            ]
        );
        
        $mensaje = "¡Gracias por su cotización! Nos pondremos en contacto con usted pronto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización de Control de Acceso - Efecinco</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main>
        <section class="cotizacion-form">
            <div class="container">
                <h1>Cotización de Control de Acceso</h1>
                <?php if ($mensaje): ?>
                    <div class="alert alert-success"><?php echo $mensaje; ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="" class="form-cotizacion" id="cotizacionForm">
                    <div class="form-sections">
                        <!-- Sección 1: Información General -->
                        <div class="form-section active" data-section="1">
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
                            <div class="form-navigation">
                                <button type="button" class="btn btn-next" onclick="nextSection(1)">Siguiente</button>
                            </div>
                        </div>

                        <!-- Sección 2: Ubicación del Proyecto -->
                        <div class="form-section" data-section="2">
                            <h2>2. Ubicación del Proyecto</h2>
                            <div class="form-group">
                                <label for="direccion">Dirección donde se instalará el sistema *</label>
                                <textarea id="direccion" name="direccion" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tipo de inmueble *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="tipo_inmueble" value="Casa habitación" required> Casa habitación</label>
                                    <label><input type="radio" name="tipo_inmueble" value="Oficina"> Oficina</label>
                                    <label><input type="radio" name="tipo_inmueble" value="Condominio"> Condominio</label>
                                    <label><input type="radio" name="tipo_inmueble" value="Edificio corporativo"> Edificio corporativo</label>
                                    <label><input type="radio" name="tipo_inmueble" value="Planta industrial"> Planta industrial</label>
                                    <label><input type="radio" name="tipo_inmueble" value="Otro"> Otro:</label>
                                    <input type="text" name="tipo_inmueble_otro" id="tipo_inmueble_otro" style="display: none;">
                                </div>
                            </div>
                            <div class="form-navigation">
                                <button type="button" class="btn btn-prev" onclick="prevSection(2)">Anterior</button>
                                <button type="button" class="btn btn-next" onclick="nextSection(2)">Siguiente</button>
                            </div>
                        </div>

                        <!-- Sección 3: Requerimientos del Sistema -->
                        <div class="form-section" data-section="3">
                            <h2>3. Requerimientos del Sistema</h2>
                            <div class="form-group">
                                <label>¿Cuántos accesos o puertas desea controlar? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="cantidad_accesos" value="1" required> 1</label>
                                    <label><input type="radio" name="cantidad_accesos" value="2-3"> 2-3</label>
                                    <label><input type="radio" name="cantidad_accesos" value="4-6"> 4-6</label>
                                    <label><input type="radio" name="cantidad_accesos" value="Más de 6"> Más de 6</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tipo de acceso que desea controlar *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="tipo_acceso" value="Entrada principal" required> Entrada principal</label>
                                    <label><input type="radio" name="tipo_acceso" value="Estacionamiento"> Estacionamiento</label>
                                    <label><input type="radio" name="tipo_acceso" value="Acceso a oficinas internas"> Acceso a oficinas internas</label>
                                    <label><input type="radio" name="tipo_acceso" value="Acceso a áreas restringidas"> Acceso a áreas restringidas</label>
                                    <label><input type="radio" name="tipo_acceso" value="Otro"> Otro:</label>
                                    <input type="text" name="tipo_acceso_otro" id="tipo_acceso_otro" style="display: none;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Método(s) de autenticación deseados *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="metodo_autenticacion" value="Tarjetas o llaveros RFID" required> Tarjetas o llaveros RFID</label>
                                    <label><input type="radio" name="metodo_autenticacion" value="Huella digital"> Huella digital</label>
                                    <label><input type="radio" name="metodo_autenticacion" value="Reconocimiento facial"> Reconocimiento facial</label>
                                    <label><input type="radio" name="metodo_autenticacion" value="Código numérico"> Código numérico (teclado)</label>
                                    <label><input type="radio" name="metodo_autenticacion" value="App móvil"> App móvil</label>
                                    <label><input type="radio" name="metodo_autenticacion" value="Otro"> Otro:</label>
                                    <input type="text" name="metodo_autenticacion_otro" id="metodo_autenticacion_otro" style="display: none;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Desea registrar entradas y salidas (bitácora)? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="bitacora" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="bitacora" value="No"> No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Necesita integración con algún otro sistema (CCTV, alarma, etc.)? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="integracion_sistema" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="integracion_sistema" value="No"> No</label>
                                    <label><input type="radio" name="integracion_sistema" value="No estoy seguro"> No estoy seguro</label>
                                </div>
                            </div>
                            <div class="form-navigation">
                                <button type="button" class="btn btn-prev" onclick="prevSection(3)">Anterior</button>
                                <button type="button" class="btn btn-next" onclick="nextSection(3)">Siguiente</button>
                            </div>
                        </div>

                        <!-- Sección 4: Condiciones Técnicas del Sitio -->
                        <div class="form-section" data-section="4">
                            <h2>4. Condiciones Técnicas del Sitio</h2>
                            <div class="form-group">
                                <label>¿El lugar ya cuenta con un Site, rack, patch panel o gabinete de comunicaciones? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="infraestructura_comunicaciones" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="infraestructura_comunicaciones" value="No"> No</label>
                                    <label><input type="radio" name="infraestructura_comunicaciones" value="No estoy seguro"> No estoy seguro</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Cuenta con puertas compatibles con control electrónico? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="puertas_compatibles" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="puertas_compatibles" value="No"> No</label>
                                    <label><input type="radio" name="puertas_compatibles" value="No estoy seguro"> No estoy seguro</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Hay suministro eléctrico cerca de los puntos de acceso? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="suministro_electrico" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="suministro_electrico" value="No"> No</label>
                                    <label><input type="radio" name="suministro_electrico" value="No estoy seguro"> No estoy seguro</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Cuenta con red de internet en el lugar? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="red_internet" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="red_internet" value="No"> No</label>
                                    <label><input type="radio" name="red_internet" value="No estoy seguro"> No estoy seguro</label>
                                </div>
                            </div>
                            <div class="form-navigation">
                                <button type="button" class="btn btn-prev" onclick="prevSection(4)">Anterior</button>
                                <button type="button" class="btn btn-next" onclick="nextSection(4)">Siguiente</button>
                            </div>
                        </div>

                        <!-- Sección 5: Uso del Sistema -->
                        <div class="form-section" data-section="5">
                            <h2>5. Uso del Sistema</h2>
                            <div class="form-group">
                                <label>¿Cuántos usuarios tendrán acceso? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="cantidad_usuarios" value="1-10" required> 1-10</label>
                                    <label><input type="radio" name="cantidad_usuarios" value="11-50"> 11-50</label>
                                    <label><input type="radio" name="cantidad_usuarios" value="51-100"> 51-100</label>
                                    <label><input type="radio" name="cantidad_usuarios" value="Más de 100"> Más de 100</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Desea gestionar accesos desde una plataforma web o app? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="gestion_web" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="gestion_web" value="No"> No</label>
                                    <label><input type="radio" name="gestion_web" value="No estoy seguro"> No estoy seguro</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Desea establecer horarios de acceso por usuario o grupo? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="horarios_acceso" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="horarios_acceso" value="No"> No</label>
                                </div>
                            </div>
                            <div class="form-navigation">
                                <button type="button" class="btn btn-prev" onclick="prevSection(5)">Anterior</button>
                                <button type="button" class="btn btn-next" onclick="nextSection(5)">Siguiente</button>
                            </div>
                        </div>

                        <!-- Sección 6: Instalación y Seguimiento -->
                        <div class="form-section" data-section="6">
                            <h2>6. Instalación y Seguimiento</h2>
                            <div class="form-group">
                                <label>¿Qué tan pronto necesita la instalación? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="tiempo_instalacion" value="Urgente (1-3 días)" required> Urgente (1-3 días)</label>
                                    <label><input type="radio" name="tiempo_instalacion" value="Esta semana"> Esta semana</label>
                                    <label><input type="radio" name="tiempo_instalacion" value="Solo estoy cotizando"> Solo estoy cotizando</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Desea incluir póliza de mantenimiento o soporte técnico? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="mantenimiento" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="mantenimiento" value="No"> No</label>
                                    <label><input type="radio" name="mantenimiento" value="Tal vez más adelante"> Tal vez más adelante</label>
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
                            <div class="form-navigation">
                                <button type="button" class="btn btn-prev" onclick="prevSection(6)">Anterior</button>
                                <button type="button" class="btn btn-next" onclick="nextSection(6)">Siguiente</button>
                            </div>
                        </div>

                        <!-- Sección 7: Comentarios Adicionales -->
                        <div class="form-section" data-section="7">
                            <h2>7. Comentarios Adicionales</h2>
                            <div class="form-group">
                                <label for="comentarios">Especifique cualquier detalle adicional sobre el proyecto, restricciones del sitio o necesidades especiales</label>
                                <textarea id="comentarios" name="comentarios" rows="4"></textarea>
                            </div>
                            <div class="form-navigation">
                                <button type="button" class="btn btn-prev" onclick="prevSection(7)">Anterior</button>
                                <button type="submit" class="btn btn-primary">Enviar Cotización</button>
                            </div>
                        </div>
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

        .form-sections {
            position: relative;
        }

        .form-section {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .form-section.active {
            display: block;
            opacity: 1;
        }

        .form-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .btn-prev {
            background-color: #6c757d;
            color: white;
        }

        .btn-next {
            background-color: #00B4DB;
            color: white;
        }

        .progress-bar {
            width: 100%;
            height: 5px;
            background-color: #eee;
            margin-bottom: 2rem;
            border-radius: 5px;
        }

        .progress {
            height: 100%;
            background-color: #00B4DB;
            border-radius: 5px;
            transition: width 0.3s ease;
        }

        .section-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            gap: 1rem;
        }

        .section-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #ddd;
            cursor: pointer;
        }

        .section-dot.active {
            background-color: #00B4DB;
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

            main, .cotizacion-form {
                margin-top: 80px;
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

        // Navegación entre secciones
        function nextSection(currentSection) {
            const currentSectionElement = document.querySelector(`[data-section="${currentSection}"]`);
            const nextSectionElement = document.querySelector(`[data-section="${currentSection + 1}"]`);
            
            if (validateSection(currentSection)) {
                currentSectionElement.classList.remove('active');
                nextSectionElement.classList.add('active');
                updateProgress(currentSection + 1);
            }
        }

        function prevSection(currentSection) {
            const currentSectionElement = document.querySelector(`[data-section="${currentSection}"]`);
            const prevSectionElement = document.querySelector(`[data-section="${currentSection - 1}"]`);
            
            currentSectionElement.classList.remove('active');
            prevSectionElement.classList.add('active');
            updateProgress(currentSection - 1);
        }

        function validateSection(sectionNumber) {
            const section = document.querySelector(`[data-section="${sectionNumber}"]`);
            const requiredInputs = section.querySelectorAll('[required]');
            let isValid = true;

            requiredInputs.forEach(input => {
                if (!input.value) {
                    isValid = false;
                    input.classList.add('error');
                } else {
                    input.classList.remove('error');
                }
            });

            if (!isValid) {
                alert('Por favor complete todos los campos requeridos antes de continuar.');
            }

            return isValid;
        }

        function updateProgress(currentSection) {
            const progress = (currentSection / 7) * 100;
            document.querySelector('.progress').style.width = `${progress}%`;
            
            document.querySelectorAll('.section-dot').forEach((dot, index) => {
                if (index < currentSection) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        // Inicializar el progreso
        document.addEventListener('DOMContentLoaded', function() {
            const progressBar = document.createElement('div');
            progressBar.className = 'progress-bar';
            progressBar.innerHTML = '<div class="progress" style="width: 14.29%"></div>';
            document.querySelector('.form-cotizacion').insertBefore(progressBar, document.querySelector('.form-sections'));

            const sectionIndicator = document.createElement('div');
            sectionIndicator.className = 'section-indicator';
            for (let i = 0; i < 7; i++) {
                const dot = document.createElement('div');
                dot.className = 'section-dot' + (i === 0 ? ' active' : '');
                sectionIndicator.appendChild(dot);
            }
            document.querySelector('.form-cotizacion').insertBefore(sectionIndicator, document.querySelector('.form-sections'));
        });
    </script>
</body>
</html> 