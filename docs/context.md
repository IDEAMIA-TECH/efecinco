# Requerimientos para el Rediseño de Efecinco

## Objetivo del Proyecto

Rediseñar el sitio web de Efecinco para reflejar profesionalismo, claridad y confianza, con un enfoque moderno, responsivo y alineado a su experiencia en tecnología y seguridad.

## Estructura de Contenido (Propuesta)

## Tech Stack
- Front End: CSS, HTML, JavaScript
- Backend: PHP, JavaScript, CSS
- Data Base: MySQL
- Server: CPANEL

## Estructura de Base de Datos

### Tablas Principales

#### 1. usuarios
```sql
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'editor') NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultimo_acceso TIMESTAMP,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo'
);
```

#### 2. servicios
```sql
CREATE TABLE servicios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    icono VARCHAR(100),
    imagen_fondo VARCHAR(255),
    orden INT DEFAULT 0,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 3. proyectos
```sql
CREATE TABLE proyectos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    cliente VARCHAR(100) NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    tipo_solucion VARCHAR(100),
    imagen VARCHAR(255),
    fecha_proyecto DATE,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 4. testimonios
```sql
CREATE TABLE testimonios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_cliente VARCHAR(100) NOT NULL,
    empresa VARCHAR(100),
    testimonio TEXT NOT NULL,
    imagen VARCHAR(255),
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 5. contactos
```sql
CREATE TABLE contactos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    empresa VARCHAR(100),
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    mensaje TEXT NOT NULL,
    estado ENUM('nuevo', 'leido', 'respondido') DEFAULT 'nuevo',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 6. configuracion
```sql
CREATE TABLE configuracion (
    id INT PRIMARY KEY AUTO_INCREMENT,
    clave VARCHAR(50) NOT NULL UNIQUE,
    valor TEXT,
    descripcion VARCHAR(255),
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Relaciones y Consideraciones

1. **Seguridad**:
   - Todas las contraseñas se almacenarán encriptadas
   - Implementación de tokens de sesión
   - Registro de intentos de acceso fallidos

2. **Optimización**:
   - Índices en campos de búsqueda frecuente
   - Normalización de datos para evitar redundancia
   - Caché de consultas frecuentes

3. **Mantenimiento**:
   - Registro de cambios importantes
   - Backups automáticos
   - Logs de actividad

### 1. Inicio
- Banner dinámico con imágenes de servicios clave
- Mensaje de bienvenida: "Soluciones en Seguridad y Tecnología"
- CTA visible: "Contáctanos" / "Solicita una cotización"

### 2. ¿Quiénes Somos?
- Texto del brochure sobre la empresa y su trayectoria
- Misión (redactada con mejor ortografía y estilo)
- Línea de tiempo (2014 – 2024)
- Logos de clientes clave (Walmart, Importex Green, Banco Azteca, Henkel, etc.)

### 3. Servicios
- Cada servicio con ícono e imagen de fondo:
  - Cableado estructurado de voz y datos
  - Sistemas de audio ambiental
  - Sistemas de seguridad (CCTV)
  - Control de acceso peatonal y vehicular
  - Enlaces inalámbricos punto a punto y multipunto
  - Equipos de cómputo y tecnología
  - Soporte TI
- Descripción detallada por servicio (similar al brochure)
- Posible sección de "Planes o Pólizas de mantenimiento"

### 4. Proyectos
- Tarjetas visuales mostrando:
  - Cliente
  - Tipo de solución
  - Imagen (si existe)
  - Ejemplo: "Centro de Distribución Walmart – CCTV + Cableado"

### 5. Contacto
- Formulario directo (Nombre, Empresa, Correo, Teléfono, Mensaje)
- Datos de contacto completos
- Google Maps con dirección
- Horarios de atención

## Requerimientos Funcionales
- Sitio responsivo (adaptado para celular, tablet y escritorio)
- Optimizado para SEO básico
- Panel de administración para actualizar servicios o proyectos (opcional)
- Botón de WhatsApp flotante
- Integración con redes sociales (Facebook, LinkedIn, etc.)
- Formularios protegidos con captcha
- Optimización de carga (imágenes comprimidas, Lazy Loading)

## Requerimientos de Diseño
- Colores institucionales: Azul corporativo, blanco y gris
- Tipografía moderna y profesional
- Estilo gráfico coherente con seguridad, tecnología y confianza
- Imágenes de alta calidad relacionadas a tecnología y seguridad
- Diseño limpio y minimalista pero visualmente impactante

## Contenido a Redactar o Ajustar
- Mejorar redacción del texto del brochure (ortografía y estilo)
- Redactar textos optimizados para cada sección
- Agregar testimonios de clientes o casos de éxito
- Agregar sección de "Certificaciones o alianzas"


