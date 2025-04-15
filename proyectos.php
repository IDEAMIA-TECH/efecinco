<?php
require_once('includes/db.php');
$conexion = conectarDB();

// Obtener filtros
$servicio_id = $_GET['servicio'] ?? 0;
$cliente = $_GET['cliente'] ?? '';
$tipo_solucion = $_GET['tipo_solucion'] ?? '';

// Construir la consulta base
$sql = "SELECT p.* FROM proyectos p WHERE p.activo = 1";
$params = [];

// Aplicar filtros
if ($servicio_id) {
    $sql .= " AND EXISTS (SELECT 1 FROM proyecto_servicio ps WHERE ps.proyecto_id = p.id AND ps.servicio_id = ?)";
    $params[] = $servicio_id;
}

if ($cliente) {
    $sql .= " AND p.cliente LIKE ?";
    $params[] = "%$cliente%";
}

if ($tipo_solucion) {
    $sql .= " AND p.tipo_solucion LIKE ?";
    $params[] = "%$tipo_solucion%";
}

// Ordenar por fecha descendente
$sql .= " ORDER BY p.fecha DESC";

// Obtener proyectos
$stmt = consultaSegura($conexion, $sql, $params);
$proyectos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Obtener servicios para el filtro
$sql = "SELECT * FROM servicios WHERE activo = 1 ORDER BY nombre";
$stmt = consultaSegura($conexion, $sql, []);
$servicios = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Obtener tipos de solución únicos
$sql = "SELECT DISTINCT tipo_solucion FROM proyectos WHERE activo = 1 ORDER BY tipo_solucion";
$stmt = consultaSegura($conexion, $sql, []);
$tipos_solucion = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Incluir el header
include('includes/header.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos - Efecinco</title>
    <meta name="description" content="Conoce nuestros proyectos realizados en seguridad y tecnología">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main>
        <section class="hero">
            <div class="container">
                <h1>Nuestros Proyectos</h1>
                <p>Conoce nuestros casos de éxito en seguridad y tecnología</p>
            </div>
        </section>

        <section class="filtros">
            <div class="container">
                <form action="proyectos.php" method="GET" class="filtros-form">
                    <div class="filtro-grupo">
                        <label for="servicio">Servicio:</label>
                        <select name="servicio" id="servicio">
                            <option value="">Todos los servicios</option>
                            <?php foreach ($servicios as $servicio): ?>
                                <option value="<?php echo $servicio['id']; ?>" 
                                        <?php echo $servicio_id == $servicio['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($servicio['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="filtro-grupo">
                        <label for="cliente">Cliente:</label>
                        <input type="text" name="cliente" id="cliente" 
                               value="<?php echo htmlspecialchars($cliente); ?>" 
                               placeholder="Buscar por cliente">
                    </div>

                    <div class="filtro-grupo">
                        <label for="tipo_solucion">Tipo de Solución:</label>
                        <select name="tipo_solucion" id="tipo_solucion">
                            <option value="">Todos los tipos</option>
                            <?php foreach ($tipos_solucion as $tipo): ?>
                                <option value="<?php echo htmlspecialchars($tipo['tipo_solucion']); ?>" 
                                        <?php echo $tipo_solucion == $tipo['tipo_solucion'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($tipo['tipo_solucion']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <?php if ($servicio_id || $cliente || $tipo_solucion): ?>
                        <a href="proyectos.php" class="btn btn-outline">Limpiar filtros</a>
                    <?php endif; ?>
                </form>
            </div>
        </section>

        <section class="proyectos-grid">
            <div class="container">
                <?php if (empty($proyectos)): ?>
                    <div class="no-resultados">
                        <i class="fas fa-search"></i>
                        <h3>No se encontraron proyectos</h3>
                        <p>Intenta con otros criterios de búsqueda</p>
                    </div>
                <?php else: ?>
                    <div class="grid">
                        <?php foreach ($proyectos as $proyecto): ?>
                            <div class="proyecto-card">
                                <?php if ($proyecto['imagen']): ?>
                                    <div class="proyecto-imagen">
                                        <img src="<?php echo htmlspecialchars($proyecto['imagen']); ?>" 
                                             alt="<?php echo htmlspecialchars($proyecto['cliente']); ?>"
                                             loading="lazy">
                                    </div>
                                <?php endif; ?>
                                <div class="proyecto-contenido">
                                    <h3><?php echo htmlspecialchars($proyecto['cliente']); ?></h3>
                                    <p class="tipo-solucion"><?php echo htmlspecialchars($proyecto['tipo_solucion']); ?></p>
                                    <p class="descripcion"><?php echo htmlspecialchars($proyecto['descripcion_corta']); ?></p>
                                    <a href="proyecto.php?id=<?php echo $proyecto['id']; ?>" class="btn btn-outline">
                                        Ver proyecto
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <h2>¿Tienes un proyecto en mente?</h2>
                <p>Contáctanos para una asesoría personalizada</p>
                <a href="contacto.php" class="btn btn-primary">Solicitar Asesoría</a>
            </div>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            text-align: center;
            padding: 100px 0;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .filtros {
            background-color: #f8f9fa;
            padding: 40px 0;
        }

        .filtros-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            align-items: end;
        }

        .filtro-grupo {
            display: flex;
            flex-direction: column;
        }

        .filtro-grupo label {
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .filtro-grupo select,
        .filtro-grupo input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .proyectos-grid {
            padding: 80px 0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .proyecto-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .proyecto-card:hover {
            transform: translateY(-5px);
        }

        .proyecto-imagen {
            height: 200px;
            overflow: hidden;
        }

        .proyecto-imagen img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .proyecto-card:hover .proyecto-imagen img {
            transform: scale(1.1);
        }

        .proyecto-contenido {
            padding: 20px;
        }

        .proyecto-contenido h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .tipo-solucion {
            color: #007bff;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .descripcion {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .no-resultados {
            text-align: center;
            padding: 60px 0;
        }

        .no-resultados i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .no-resultados h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .no-resultados p {
            color: #666;
        }

        .cta {
            padding: 60px 0;
            text-align: center;
            background-color: #f8f9fa;
        }

        .cta h2 {
            margin-bottom: 1rem;
        }

        .cta p {
            margin-bottom: 2rem;
            color: #666;
        }

        @media (max-width: 768px) {
            .hero {
                padding: 60px 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .filtros-form {
                grid-template-columns: 1fr;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html> 