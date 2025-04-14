<?php
session_start();
require_once('../includes/db.php');

// Si ya está logueado, redirigir al dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($usuario) && !empty($password)) {
        $conexion = conectarDB();
        $sql = "SELECT id, usuario, password_hash, nombre FROM usuarios_admin WHERE usuario = ?";
        $stmt = consultaSegura($conexion, $sql, [$usuario]);
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows === 1) {
            $admin = $resultado->fetch_assoc();
            if (password_verify($password, $admin['password_hash'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_nombre'] = $admin['nombre'];
                
                // Actualizar último acceso
                $sql = "UPDATE usuarios_admin SET ultimo_acceso = CURRENT_TIMESTAMP WHERE id = ?";
                consultaSegura($conexion, $sql, [$admin['id']]);
                
                header('Location: dashboard.php');
                exit;
            }
        }
        $error = 'Usuario o contraseña incorrectos';
    } else {
        $error = 'Por favor ingrese usuario y contraseña';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-box">
            <h1>Panel de Administración</h1>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html> 