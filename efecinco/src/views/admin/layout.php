<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Efecinco</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Efecinco Admin</h1>
            </div>
            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <a href="/admin" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg <?= $current_page === 'dashboard' ? 'bg-gray-700' : '' ?>">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="/admin/servicios" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg <?= $current_page === 'servicios' ? 'bg-gray-700' : '' ?>">
                        <i class="fas fa-cogs mr-3"></i>
                        Servicios
                    </a>
                    <a href="/admin/proyectos" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg <?= $current_page === 'proyectos' ? 'bg-gray-700' : '' ?>">
                        <i class="fas fa-project-diagram mr-3"></i>
                        Proyectos
                    </a>
                    <a href="/admin/testimonios" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg <?= $current_page === 'testimonios' ? 'bg-gray-700' : '' ?>">
                        <i class="fas fa-comments mr-3"></i>
                        Testimonios
                    </a>
                    <a href="/admin/contactos" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg <?= $current_page === 'contactos' ? 'bg-gray-700' : '' ?>">
                        <i class="fas fa-envelope mr-3"></i>
                        Contactos
                    </a>
                    <a href="/admin/usuarios" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg <?= $current_page === 'usuarios' ? 'bg-gray-700' : '' ?>">
                        <i class="fas fa-users mr-3"></i>
                        Usuarios
                    </a>
                    <a href="/admin/configuracion" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg <?= $current_page === 'configuracion' ? 'bg-gray-700' : '' ?>">
                        <i class="fas fa-cog mr-3"></i>
                        Configuración
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <h2 class="text-xl font-semibold text-gray-800"><?= $page_title ?></h2>
                        </div>
                        <div class="flex items-center">
                            <div class="relative">
                                <button class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <span class="mr-2"><?= $_SESSION['user']['nombre'] ?></span>
                                    <i class="fas fa-user-circle text-2xl"></i>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden">
                                    <a href="/admin/perfil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Perfil</a>
                                    <a href="/admin/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar Sesión</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <?php if (isset($_SESSION['flash_message'])): ?>
                <div class="mb-4 p-4 rounded-md <?= $_SESSION['flash_type'] === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                    <?= $_SESSION['flash_message'] ?>
                </div>
                <?php unset($_SESSION['flash_message'], $_SESSION['flash_type']); endif; ?>

                <?= $content ?>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Toggle user dropdown
        $('.relative button').click(function() {
            $(this).next('.absolute').toggleClass('hidden');
        });

        // Close dropdown when clicking outside
        $(document).click(function(e) {
            if (!$(e.target).closest('.relative').length) {
                $('.absolute').addClass('hidden');
            }
        });
    </script>
</body>
</html>
<?php
$layout = ob_get_clean();
echo $layout;
?> 