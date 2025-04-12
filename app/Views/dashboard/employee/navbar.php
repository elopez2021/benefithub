<link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
        .restaurant-card {
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .restaurant-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        
        .balance-card {
            background: linear-gradient(45deg, #0d6efd, #0b5ed7);
            color: white;
        }
    </style>

<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold" href="#">
                <i class="bi bi-currency-exchange me-2"></i>BenefitHub
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Home (Inicio) -->
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() === 'employee/dashboard' ? 'active' : ''; ?>" href="<?= base_url('employee/dashboard'); ?>">
                            <i class="bi bi-house-door me-1"></i>Inicio
                        </a>
                    </li>

                    <!-- My Orders (Mis Pedidos) -->
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() === 'employee/orders' ? 'active' : ''; ?>" href="<?= base_url('employee/orders'); ?>">
                            <i class="bi bi-receipt me-1"></i>Mis Pedidos
                        </a>
                    </li>

                    <!-- My Account (Mi Cuenta) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>Mi Cuenta
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('employee/profile'); ?>">Perfil</a></li>
                            <!-- Logout (Cerrar Sesión) -->
                            <li><a class="dropdown-item" href="<?= base_url('logout'); ?>"  onclick="clearCart()">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>


    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>""></script>
    <script src="<?= base_url('assets/js/axios.min.js') ; ?> "></script>

<script>
    function clearCart() {
        if (localStorage.getItem('cart')) {
            localStorage.removeItem('cart');
        }
    }
</script>