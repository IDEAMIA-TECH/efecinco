<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once '../includes/models/User.php';
require_once '../includes/models/Service.php';

// Verificar autenticación
if (!isLoggedIn()) {
    redirect('admin/login.php');
}

// Obtener estadísticas
$service = new Service();
$totalServices = $service->getTotalServices();
$activeServices = $service->getActiveServices();
$featuredServices = $service->getFeaturedServicesCount();

$user = new User();
$totalUsers = $user->getTotalUsers();
$activeUsers = $user->getActiveUsersCount();

// Establecer el título de la página
$pageTitle = 'Dashboard';

// Incluir el header del admin
include 'includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo SITE_URL; ?>/admin/dashboard">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/services">
                            <i class="fas fa-cogs me-2"></i>
                            Servicios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/projects">
                            <i class="fas fa-project-diagram me-2"></i>
                            Proyectos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/team">
                            <i class="fas fa-users me-2"></i>
                            Equipo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/testimonials">
                            <i class="fas fa-comments me-2"></i>
                            Testimonios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/users">
                            <i class="fas fa-user-cog me-2"></i>
                            Usuarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>/admin/settings">
                            <i class="fas fa-cog me-2"></i>
                            Configuración
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Imprimir</button>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Servicios</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalServices; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-cogs fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Servicios Activos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $activeServices; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Servicios Destacados</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $featuredServices; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-star fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Usuarios Activos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $activeUsers; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Actividad Reciente</h6>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <!-- Aquí iría la lista de actividades recientes -->
                                <p class="text-muted">No hay actividades recientes.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Estadísticas de Visitas</h6>
                        </div>
                        <div class="card-body">
                            <!-- Aquí iría el gráfico de visitas -->
                            <p class="text-muted">No hay datos de visitas disponibles.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 