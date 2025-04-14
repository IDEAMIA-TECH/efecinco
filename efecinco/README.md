# Efecinco - Sitio Web

Sitio web oficial de Efecinco, especializado en soluciones de seguridad y tecnología.

## Requisitos del Sistema

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Apache/Nginx
- Composer
- Node.js (opcional, para assets)

## Estructura del Proyecto

```
efecinco/
├── public/          # Archivos públicos y punto de entrada
├── src/             # Código fuente
│   ├── config/      # Configuraciones
│   ├── controllers/ # Controladores
│   ├── models/      # Modelos
│   ├── views/       # Vistas
│   └── assets/      # Recursos estáticos
│       ├── css/     # Estilos
│       ├── js/      # Scripts
│       └── images/  # Imágenes
└── docs/            # Documentación
```

## Instalación

1. Clonar el repositorio:
```bash
git clone [url-del-repositorio]
cd efecinco
```

2. Instalar dependencias PHP:
```bash
composer install
```

3. Configurar la base de datos:
- Crear una base de datos MySQL
- Copiar `.env.example` a `.env`
- Configurar las credenciales de la base de datos en `.env`

4. Ejecutar migraciones:
```bash
php artisan migrate
```

5. Configurar el servidor web:
- Apuntar el document root a la carpeta `public/`
- Asegurar que el servidor tenga permisos de escritura en las carpetas necesarias

## Desarrollo

1. Iniciar el servidor de desarrollo:
```bash
php -S localhost:8000 -t public
```

2. Para desarrollo de assets (opcional):
```bash
npm install
npm run dev
```

## Contribución

1. Crear una rama para tu feature/fix
2. Hacer commit de tus cambios
3. Crear un Pull Request

## Licencia

Este proyecto es privado y confidencial.
