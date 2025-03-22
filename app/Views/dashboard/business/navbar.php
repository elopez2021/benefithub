<link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            background: #2c3e50;
            min-height: 100vh;
            color: white;
            padding: 20px;
        }
        
        .main-content {
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        
        .employee-card {
            transition: all 0.3s;
            border: 1px solid #dee2e6;
        }
        
        .employee-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .credit-badge {
            background-color: #e9ecef;
            color: #495057;
            border: 1px solid #dee2e6;
        }
    </style>

     <!-- Sidebar -->
<div class="sidebar">
    <h4 class="mb-4">BenefitHub Empresas</h4>
    <div class="list-group">
        <!-- Empleados -->
        <a href="<?= base_url('admin/employees'); ?>" class="list-group-item list-group-item-action bg-transparent text-white border-0 <?= uri_string() === 'admin/employees' ? 'active' : ''; ?>">
            <i class="bi bi-people me-2"></i>Empleados
        </a>
        
        <!-- Créditos -->
        <a href="<?= base_url('admin/credits'); ?>" class="list-group-item list-group-item-action bg-transparent text-white border-0 <?= uri_string() === 'admin/credits' ? 'active' : ''; ?>">
            <i class="bi bi-credit-card me-2"></i>Créditos
        </a>
        
        <!-- Reportes -->
        <a href="<?= base_url('admin/reports'); ?>" class="list-group-item list-group-item-action bg-transparent text-white border-0 <?= uri_string() === 'admin/reports' ? 'active' : ''; ?>">
            <i class="bi bi-bar-chart me-2"></i>Reportes
        </a>

        <!-- Cerrar sesión -->
        <a href="<?= site_url('logout'); ?>" class="list-group-item list-group-item-action bg-transparent text-white border-0">
            <i class="bi bi-box-arrow-left me-2"></i>Cerrar Sesión
        </a>
    </div>
</div>


<script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>""></script>