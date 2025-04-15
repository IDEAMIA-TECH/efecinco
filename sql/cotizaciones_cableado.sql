CREATE TABLE IF NOT EXISTS cotizaciones_cableado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    empresa VARCHAR(100),
    referencia VARCHAR(50) NOT NULL,
    referencia_otro VARCHAR(100),
    direccion TEXT NOT NULL,
    tipo_inmueble VARCHAR(50) NOT NULL,
    tipo_inmueble_otro VARCHAR(100),
    puntos_red VARCHAR(20) NOT NULL,
    puntos_energia VARCHAR(20) NOT NULL,
    tipo_cableado VARCHAR(50) NOT NULL,
    instalacion_canaletas VARCHAR(20) NOT NULL,
    certificacion VARCHAR(20) NOT NULL,
    rack_existente VARCHAR(20) NOT NULL,
    planos_red VARCHAR(20) NOT NULL,
    estado_obra VARCHAR(50) NOT NULL,
    suministro_materiales VARCHAR(50) NOT NULL,
    canalizacion VARCHAR(50) NOT NULL,
    configuracion_red VARCHAR(20) NOT NULL,
    tiempo_servicio VARCHAR(50) NOT NULL,
    horario_contacto VARCHAR(20) NOT NULL,
    comentarios TEXT,
    fecha_creacion DATETIME NOT NULL,
    estado ENUM('pendiente', 'en_proceso', 'completado', 'cancelado') DEFAULT 'pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    empresa VARCHAR(100),
    referencia VARCHAR(50) NOT NULL,
    referencia_otro VARCHAR(100),
    direccion TEXT NOT NULL,
    tipo_inmueble VARCHAR(50) NOT NULL,
    tipo_inmueble_otro VARCHAR(100),
    puntos_red VARCHAR(20) NOT NULL,
    puntos_energia VARCHAR(20) NOT NULL,
    tipo_cableado VARCHAR(50) NOT NULL,
    instalacion_canaletas VARCHAR(20) NOT NULL,
    certificacion VARCHAR(20) NOT NULL,
    rack_existente VARCHAR(20) NOT NULL,
    planos_red VARCHAR(20) NOT NULL,
    estado_obra VARCHAR(50) NOT NULL,
    suministro_materiales VARCHAR(50) NOT NULL,
    canalizacion VARCHAR(50) NOT NULL,
    configuracion_red VARCHAR(20) NOT NULL,
    tiempo_servicio VARCHAR(50) NOT NULL,
    horario_contacto VARCHAR(20) NOT NULL,
    comentarios TEXT,
    fecha_creacion DATETIME NOT NULL,
    estado ENUM('pendiente', 'en_proceso', 'completado', 'cancelado') DEFAULT 'pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 
 