<?php
require_once('auth.php');
require_once('../includes/db.php');

// Verificar autenticación
verificarAutenticacion();

$conexion = conectarDB();

// Variables para el header
$titulo_pagina = 'Datos de la Empresa';
$pagina_actual = 'empresa';

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

            // Actualizar el número de WhatsApp en la base de datos
            $sql = "UPDATE empresa SET whatsapp = ? WHERE id = 1";
            $stmt = consultaSegura($conexion, $sql, [$whatsapp]);
            
            if ($stmt->affected_rows > 0) {
                $mensaje = 'Configuración actualizada correctamente';
                $tipo_mensaje = 'success';
            } else {
                $mensaje = 'Error al actualizar la configuración';
                $tipo_mensaje = 'danger';
            }
            break;
    }
}

// Obtener datos actuales de la empresa
$sql = "SELECT * FROM empresa WHERE id = 1";
$stmt = consultaSegura($conexion, $sql, []);
$empresa = $stmt->get_result()->fetch_assoc();

// Incluir el header
include('includes/header.php');
?>

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
                       value="523331462579" required>
                <small class="form-text text-muted">Ingrese el número sin espacios ni caracteres especiales (ejemplo: 523331462579)</small>
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

<?php
// Variable para scripts adicionales
$scripts_adicionales = '
<script>
    // Preview de logo
    document.getElementById("logo").addEventListener("change", function(e) {
        const preview = document.getElementById("previewLogo");
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
';

// Incluir el footer
include('includes/footer.php');
?> 