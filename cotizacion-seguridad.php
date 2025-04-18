<?php
// Enviar correo al administrador
enviarCorreoAdmin(
    $nombre,
    $telefono,
    $email,
    'seguridad',
    [
        'empresa' => $empresa,
        'direccion' => $direccion,
        'tipo_inmueble' => $tipo_inmueble,
        'area_protegida' => $area_protegida,
        'tipo_sistema' => $tipo_sistema,
        'numero_camaras' => $numero_camaras,
        'tipo_camaras' => $tipo_camaras,
        'grabacion' => $grabacion,
        'control_acceso' => $control_acceso,
        'alarmas' => $alarmas,
        'monitoreo' => $monitoreo,
        'tiempo_instalacion' => $tiempo_instalacion,
        'mantenimiento' => $mantenimiento,
        'horario_contacto' => $horario_contacto,
        'comentarios' => $comentarios
    ]
); 