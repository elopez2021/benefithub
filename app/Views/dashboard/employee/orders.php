<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos - BenefitHub</title>
 
    <style>
        .order-card {
            transition: all 0.3s;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        
        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        
        .status-badge.completed {
            background: #28a745;
            color: white;
        }
        
        .status-badge.in-progress {
            background: #ffc107;
            color: black;
        }
        
        .status-badge.cancelled {
            background: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
     <!-- Menú Principal (Igual que antes) -->

     <?php include 'navbar.php'; ?>
    <!-- Contenido Principal -->
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- Encabezado -->
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Mis Pedidos</h2>
                    <p class="text-muted">Revisa el historial de tus pedidos realizados con tus beneficios</p>
                </div>

                <!-- Filtros -->
                <div class="d-flex justify-content-between mb-4">
                    <div>
                        <select class="form-select">
                            <option>Todos los estados</option>
                            <option>Completados</option>
                            <option>En proceso</option>
                            <option>Cancelados</option>
                        </select>
                    </div>
                    <div>
                        <input type="date" class="form-control">
                    </div>
                </div>

                <!-- Lista de Pedidos -->
                <div class="list-group">
                    <!-- Pedido 1 -->
                    <div class="list-group-item order-card mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">La Cantina Mexicana</h5>
                                <small class="text-muted">15/02/2024 - 12:30 PM</small>
                            </div>
                            <div>
                                <span class="status-badge completed">Completado</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="mb-1">2x Tacos al Pastor - $150.00</p>
                            <p class="mb-1">1x Guacamole - $90.00</p>
                            <p class="mb-1">Total: $240.00 MXN</p>
                        </div>
                    </div>

                    <!-- Pedido 2 -->
                    <div class="list-group-item order-card mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Pizzas Italianas</h5>
                                <small class="text-muted">14/02/2024 - 7:45 PM</small>
                            </div>
                            <div>
                                <span class="status-badge in-progress">En proceso</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="mb-1">1x Pizza Margarita - $180.00</p>
                            <p class="mb-1">1x Refresco - $30.00</p>
                            <p class="mb-1">Total: $210.00 MXN</p>
                        </div>
                    </div>

                    <!-- Pedido 3 -->
                    <div class="list-group-item order-card mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Sushi Express</h5>
                                <small class="text-muted">10/02/2024 - 1:15 PM</small>
                            </div>
                            <div>
                                <span class="status-badge cancelled">Cancelado</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="mb-1">1x Sushi Variado - $200.00</p>
                            <p class="mb-1">1x Té Verde - $25.00</p>
                            <p class="mb-1">Total: $225.00 MXN</p>
                        </div>
                    </div>
                </div>

                <!-- Paginación -->
                <nav class="mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Anterior</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>