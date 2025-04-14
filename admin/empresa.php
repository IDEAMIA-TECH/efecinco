<?php
require_once('../includes/db.php');
require_once('includes/auth.php');

// Verificar autenticación
verificarAutenticacion();

$conexion = conectarDB();

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    
    switch ($accion) {
        case 'actualizar':
            $nombre = $_POST['nombre'] ?? '';
            $mision = $_POST['mision'] ?? '';
            $vision = $_POST['vision'] ?? '';
            $historia = $_POST['historia'] ?? '';
            $direccion = $_POST['direccion'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $email = $_POST['email'] ?? '';
            $horario = $_POST['horario'] ?? '';
            $facebook = $_POST['facebook'] ?? '';
            $instagram = $_POST['instagram'] ?? '';
            $linkedin = $_POST['linkedin'] ?? '';
            $whatsapp = $_POST['whatsapp'] ?? '';
            $coordenadas = $_POST['coordenadas'] ?? '';

            // Procesar logo
            $logo = $_POST['logo_actual'] ?? '';
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $directorio = '../assets/images/';
                if (!file_exists($directorio)) {
                    mkdir($directorio, 0777, true);
                }

                $nombre_archivo = uniqid() . '_' . basename($_FILES['logo']['name']);
                $ruta_archivo = $directorio . $nombre_archivo;

                if (move_uploaded_file($_FILES['logo']['tmp_name'], $ruta_archivo)) {
                    // Eliminar logo anterior si existe
                    if ($logo && file_exists('../' . $logo)) {
                        unlink('../' . $logo);
                    }
                    $logo = 'assets/images/' . $nombre_archivo;
                }
            }

            // Verificar si ya existe un registro
            $sql = "SELECT id FROM empresa WHERE id = 1";
            $stmt = consultaSegura($conexion, $sql, []);
            $existe = $stmt->get_result()->num_rows > 0;

            if ($existe) {
                $sql = "UPDATE empresa SET 
                        nombre = ?, mision = ?, vision = ?, historia = ?, 
                        direccion = ?, telefono = ?, email = ?, horario = ?, 
                        facebook = ?, instagram = ?, linkedin = ?, whatsapp = ?, 
                        coordenadas = ?, logo = ? 
                        WHERE id = 1";
            } else {
                $sql = "INSERT INTO empresa (
                        nombre, mision, vision, historia, direccion, telefono, 
                        email, horario, facebook, instagram, linkedin, whatsapp, 
                        coordenadas, logo
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            }

            $stmt = consultaSegura($conexion, $sql, [
                $nombre, $mision, $vision, $historia, $direccion, $telefono,
                $email, $horario, $facebook, $instagram, $linkedin, $whatsapp,
                $coordenadas, $logo
            ]);

            if ($stmt->affected_rows > 0) {
                header('Location: empresa.php?mensaje=actualizado');
                exit;
            }
            break;
    }
}

// Obtener datos actuales de la empresa
$sql = "SELECT * FROM empresa WHERE id = 1";
$stmt = consultaSegura($conexion, $sql, []);
$empresa = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la Empresa - Efecinco</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .preview-image {
            max-width: 200px;
            margin-top: 10px;
        }

        .preview-image img {
            width: 100%;
            border-radius: 5px;
        }

        .grid-2-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .grid-2-columns {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Datos de la Empresa</h1>
        </div>

        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'actualizado'): ?>
            <div class="alert alert-success">
                Datos actualizados exitosamente
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="accion" value="actualizar">
            <input type="hidden" name="logo_actual" value="<?php echo $empresa['logo'] ?? ''; ?>">

            <div class="grid-2-columns">
                <div class="form-group">
                    <label for="nombre">Nombre de la Empresa</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" 
                           value="<?php echo htmlspecialchars($empresa['nombre'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                    <div class="preview-image" id="previewLogo">
                        <?php if (isset($empresa['logo']) && $empresa['logo']): ?>
                            <img src="../<?php echo htmlspecialchars($empresa['logo']); ?>" alt="Logo actual">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="mision">Misión</label>
                <textarea class="form-control" id="mision" name="mision" required><?php 
                    echo htmlspecialchars($empresa['mision'] ?? ''); 
                ?></textarea>
            </div>

            <div class="form-group">
                <label for="vision">Visión</label>
                <textarea class="form-control" id="vision" name="vision" required><?php 
                    echo htmlspecialchars($empresa['vision'] ?? ''); 
                ?></textarea>
            </div>

            <div class="form-group">
                <label for="historia">Historia</label>
                <textarea class="form-control" id="historia" name="historia" required><?php 
                    echo htmlspecialchars($empresa['historia'] ?? ''); 
                ?></textarea>
            </div>

            <div class="grid-2-columns">
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" 
                           value="<?php echo htmlspecialchars($empresa['direccion'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" 
                           value="<?php echo htmlspecialchars($empresa['telefono'] ?? ''); ?>" required>
                </div>
            </div>

            <div class="grid-2-columns">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?php echo htmlspecialchars($empresa['email'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="horario">Horario de Atención</label>
                    <input type="text" class="form-control" id="horario" name="horario" 
                           value="<?php echo htmlspecialchars($empresa['horario'] ?? ''); ?>" required>
                </div>
            </div>

            <div class="grid-2-columns">
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="url" class="form-control" id="facebook" name="facebook" 
                           value="<?php echo htmlspecialchars($empresa['facebook'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="url" class="form-control" id="instagram" name="instagram" 
                           value="<?php echo htmlspecialchars($empresa['instagram'] ?? ''); ?>">
                </div>
            </div>

            <div class="grid-2-columns">
                <div class="form-group">
                    <label for="linkedin">LinkedIn</label>
                    <input type="url" class="form-control" id="linkedin" name="linkedin" 
                           value="<?php echo htmlspecialchars($empresa['linkedin'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="whatsapp">WhatsApp</label>
                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" 
                           value="<?php echo htmlspecialchars($empresa['whatsapp'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="coordenadas">Coordenadas para Google Maps</label>
                <input type="text" class="form-control" id="coordenadas" name="coordenadas" 
                       value="<?php echo htmlspecialchars($empresa['coordenadas'] ?? ''); ?>" 
                       placeholder="Ejemplo: 19.4326,-99.1332">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <script>
        // Preview de logo
        document.getElementById('logo').addEventListener('change', function(e) {
            const preview = document.getElementById('previewLogo');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html> 