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
    
    // Contenido HTML del correo
    $mensaje = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmación de Cotización</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }
            .header {
                text-align: center;
                padding: 20px 0;
                background-color: #f8f9fa;
                border-radius: 8px 8px 0 0;
            }
            .logo {
                max-width: 200px;
                height: auto;
            }
            .content {
                padding: 30px;
                background-color: #fff;
                border-radius: 0 0 8px 8px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            .footer {
                text-align: center;
                padding: 20px;
                font-size: 12px;
                color: #666;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #00B4DB;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                margin: 20px 0;
            }
            .contact-info {
                background-color: #f8f9fa;
                padding: 15px;
                border-radius: 4px;
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <img src="https://efecinco.com.mx/assets/img/logof5.png" alt="Efecinco Logo" class="logo">
            </div>
            <div class="content">
                <h2>¡Gracias por su interés en Efecinco!</h2>
                <p>Estimado/a ' . htmlspecialchars($nombre) . ',</p>
                <p>Hemos recibido su solicitud de cotización para la instalación de cámaras de seguridad. Nos complace informarle que uno de nuestros asesores especializados revisará su solicitud y se pondrá en contacto con usted en breve.</p>
                
                <div class="contact-info">
                    <p><strong>¿Tiene alguna pregunta?</strong></p>
                    <p>Puede contactarnos directamente:</p>
                    <p>📞 Teléfono: (55) 1234-5678</p>
                    <p>📧 Email: contacto@efecinco.com.mx</p>
                </div>

                <p>En Efecinco nos enorgullece ofrecer:</p>
                <ul>
                    <li>Soluciones personalizadas para sus necesidades</li>
                    <li>Equipos de última generación</li>
                    <li>Instalación profesional certificada</li>
                    <li>Soporte técnico 24/7</li>
                </ul>

                <p>Gracias por confiar en nosotros.</p>
                <p>Saludos cordiales,<br>Equipo Efecinco</p>
            </div>
            <div class="footer">
                <p>Este es un correo automático, por favor no responda a este mensaje.</p>
                <p>© ' . date('Y') . ' Efecinco. Todos los derechos reservados.</p>
            </div>
        </div>
    </body>
    </html>';

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Efecinco <cotizaciones@efecinco.com.mx>\r\n";
    $headers .= "Reply-To: cotizaciones@efecinco.com.mx\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
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
    $asunto = "Nueva Cotización de Cámaras - Efecinco";
    
    // Contenido HTML del correo
    $mensaje = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nueva Cotización de Cámaras</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }
            .header {
                text-align: center;
                padding: 20px 0;
                background-color: #f8f9fa;
                border-radius: 8px 8px 0 0;
            }
            .logo {
                max-width: 200px;
                height: auto;
            }
            .content {
                padding: 30px;
                background-color: #fff;
                border-radius: 0 0 8px 8px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            .info-box {
                background-color: #f8f9fa;
                padding: 15px;
                border-radius: 4px;
                margin: 20px 0;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #00B4DB;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <img src="https://efecinco.com.mx/assets/img/logof5.png" alt="Efecinco Logo" class="logo">
            </div>
            <div class="content">
                <h2>Nueva Solicitud de Cotización</h2>
                <p>Se ha recibido una nueva solicitud de cotización para la instalación de cámaras de seguridad.</p>
                
                <div class="info-box">
                    <h3>Información del Cliente</h3>
                    <p><strong>Nombre:</strong> ' . htmlspecialchars($nombre) . '</p>
                    <p><strong>Teléfono:</strong> ' . htmlspecialchars($telefono) . '</p>
                    <p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>
                </div>

                <p>Por favor, revise el panel de administración para ver los detalles completos de la cotización y proceder con el seguimiento correspondiente.</p>
                
                <a href="https://efecinco.com.mx/admin/cotizaciones.php" class="button">Ver Cotización</a>
                
                <p>Saludos,<br>Sistema de Notificaciones Efecinco</p>
            </div>
        </div>
    </body>
    </html>';

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Sistema Efecinco <sistema@efecinco.com.mx>\r\n";
    $headers .= "Reply-To: sistema@efecinco.com.mx\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    return mail("admin@efecinco.com.mx", $asunto, $mensaje, $headers);
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