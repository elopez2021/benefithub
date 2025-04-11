<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>"">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>"">

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
        
        .product-card {
            transition: all 0.3s;
            border: 1px solid #dee2e6;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .schedule-badge {
            background-color: #e9ecef;
            color: #495057;
            border: 1px solid #dee2e6;
        }
    </style>

<!-- Sidebar -->
<div class="sidebar">
            <h4 class="mb-4">BenefitHub Restaurante</h4>
            <div class="list-group">
                <a class="list-group-item list-group-item-action bg-transparent text-white border-0 <?= uri_string() === 'restaurant/dashboard' ? 'active' : ''; ?>" href="<?= base_url('restaurant/dashboard'); ?>">
                    <i class="bi bi-egg-fried me-2"></i>Productos
                </a>
                <a class="list-group-item list-group-item-action bg-transparent text-white border-0 <?= uri_string() === 'restaurant/categories' ? 'active' : ''; ?>" href="<?= base_url('restaurant/categories'); ?>">
                    <i class="bi bi-tags me-2"></i>Categorías
                </a>

                <a class="list-group-item list-group-item-action bg-transparent text-white border-0 <?= uri_string() === 'restaurant/orders' ? 'active' : ''; ?>" href="<?= base_url('restaurant/orders'); ?>">
                    <i class="bi bi-card-checklist me-2"></i>Ordenes
                </a>
            
                <a class="list-group-item list-group-item-action bg-transparent text-white border-0" href="<?= site_url('logout'); ?>">
                    <i class="bi bi-box-arrow-left me-2"></i>Cerrar Sesión
                </a>
            </div>
        </div>

        
        <script src="<?= base_url('assets/js/axios.min.js') ; ?> "></script>
        <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>""></script>