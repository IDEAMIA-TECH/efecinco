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
    $mensaje = "Estimado/a $nombre,\n\n";
    $mensaje .= "Hemos recibido su solicitud de cotización para la instalación de cámaras de seguridad.\n";
    $mensaje .= "Uno de nuestros asesores se pondrá en contacto con usted en breve.\n\n";
    $mensaje .= "Saludos cordiales,\n";
    $mensaje .= "Equipo Efecinco";
    
    $headers = "From: cotizaciones@efecinco.com.mx\r\n";
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
    $asunto = "Nueva Cotización de Cámaras";
    $mensaje = "Se ha recibido una nueva cotización:\n\n";
    $mensaje .= "Nombre: $nombre\n";
    $mensaje .= "Teléfono: $telefono\n";
    $mensaje .= "Email: $email\n\n";
    $mensaje .= "Por favor revise el panel de administración para más detalles.";
    
    $headers = "From: sistema@efecinco.com.mx\r\n";
    $headers .= "Reply-To: sistema@efecinco.com.mx\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    return mail("admin@efecinco.com.mx", $asunto, $mensaje, $headers);
}

/**
 * Conecta a la base de datos
 * @return mysqli|false Objeto de conexión o false en caso de error
 */
function conectarDB() {
    $host = "localhost";
    $usuario = "ideamiadev_efecinco";
    $password = "TuContraseña"; // Reemplazar con la contraseña real
    $base_datos = "ideamiadev_efecinco";

    $conexion = new mysqli($host, $usuario, $password, $base_datos);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $conexion->set_charset("utf8mb4");
    return $conexion;
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