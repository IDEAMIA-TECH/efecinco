-- Tabla empresa con campos mejorados
CREATE TABLE IF NOT EXISTS `empresa` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(255) NOT NULL,
    `mision` text,
    `vision` text,
    `historia` text,
    `direccion` varchar(255) NOT NULL DEFAULT '',
    `telefono` varchar(50) NOT NULL DEFAULT '',
    `email` varchar(100) NOT NULL DEFAULT '',
    `horario` varchar(255) NOT NULL DEFAULT '',
    `facebook` varchar(255) DEFAULT NULL,
    `instagram` varchar(255) DEFAULT NULL,
    `linkedin` varchar(255) DEFAULT NULL,
    `whatsapp` varchar(50) DEFAULT NULL,
    `coordenadas` varchar(100) DEFAULT NULL,
    `logo` varchar(255) DEFAULT NULL,
    `fecha_actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos iniciales de la empresa
INSERT INTO empresa (
    id, 
    nombre, 
    mision, 
    vision, 
    historia,
    direccion, 
    telefono, 
    email, 
    horario,
    facebook,
    instagram,
    linkedin,
    whatsapp
) VALUES (
    1,
    'Efecinco',
    'Proporcionar soluciones integrales en seguridad y tecnología que garanticen la protección y eficiencia operativa de nuestros clientes.',
    'Ser líderes en el mercado de soluciones tecnológicas y de seguridad, reconocidos por nuestra innovación y excelencia en el servicio.',
    'Desde 2014, Efecinco ha estado a la vanguardia en soluciones de seguridad y tecnología, construyendo una sólida reputación basada en la excelencia y la innovación.',
    'Dirección de la empresa',
    '(123) 456-7890',
    'info@efecinco.com',
    'Lunes a Viernes: 9:00 - 18:00, Sábado: 9:00 - 13:00',
    'https://facebook.com/efecinco',
    'https://instagram.com/efecinco',
    'https://linkedin.com/company/efecinco',
    '1234567890'
);

-- Tabla servicios mejorada
CREATE TABLE IF NOT EXISTS `servicios` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100) NOT NULL,
    `descripcion` text,
    `descripcion_corta` varchar(255),
    `imagen` varchar(255),
    `icono` varchar(50),
    `destacado` boolean DEFAULT FALSE,
    `activo` boolean DEFAULT TRUE,
    `orden` int DEFAULT 0,
    `fecha_creacion` timestamp DEFAULT CURRENT_TIMESTAMP,
    `fecha_actualizacion` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar servicios iniciales
INSERT INTO servicios (nombre, descripcion, icono, destacado, activo) VALUES
('Cableado Estructurado', 'Soluciones de red profesional para tu empresa', 'fa-network-wired', TRUE, TRUE),
('Sistemas de Audio Ambiental', 'Sistemas de sonido para espacios comerciales e industriales', 'fa-volume-up', TRUE, TRUE),
('CCTV', 'Sistemas de videovigilancia de última generación', 'fa-video', TRUE, TRUE),
('Control de Acceso', 'Gestión segura de accesos a tus instalaciones', 'fa-lock', TRUE, TRUE),
('Enlaces Inalámbricos', 'Soluciones de conectividad inalámbrica', 'fa-wifi', TRUE, TRUE),
('Equipos y Tecnología', 'Venta e implementación de equipos tecnológicos', 'fa-laptop', TRUE, TRUE),
('Soporte TI', 'Servicio de soporte técnico especializado', 'fa-headset', TRUE, TRUE);

-- Tabla proyectos mejorada
CREATE TABLE IF NOT EXISTS `proyectos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `cliente` varchar(100) NOT NULL,
    `tipo_solucion` varchar(100) NOT NULL,
    `descripcion` text,
    `descripcion_corta` varchar(255),
    `caracteristicas` text,
    `imagen` varchar(255),
    `fecha` date,
    `destacado` boolean DEFAULT FALSE,
    `activo` boolean DEFAULT TRUE,
    `fecha_creacion` timestamp DEFAULT CURRENT_TIMESTAMP,
    `fecha_actualizacion` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla proyecto_imagenes
CREATE TABLE IF NOT EXISTS `proyecto_imagenes` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `proyecto_id` int(11),
    `url` varchar(255) NOT NULL,
    `descripcion` varchar(255),
    `orden` int DEFAULT 0,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`proyecto_id`) REFERENCES proyectos(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla proyecto_servicio
CREATE TABLE IF NOT EXISTS `proyecto_servicio` (
    `proyecto_id` int(11),
    `servicio_id` int(11),
    PRIMARY KEY (`proyecto_id`, `servicio_id`),
    FOREIGN KEY (`proyecto_id`) REFERENCES proyectos(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`servicio_id`) REFERENCES servicios(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla testimonios mejorada
CREATE TABLE IF NOT EXISTS `testimonios` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `cliente` varchar(100) NOT NULL,
    `cargo` varchar(100),
    `empresa` varchar(100),
    `testimonio` text NOT NULL,
    `imagen` varchar(255),
    `destacado` boolean DEFAULT FALSE,
    `activo` boolean DEFAULT TRUE,
    `fecha_creacion` timestamp DEFAULT CURRENT_TIMESTAMP,
    `fecha_actualizacion` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla certificaciones mejorada
CREATE TABLE IF NOT EXISTS `certificaciones` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `titulo` varchar(100) NOT NULL,
    `descripcion` text,
    `imagen` varchar(255) NOT NULL,
    `fecha` date,
    `activo` boolean DEFAULT TRUE,
    `orden` int DEFAULT 0,
    `fecha_creacion` timestamp DEFAULT CURRENT_TIMESTAMP,
    `fecha_actualizacion` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla usuarios_admin mejorada
CREATE TABLE IF NOT EXISTS `usuarios_admin` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `usuario` varchar(50) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `nombre` varchar(100),
    `email` varchar(100),
    `ultimo_acceso` timestamp NULL,
    `activo` boolean DEFAULT TRUE,
    `fecha_creacion` timestamp DEFAULT CURRENT_TIMESTAMP,
    `fecha_actualizacion` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar usuario administrador por defecto (password: admin123)
INSERT INTO usuarios_admin (usuario, password, nombre, email) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 'admin@efecinco.com');

-- Tabla contactos mejorada
CREATE TABLE IF NOT EXISTS `contactos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100) NOT NULL,
    `empresa` varchar(100),
    `email` varchar(100) NOT NULL,
    `telefono` varchar(20),
    `mensaje` text NOT NULL,
    `leido` boolean DEFAULT FALSE,
    `fecha_creacion` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla clientes
CREATE TABLE IF NOT EXISTS `clientes` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100) NOT NULL,
    `logo` varchar(255),
    `url` varchar(255),
    `descripcion` text,
    `destacado` boolean DEFAULT FALSE,
    `activo` boolean DEFAULT TRUE,
    `orden` int DEFAULT 0,
    `fecha_creacion` timestamp DEFAULT CURRENT_TIMESTAMP,
    `fecha_actualizacion` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar algunos clientes de ejemplo
INSERT INTO clientes (nombre, descripcion, destacado, activo) VALUES
('Walmart', 'Centro de Distribución - Implementación de CCTV y Control de Acceso', TRUE, TRUE),
('Liverpool', 'Tiendas Departamentales - Sistema de Audio Ambiental', TRUE, TRUE),
('Chedraui', 'Supermercados - Cableado Estructurado y CCTV', TRUE, TRUE),
('OXXO', 'Tiendas de Conveniencia - Sistemas de Seguridad Integral', TRUE, TRUE),
('Soriana', 'Hipermercados - Soluciones de Control de Acceso', TRUE, TRUE); 