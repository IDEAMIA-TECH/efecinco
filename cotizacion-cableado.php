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
    $tipo_inmueble = limpiarDatos($_POST['tipo_inmueble'] ?? '');
    $tipo_inmueble_otro = limpiarDatos($_POST['tipo_inmueble_otro'] ?? '');
    
    $puntos_red = limpiarDatos($_POST['puntos_red'] ?? '');
    $puntos_energia = limpiarDatos($_POST['puntos_energia'] ?? '');
    $tipo_cableado = limpiarDatos($_POST['tipo_cableado'] ?? '');
    $instalacion_canaletas = limpiarDatos($_POST['instalacion_canaletas'] ?? '');
    $certificacion = limpiarDatos($_POST['certificacion'] ?? '');
    
    $rack_existente = limpiarDatos($_POST['rack_existente'] ?? '');
    $planos_red = limpiarDatos($_POST['planos_red'] ?? '');
    $estado_obra = limpiarDatos($_POST['estado_obra'] ?? '');
    
    $suministro_materiales = limpiarDatos($_POST['suministro_materiales'] ?? '');
    $canalizacion = limpiarDatos($_POST['canalizacion'] ?? '');
    $configuracion_red = limpiarDatos($_POST['configuracion_red'] ?? '');
    
    $tiempo_servicio = limpiarDatos($_POST['tiempo_servicio'] ?? '');
    $horario_contacto = limpiarDatos($_POST['horario_contacto'] ?? '');
    $comentarios = limpiarDatos($_POST['comentarios'] ?? '');
    
    // Validar campos requeridos
    if (empty($nombre) || empty($telefono) || empty($email) || empty($direccion)) {
        $error = "Por favor complete todos los campos requeridos.";
    } else {
        // Insertar en la base de datos
        $sql = "INSERT INTO cotizaciones_cableado (
            nombre, telefono, email, empresa, referencia, referencia_otro,
            direccion, tipo_inmueble, tipo_inmueble_otro,
            puntos_red, puntos_energia, tipo_cableado, instalacion_canaletas, certificacion,
            rack_existente, planos_red, estado_obra,
            suministro_materiales, canalizacion, configuracion_red,
            tiempo_servicio, horario_contacto, comentarios,
            fecha_creacion, estado
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'pendiente')";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssssssssssssssssssssss", 
            $nombre, $telefono, $email, $empresa, $referencia, $referencia_otro,
            $direccion, $tipo_inmueble, $tipo_inmueble_otro,
            $puntos_red, $puntos_energia, $tipo_cableado, $instalacion_canaletas, $certificacion,
            $rack_existente, $planos_red, $estado_obra,
            $suministro_materiales, $canalizacion, $configuracion_red,
            $tiempo_servicio, $horario_contacto, $comentarios
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización de Cableado Estructurado - Efecinco</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main>
        <section class="cotizacion-form">
            <div class="container">
                <h1>Cotización de Cableado Estructurado</h1>
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
                                <label for="direccion">Dirección del lugar donde se requiere el servicio *</label>
                                <textarea id="direccion" name="direccion" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tipo de inmueble *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="tipo_inmueble" value="Oficina" required> Oficina</label>
                                    <label><input type="radio" name="tipo_inmueble" value="Local comercial"> Local comercial</label>
                                    <label><input type="radio" name="tipo_inmueble" value="Escuela"> Escuela</label>
                                    <label><input type="radio" name="tipo_inmueble" value="Planta industrial"> Planta industrial</label>
                                    <label><input type="radio" name="tipo_inmueble" value="Casa habitación"> Casa habitación</label>
                                    <label><input type="radio" name="tipo_inmueble" value="Otro"> Otro:</label>
                                    <input type="text" name="tipo_inmueble_otro" id="tipo_inmueble_otro" style="display: none;">
                                </div>
                            </div>
                            <div class="form-navigation">
                                <button type="button" class="btn btn-prev" onclick="prevSection(2)">Anterior</button>
                                <button type="button" class="btn btn-next" onclick="nextSection(2)">Siguiente</button>
                            </div>
                        </div>

                        <!-- Sección 3: Requerimientos del Proyecto -->
                        <div class="form-section" data-section="3">
                            <h2>3. Requerimientos del Proyecto</h2>
                            <div class="form-group">
                                <label>¿Cuántos puntos de red necesita instalar? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="puntos_red" value="1-10" required> 1-10</label>
                                    <label><input type="radio" name="puntos_red" value="11-25"> 11-25</label>
                                    <label><input type="radio" name="puntos_red" value="26-50"> 26-50</label>
                                    <label><input type="radio" name="puntos_red" value="Más de 50"> Más de 50</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Requiere puntos adicionales de energía eléctrica? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="puntos_energia" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="puntos_energia" value="No"> No</label>
                                    <label><input type="radio" name="puntos_energia" value="No estoy seguro"> No estoy seguro</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tipo de cableado solicitado *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="tipo_cableado" value="Categoría 5e" required> Categoría 5e</label>
                                    <label><input type="radio" name="tipo_cableado" value="Categoría 6"> Categoría 6</label>
                                    <label><input type="radio" name="tipo_cableado" value="Fibra óptica"> Fibra óptica</label>
                                    <label><input type="radio" name="tipo_cableado" value="No estoy seguro"> No estoy seguro, necesito asesoría</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Se requiere instalación de canaletas, ductos o tubería? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="instalacion_canaletas" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="instalacion_canaletas" value="No"> No</label>
                                    <label><input type="radio" name="instalacion_canaletas" value="Parcialmente"> Parcialmente</label>
                                    <label><input type="radio" name="instalacion_canaletas" value="No estoy seguro"> No estoy seguro</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Requiere certificación del cableado? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="certificacion" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="certificacion" value="No"> No</label>
                                    <label><input type="radio" name="certificacion" value="No estoy seguro"> No estoy seguro</label>
                                </div>
                            </div>
                            <div class="form-navigation">
                                <button type="button" class="btn btn-prev" onclick="prevSection(3)">Anterior</button>
                                <button type="button" class="btn btn-next" onclick="nextSection(3)">Siguiente</button>
                            </div>
                        </div>

                        <!-- Sección 4: Infraestructura Actual -->
                        <div class="form-section" data-section="4">
                            <h2>4. Infraestructura Actual</h2>
                            <div class="form-group">
                                <label>¿El lugar ya cuenta con un rack, patch panel o gabinete de comunicaciones? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="rack_existente" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="rack_existente" value="No"> No</label>
                                    <label><input type="radio" name="rack_existente" value="No estoy seguro"> No estoy seguro</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Existen planos de red o distribución del sitio? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="planos_red" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="planos_red" value="No"> No</label>
                                    <label><input type="radio" name="planos_red" value="En proceso"> En proceso</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿La obra se encuentra ocupada o en construcción? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="estado_obra" value="Ocupada" required> Ocupada</label>
                                    <label><input type="radio" name="estado_obra" value="En obra gris"> En obra gris</label>
                                    <label><input type="radio" name="estado_obra" value="En proceso de remodelación"> En proceso de remodelación</label>
                                </div>
                            </div>
                            <div class="form-navigation">
                                <button type="button" class="btn btn-prev" onclick="prevSection(4)">Anterior</button>
                                <button type="button" class="btn btn-next" onclick="nextSection(4)">Siguiente</button>
                            </div>
                        </div>

                        <!-- Sección 5: Alcance del Servicio -->
                        <div class="form-section" data-section="5">
                            <h2>5. Alcance del Servicio</h2>
                            <div class="form-group">
                                <label>¿Desea que incluyamos el suministro de materiales? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="suministro_materiales" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="suministro_materiales" value="No"> No, solo instalación</label>
                                    <label><input type="radio" name="suministro_materiales" value="Depende"> Depende de la cotización</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Desea incluir canalización (canaletas o tubería)? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="canalizacion" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="canalizacion" value="No"> No</label>
                                    <label><input type="radio" name="canalizacion" value="Depende"> Depende del costo</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>¿Necesita conexión a switch o configuración de red? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="configuracion_red" value="Sí" required> Sí</label>
                                    <label><input type="radio" name="configuracion_red" value="No"> No</label>
                                    <label><input type="radio" name="configuracion_red" value="Tal vez"> Tal vez</label>
                                </div>
                            </div>
                            <div class="form-navigation">
                                <button type="button" class="btn btn-prev" onclick="prevSection(5)">Anterior</button>
                                <button type="button" class="btn btn-next" onclick="nextSection(5)">Siguiente</button>
                            </div>
                        </div>

                        <!-- Sección 6: Tiempos y Contacto -->
                        <div class="form-section" data-section="6">
                            <h2>6. Tiempos y Contacto</h2>
                            <div class="form-group">
                                <label>¿Qué tan pronto requiere el servicio? *</label>
                                <div class="checkbox-group">
                                    <label><input type="radio" name="tiempo_servicio" value="Urgente" required> Urgente (1-3 días)</label>
                                    <label><input type="radio" name="tiempo_servicio" value="Esta semana"> Esta semana</label>
                                    <label><input type="radio" name="tiempo_servicio" value="Solo cotizando"> Solo estoy cotizando</label>
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
                                <label for="comentarios">Cualquier información relevante sobre accesos, horarios permitidos para instalación, restricciones, etc.</label>
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
 