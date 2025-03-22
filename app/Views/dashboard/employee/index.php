<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BenefitHub - Empleado</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
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
                            <i class="bi bi-wallet2 me-2"></i>Saldo Disponible
                        </h5>
                        <h2 class="fw-bold">$1,250.00 DOP</h2>
                        <small>Próxima recarga: 15 de marzo</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="input-group shadow">
                    <input type="text" class="form-control" placeholder="Buscar restaurantes...">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Listado de Restaurantes -->
        <h4 class="mb-4">Restaurantes Disponibles</h4>
        <div class="row g-4">
            <!-- Restaurante 1 -->
            <div class="col-md-4">
                <div class="card restaurant-card h-100">
                    <img src="https://placehold.co/600x400?text=Restaurant+Image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">La Cantina Mexicana</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-secondary">Mexicana</span>
                            <div class="rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100 mt-3">
                            <i class="bi bi-cart-check me-2"></i>Seleccionar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Restaurante 2 -->
            <div class="col-md-4">
                <div class="card restaurant-card h-100">
                    <img src="https://placehold.co/600x400?text=Restaurant+Image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Pizzas Italianas</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-secondary">Italiana</span>
                            <div class="rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100 mt-3">
                            <i class="bi bi-cart-check me-2"></i>Seleccionar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Restaurante 3 -->
            <div class="col-md-4">
                <div class="card restaurant-card h-100">
                    <img src="https://placehold.co/600x400?text=Restaurant+Image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Sushi Express</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-secondary">Asiática</span>
                            <div class="rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100 mt-3">
                            <i class="bi bi-cart-check me-2"></i>Seleccionar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historial de Pedidos -->
        <div class="card mt-5 shadow">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="bi bi-clock-history me-2"></i>Últimos Pedidos
                </h5>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6>La Cantina Mexicana</h6>
                                <small class="text-muted">15/02/2024 - $250.00 DOP</small>
                            </div>
                            <span class="badge bg-success">Completado</span>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6>Sushi Express</h6>
                                <small class="text-muted">14/02/2024 - $180.00 DOP</small>
                            </div>
                            <span class="badge bg-warning text-dark">En proceso</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>