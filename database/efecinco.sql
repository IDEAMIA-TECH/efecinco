-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS efecinco_db;
USE efecinco_db;

-- Tabla de usuarios administradores
CREATE TABLE IF NOT EXISTS usuarios_admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultimo_acceso TIMESTAMP NULL
);

-- Tabla de datos de la empresa
CREATE TABLE IF NOT EXISTS empresa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    mision TEXT,
    vision TEXT,
    historia TEXT,
    direccion TEXT,
    telefono VARCHAR(20),
    email VARCHAR(100),
    horario_atencion TEXT,
    facebook_url VARCHAR(255),
    linkedin_url VARCHAR(255),
    instagram_url VARCHAR(255),
    whatsapp_numero VARCHAR(20),
    ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de servicios
CREATE TABLE IF NOT EXISTS servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    icono VARCHAR(50),
    imagen VARCHAR(255),
    orden INT DEFAULT 0,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de proyectos
CREATE TABLE IF NOT EXISTS proyectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(100) NOT NULL,
    tipo_solucion VARCHAR(100) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255),
    fecha_proyecto DATE,
    destacado BOOLEAN DEFAULT FALSE,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de testimonios
CREATE TABLE IF NOT EXISTS testimonios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(100) NOT NULL,
    cargo VARCHAR(100),
    empresa VARCHAR(100),
    testimonio TEXT NOT NULL,
    imagen VARCHAR(255),
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de certificaciones
CREATE TABLE IF NOT EXISTS certificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255),
    fecha_obtencion DATE,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar usuario administrador por defecto (password: admin123)
INSERT INTO usuarios_admin (usuario, password_hash, nombre, email) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 'admin@efecinco.com');

-- Insertar datos iniciales de la empresa
INSERT INTO empresa (nombre, mision, vision, direccion, telefono, email, horario_atencion)
VALUES (
    'Efecinco',
    'Proporcionar soluciones integrales en seguridad y tecnología que garanticen la protección y eficiencia operativa de nuestros clientes.',
    'Ser líderes en el mercado de soluciones tecnológicas y de seguridad, reconocidos por nuestra innovación y excelencia en el servicio.',
    'Dirección de la empresa',
    '(123) 456-7890',
    'info@efecinco.com',
    'Lunes a Viernes: 9:00 - 18:00, Sábado: 9:00 - 13:00'
);

-- Insertar servicios iniciales
INSERT INTO servicios (nombre, descripcion, icono) VALUES
('Cableado Estructurado', 'Soluciones de red profesional para tu empresa', 'fa-network-wired'),
('Sistemas de Audio Ambiental', 'Sistemas de sonido para espacios comerciales e industriales', 'fa-volume-up'),
('CCTV', 'Sistemas de videovigilancia de última generación', 'fa-video'),
('Control de Acceso', 'Gestión segura de accesos a tus instalaciones', 'fa-lock'),
('Enlaces Inalámbricos', 'Soluciones de conectividad inalámbrica', 'fa-wifi'),
('Equipos y Tecnología', 'Venta e implementación de equipos tecnológicos', 'fa-laptop'),
('Soporte TI', 'Servicio de soporte técnico especializado', 'fa-headset'); 