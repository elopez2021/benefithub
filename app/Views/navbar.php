<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>"">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>"">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-primary fw-bold" href="<?= route_to('/') ?>">
            <i class="bi bi-currency-exchange me-2"></i>BenefitHub
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Home Link -->
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?> " href="<?= route_to('/') ?>">Inicio</a>
                </li>
                
                <!-- Restaurants Link -->
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' && isset($_GET['#restaurantes']) ? 'active' : ''; ?>" href="index.php#restaurante">Restaurantes</a>
                </li>
                
                <!-- About Link -->
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?> "href="<?= route_to('about') ?>">Sobre Nosotros</a>
                </li>
                
                <!-- Contact Link -->
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' && isset($_GET['#contacto']) ? 'active' : ''; ?>" href="index.php#contacto">Contacto</a>
                </li>
                
                <!-- Login Link -->
                <li class="nav-item">
                    <a class="btn btn-primary ms-3" href="<?= route_to('login') ?>">Iniciar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>""></script>

<script>

document.addEventListener('DOMContentLoaded', function () {
    // Check if the URL contains a hash (e.g., #restaurantes)
    if (window.location.hash) {
        const target = document.querySelector(window.location.hash);
        if (target) {
            // Smooth scroll to the target section
            target.scrollIntoView({ behavior: 'smooth' });
        }
    }
});
</script>
