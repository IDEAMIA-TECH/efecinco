# Plan de Desarrollo Web para Efecinco

## Tecnologías a Utilizar
- **Lenguajes:** PHP, JavaScript, CSS, HTML
- **Base de datos:** MySQL
- **Entorno de hosting:** Servidor CPanel
- **Restricciones:** Sin frameworks (ni Laravel, ni React, etc.)

## Estructura del Proyecto

### Archivos Maestros
- `header.php`: Contendrá la cabecera del sitio (logo, menú de navegación, estilos globales, etc.)
- `footer.php`: Contendrá el pie de página (redes sociales, contacto, derechos, etc.)
- Incluir ambos con `include('header.php')` y `include('footer.php')` en todas las páginas.

### Panel de Administración (admin/)
- Login simple con validación por sesión
- Dashboard con formularios CRUD para:
  - Datos de la empresa
  - Servicios
  - Proyectos
  - Testimonios
  - Certificaciones

## Secciones del Sitio Web

### 1. `index.php` – Inicio
- Banner dinámico con imágenes de servicios clave (slider manual o simple JS)
- Mensaje de bienvenida: “Soluciones en Seguridad y Tecnología”
- Botones (CTA): “Contáctanos” y “Solicita una cotización”

### 2. `quienes-somos.php` – ¿Quiénes Somos?
- Texto descriptivo sobre la empresa
- Misión redactada correctamente
- Línea de tiempo (2014–2024)
- Logos de clientes clave (imágenes)

### 3. `servicios.php` – Servicios
- Lista de servicios con íconos e imágenes de fondo:
  - Cableado estructurado
  - Sistemas de audio ambiental
  - CCTV
  - Control de acceso
  - Enlaces inalámbricos
  - Equipos y tecnología
  - Soporte TI
- Descripción por servicio
- Sección opcional: Pólizas o planes de mantenimiento

### 4. `proyectos.php` – Proyectos
- Tarjetas con la información:
  - Cliente
  - Tipo de solución
  - Imagen si está disponible
  - Ejemplo: “Centro de Distribución Walmart – CCTV + Cableado”

### 5. `contacto.php` – Contacto
- Formulario con los campos:
  - Nombre
  - Empresa
  - Correo
  - Teléfono
  - Mensaje
- Captcha simple con validación básica (anti-spam)
- Mapa incrustado de Google Maps
- Horario de atención

## Base de Datos (MySQL)
### Tablas sugeridas:
- `empresa` (nombre, misión, historia, dirección, contacto, etc.)
- `servicios` (id, nombre, descripción, imagen, ícono)
- `proyectos` (id, cliente, tipo_solucion, descripcion, imagen)
- `usuarios_admin` (login, password_hash)
- `testimonios` (cliente, texto, imagen)
- `certificaciones` (titulo, descripcion, imagen)

## Extras
- Integración con WhatsApp (botón flotante en todas las páginas)
- Enlaces a redes sociales
- Optimización básica SEO (meta tags, etiquetas ALT, títulos H1–H3)
- Lazy loading de imágenes y compresión para mejor rendimiento

## Seguridad
- Protección de formularios (XSS, SQL Injection)
- Validación de inputs en PHP y JS
- Uso de HTTPS y certificados SSL

## Estructura de Carpetas
```
/
├── index.php
├── quienes-somos.php
├── servicios.php
├── proyectos.php
├── contacto.php
├── header.php
├── footer.php
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   └── servicios-crud.php
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
└── includes/
    └── db.php
```

## Comentarios Finales
- El sitio será completamente administrable desde el panel.
- Se mantendrá limpio, ligero, y optimizado sin frameworks.


