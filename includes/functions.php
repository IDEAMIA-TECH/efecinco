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
 * @return bool True si el correo se envió correctamente
 */
function enviarCorreoAdmin($nombre, $telefono, $email) {
    $asunto = "Nueva Solicitud de Cotización - Efecinco";
    
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
            <h2>Nueva Solicitud de Cotización</h2>
            <p>Se ha recibido una nueva solicitud de cotización con los siguientes detalles:</p>
            <ul>
                <li>Nombre: {$nombre}</li>
                <li>Teléfono: {$telefono}</li>
                <li>Email: {$email}</li>
                <li>Fecha: " . date('d/m/Y H:i') . "</li>
            </ul>
            <p>Por favor, revise el panel de administración para más detalles.</p>
        </div>
        <div class='footer'>
            <p>© " . date('Y') . " Efecinco. Todos los derechos reservados.</p>
        </div>
    </body>
    </html>
    ";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Efecinco <info@efecinco.com>\r\n";
    $headers .= "Reply-To: info@efecinco.com\r\n";
    
    // Enviar a la dirección de administración
    return mail("info@efecinco.com", $asunto, $mensaje, $headers);
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