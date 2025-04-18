<?php
/**
 * Limpia y sanitiza los datos de entrada
 * @param string $data Datos a limpiar
 * @return string Datos limpios
 */
function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Envía correo de confirmación al cliente
 * @param string $email Email del cliente
 * @param string $nombre Nombre del cliente
 * @return bool True si el correo se envió correctamente
 */
function enviarCorreoCliente($email, $nombre) {
    $asunto = "Confirmación de Cotización - Efecinco";
    
    // Obtener la URL base del sitio
    $url_base = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    
    $mensaje = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }
            .header {
                text-align: center;
                margin-bottom: 30px;
            }
            .logo {
                max-width: 200px;
                height: auto;
            }
            .content {
                background-color: #f8f9fa;
                padding: 20px;
                border-radius: 5px;
            }
            .footer {
                text-align: center;
                margin-top: 30px;
                font-size: 12px;
                color: #666;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #00B4DB;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class='header'>
            <img src='{$url_base}/assets/images/logof5.png' alt='Efecinco Logo' class='logo'>
        </div>
        <div class='content'>
            <h2>¡Gracias por su interés en Efecinco!</h2>
            <p>Estimado(a) {$nombre},</p>
            <p>Hemos recibido su solicitud de cotización. Nuestro equipo la revisará y se pondrá en contacto con usted a la brevedad.</p>
            <p>Detalles de su solicitud:</p>
            <ul>
                <li>Fecha: " . date('d/m/Y H:i') . "</li>
                <li>Email: {$email}</li>
            </ul>
            <p>Si tiene alguna pregunta adicional, no dude en contactarnos.</p>
            <p>Saludos cordiales,<br>El equipo de Efecinco</p>
        </div>
        <div class='footer'>
            <p>Este es un correo automático, por favor no responda a este mensaje.</p>
            <p>© " . date('Y') . " Efecinco. Todos los derechos reservados.</p>
        </div>
    </body>
    </html>
    ";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Efecinco <info@efecinco.com>\r\n";
    $headers .= "Reply-To: info@efecinco.com\r\n";
    
    return mail($email, $asunto, $mensaje, $headers);
}

/**
 * Envía notificación al administrador
 * @param string $nombre Nombre del cliente
 * @param string $telefono Teléfono del cliente
 * @param string $email Email del cliente
 * @param string $tipo_cotizacion Tipo de cotización
 * @param array $datos_cotizacion Datos de la cotización
 * @return bool True si el correo se envió correctamente
 */
function enviarCorreoAdmin($nombre, $telefono, $email, $tipo_cotizacion, $datos_cotizacion) {
    $asunto = "Nueva Solicitud de Cotización - Efecinco";
    
    // Obtener la URL base del sitio
    $url_base = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    
    $mensaje = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #0072ff; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; background-color: #f9f9f9; }
            .section { margin-bottom: 20px; }
            .label { font-weight: bold; }
            .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>Nueva Solicitud de Cotización</h1>
            </div>
            <div class='content'>
                <div class='section'>
                    <h2>Información del Cliente</h2>
                    <p><span class='label'>Nombre:</span> $nombre</p>
                    <p><span class='label'>Teléfono:</span> $telefono</p>
                    <p><span class='label'>Email:</span> $email</p>
                    <p><span class='label'>Empresa:</span> " . ($datos_cotizacion['empresa'] ?? 'No especificada') . "</p>
                    <p><span class='label'>Dirección:</span> " . ($datos_cotizacion['direccion'] ?? '') . "</p>
                </div>
                
                <div class='section'>
                    <h2>Detalles de la Cotización</h2>";
    
    // Agregar detalles específicos según el tipo de cotización
    switch($tipo_cotizacion) {
        case 'cableado':
            $mensaje .= "
                    <p><span class='label'>Tipo de Inmueble:</span> " . ($datos_cotizacion['tipo_inmueble'] ?? '') . "</p>
                    <p><span class='label'>Puntos de Red:</span> " . ($datos_cotizacion['puntos_red'] ?? '') . "</p>
                    <p><span class='label'>Puntos de Energía:</span> " . ($datos_cotizacion['puntos_energia'] ?? '') . "</p>
                    <p><span class='label'>Tipo de Cableado:</span> " . ($datos_cotizacion['tipo_cableado'] ?? '') . "</p>
                    <p><span class='label'>Instalación de Canaletas:</span> " . ($datos_cotizacion['instalacion_canaletas'] ?? '') . "</p>
                    <p><span class='label'>Certificación:</span> " . ($datos_cotizacion['certificacion'] ?? '') . "</p>
                    <p><span class='label'>Infraestructura Existente:</span> " . ($datos_cotizacion['infraestructura_comunicaciones'] ?? '') . "</p>
                    <p><span class='label'>Rack Existente:</span> " . ($datos_cotizacion['rack_existente'] ?? '') . "</p>
                    <p><span class='label'>Planos de Red:</span> " . ($datos_cotizacion['planos_red'] ?? '') . "</p>
                    <p><span class='label'>Estado de Obra:</span> " . ($datos_cotizacion['estado_obra'] ?? '') . "</p>
                    <p><span class='label'>Suministro de Materiales:</span> " . ($datos_cotizacion['suministro_materiales'] ?? '') . "</p>
                    <p><span class='label'>Canalización:</span> " . ($datos_cotizacion['canalizacion'] ?? '') . "</p>
                    <p><span class='label'>Configuración de Red:</span> " . ($datos_cotizacion['configuracion_red'] ?? '') . "</p>";
            break;
            
        case 'acceso':
            $mensaje .= "
                    <p><span class='label'>Tipo de Inmueble:</span> " . ($datos_cotizacion['tipo_inmueble'] ?? '') . "</p>
                    <p><span class='label'>Cantidad de Accesos:</span> " . ($datos_cotizacion['cantidad_accesos'] ?? '') . "</p>
                    <p><span class='label'>Tipo de Acceso:</span> " . ($datos_cotizacion['tipo_acceso'] ?? '') . "</p>
                    <p><span class='label'>Método de Autenticación:</span> " . ($datos_cotizacion['metodo_autenticacion'] ?? '') . "</p>
                    <p><span class='label'>Bitácora:</span> " . ($datos_cotizacion['bitacora'] ?? '') . "</p>
                    <p><span class='label'>Integración con Sistema:</span> " . ($datos_cotizacion['integracion_sistema'] ?? '') . "</p>
                    <p><span class='label'>Puertas Compatibles:</span> " . ($datos_cotizacion['puertas_compatibles'] ?? '') . "</p>
                    <p><span class='label'>Suministro Eléctrico:</span> " . ($datos_cotizacion['suministro_electrico'] ?? '') . "</p>
                    <p><span class='label'>Red Internet:</span> " . ($datos_cotizacion['red_internet'] ?? '') . "</p>
                    <p><span class='label'>Infraestructura Comunicaciones:</span> " . ($datos_cotizacion['infraestructura_comunicaciones'] ?? '') . "</p>
                    <p><span class='label'>Cantidad de Usuarios:</span> " . ($datos_cotizacion['cantidad_usuarios'] ?? '') . "</p>
                    <p><span class='label'>Gestión Web:</span> " . ($datos_cotizacion['gestion_web'] ?? '') . "</p>
                    <p><span class='label'>Horarios de Acceso:</span> " . ($datos_cotizacion['horarios_acceso'] ?? '') . "</p>";
            break;
            
        case 'seguridad':
            $mensaje .= "
                    <p><span class='label'>Tipo de Inmueble:</span> " . ($datos_cotizacion['tipo_inmueble'] ?? '') . "</p>
                    <p><span class='label'>Área Protegida:</span> " . ($datos_cotizacion['area_protegida'] ?? '') . "</p>
                    <p><span class='label'>Tipo de Sistema:</span> " . ($datos_cotizacion['tipo_sistema'] ?? '') . "</p>
                    <p><span class='label'>Número de Cámaras:</span> " . ($datos_cotizacion['numero_camaras'] ?? '') . "</p>
                    <p><span class='label'>Tipo de Cámaras:</span> " . ($datos_cotizacion['tipo_camaras'] ?? '') . "</p>
                    <p><span class='label'>Visión Nocturna:</span> " . ($datos_cotizacion['vision_nocturna'] ?? '') . "</p>
                    <p><span class='label'>Visualización Remota:</span> " . ($datos_cotizacion['visualizacion_remota'] ?? '') . "</p>
                    <p><span class='label'>Almacenamiento:</span> " . ($datos_cotizacion['almacenamiento'] ?? '') . "</p>
                    <p><span class='label'>Red Eléctrica:</span> " . ($datos_cotizacion['red_electrica'] ?? '') . "</p>
                    <p><span class='label'>Red Internet:</span> " . ($datos_cotizacion['red_internet'] ?? '') . "</p>
                    <p><span class='label'>Infraestructura Comunicaciones:</span> " . ($datos_cotizacion['infraestructura_comunicaciones'] ?? '') . "</p>
                    <p><span class='label'>Infraestructura Previa:</span> " . ($datos_cotizacion['infraestructura_previo'] ?? '') . "</p>";
            break;
    }
    
    $mensaje .= "
                </div>
                
                <div class='section'>
                    <h2>Información Adicional</h2>
                    <p><span class='label'>Tiempo de Instalación:</span> " . ($datos_cotizacion['tiempo_instalacion'] ?? '') . "</p>
                    <p><span class='label'>Horario de Contacto:</span> " . ($datos_cotizacion['horario_contacto'] ?? '') . "</p>
                    <p><span class='label'>Comentarios:</span> " . ($datos_cotizacion['comentarios'] ?? 'Sin comentarios') . "</p>
                </div>
            </div>
            <div class='footer'>
                <p>Este es un correo automático generado por el sistema de cotizaciones de Efecinco.</p>
            </div>
        </div>
    </body>
    </html>";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Efecinco <no-reply@efecinco.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    // Obtener correos de administradores activos
    $conexion = conectarDB();
    $sql = "SELECT email FROM usuarios_admin WHERE activo = 1 AND email IS NOT NULL";
    $resultado = $conexion->query($sql);
    
    $enviado = true;
    if ($resultado && $resultado->num_rows > 0) {
        while ($admin = $resultado->fetch_assoc()) {
            if (!mail($admin['email'], $asunto, $mensaje, $headers)) {
                $enviado = false;
            }
        }
    }
    
    return $enviado;
}

/**
 * Valida un número de teléfono
 * @param string $telefono Número de teléfono a validar
 * @return bool True si el teléfono es válido
 */
function validarTelefono($telefono) {
    // Eliminar espacios, guiones y paréntesis
    $telefono = preg_replace('/[^0-9]/', '', $telefono);
    
    // Verificar que tenga entre 10 y 15 dígitos
    return preg_match('/^[0-9]{10,15}$/', $telefono);
}

/**
 * Valida un correo electrónico
 * @param string $email Correo electrónico a validar
 * @return bool True si el correo es válido
 */
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Genera un ID único para la cotización
 * @return string ID único
 */
function generarIdCotizacion() {
    return uniqid('COT-', true);
}

/**
 * Obtiene el nombre del mes en español
 * @param int $mes Número del mes (1-12)
 * @return string Nombre del mes en español
 */
function obtenerMesEspanol($mes) {
    $meses = [
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'
    ];
    return $meses[$mes] ?? '';
}

/**
 * Formatea una fecha en formato español
 * @param string $fecha Fecha en formato YYYY-MM-DD
 * @return string Fecha formateada en español
 */
function formatearFechaEspanol($fecha) {
    $fecha_obj = new DateTime($fecha);
    $dia = $fecha_obj->format('d');
    $mes = obtenerMesEspanol((int)$fecha_obj->format('m'));
    $anio = $fecha_obj->format('Y');
    return "$dia de $mes de $anio";
}
?> 