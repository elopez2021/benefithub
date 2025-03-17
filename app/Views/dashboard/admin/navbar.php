<link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            background: #2c3e50;
            min-height: 100vh;
            padding: 20px;
            color: white;
        }
        
        .main-content {
            padding: 20px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }
    </style>


        <!-- app/Views/includes/sidebar.php -->
<div class="sidebar">
    <h4 class="mb-4">BenefitHub Admin</h4>
    <ul class="nav flex-column">
        <li class="nav-item mb-3">
            <a class="nav-link text-white <?= uri_string() === 'admin/dashboard' ? 'active' : ''; ?>" href="<?= site_url('admin/dashboard'); ?>">
                <i class="bi bi-house me-2"></i>Inicio
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link text-white <?= uri_string() === 'admin/business' ? 'active' : ''; ?>" href="<?= site_url('admin/business'); ?>">
                <i class="bi bi-building me-2"></i>Empresas
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link text-white <?= uri_string() === 'admin/restaurants' ? 'active' : ''; ?>" href="<?= site_url('admin/restaurants'); ?>">
                <i class="bi bi-shop me-2"></i>Restaurantes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="<?= site_url('logout'); ?>">
                <i class="bi bi-box-arrow-left me-2"></i>Cerrar Sesión
            </a>
        </li>
    </ul>
</div>


<script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>""></script>