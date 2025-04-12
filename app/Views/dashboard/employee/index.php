<?php
$formatter = new IntlDateFormatter(
    'es_ES', 
    IntlDateFormatter::FULL, 
    IntlDateFormatter::FULL,
    'America/Santo_Domingo',
    IntlDateFormatter::GREGORIAN,
    'd \'de\' MMMM'
);
$fechaManana = $formatter->format(strtotime('tomorrow'));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BenefitHub - Empleado</title>
</head>
<body>
    <!-- Menú Principal -->
    <?php include 'navbar.php'; ?>

    <!-- Dashboard Empleado -->
<div class="container my-5">
    <!-- Saldo y Búsqueda -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card balance-card shadow">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-wallet2 me-2"></i>Subsidio Disponible
                    </h5>
                    <h2 class="fw-bold">RD$ <?= number_format($employee['subsidy_left_today'], 2) ?></h2>
                    <small>Próxima recarga: <?= $fechaManana ?></small>

                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="input-group shadow">
                <input type="text" id="restaurantSearch" class="form-control" placeholder="Buscar restaurantes...">
                <button class="btn btn-primary" onclick="searchRestaurants()">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Listado de Restaurantes -->
    <h4 class="mb-4">Restaurantes Disponibles</h4>
    <div class="row g-4" id="restaurantsContainer">
        <?php foreach ($restaurants as $restaurant): ?>
        <div class="col-md-4 mb-4">
            <div class="card restaurant-card h-100">
                <img src="<?= esc($restaurant['image_url'] ?? 'https://placehold.co/600x400?text=Restaurant+Image') ?>" 
                     class="card-img-top" 
                     alt="<?= esc($restaurant['commercial_name']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($restaurant['commercial_name']) ?></h5>
                    
                    <button class="btn btn-primary w-100 mt-3" 
                            onclick="selectRestaurant(<?= $restaurant['id'] ?>)">
                        <i class="bi bi-cart-check me-2"></i>Seleccionar
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

    <script>

    function selectRestaurant(restaurantId) {
        window.location.href = `/employee/restaurant/menu/${restaurantId}`;
    }
    </script>

</body>
</html>