<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - La Cantina Mexicana</title>

    <style>
        .menu-item-card {
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .menu-item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .cart {
            position: sticky;
            top: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .cart-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <!-- Menú Principal -->
    <?php include 'navbar.php'; ?>


    <!-- Contenido Principal -->
    <div class="container my-5">

        <div class="row">
            <!-- Menú del Restaurante -->
            <div class="col-md-8">
                <h2 class="mb-4">Menú de La Cantina Mexicana</h2>

                <div class="mt-2">
                    <select class="form-select">
                        <option>Todas las categorías</option>
                        <option>Mexicana</option>
                        <option>Italiana</option>
                        <option>Asiática</option>
                    </select>
                </div>
                
                <!-- Categoría: Entradas -->
                <h4 class="mt-4 mb-3">Entradas</h4>
                <div class="row g-4">
                    <!-- Plato 1 -->
                    <div class="col-md-6">
                        <div class="card menu-item-card h-100">
                            <img src="https://source.unsplash.com/random/600x400?nachos" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Nachos con Queso</h5>
                                <p class="text-muted">Tortilla chips con queso fundido y guacamole.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">$120.00 DOP</span>
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-cart-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Plato 2 -->
                    <div class="col-md-6">
                        <div class="card menu-item-card h-100">
                            <img src="https://source.unsplash.com/random/600x400?guacamole" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Guacamole Fresco</h5>
                                <p class="text-muted">Aguacate, tomate, cebolla y cilantro.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">$90.00 DOP</span>
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-cart-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categoría: Platos Fuertes -->
                <h4 class="mt-5 mb-3">Platos Fuertes</h4>
                <div class="row g-4">
                    <!-- Plato 3 -->
                    <div class="col-md-6">
                        <div class="card menu-item-card h-100">
                            <img src="https://source.unsplash.com/random/600x400?tacos" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Tacos al Pastor</h5>
                                <p class="text-muted">Tres tacos con piña, cebolla y cilantro.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">$150.00 DOP</span>
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-cart-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Plato 4 -->
                    <div class="col-md-6">
                        <div class="card menu-item-card h-100">
                            <img src="https://source.unsplash.com/random/600x400?enchiladas" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Enchiladas Verdes</h5>
                                <p class="text-muted">Rellenas de pollo, bañadas en salsa verde.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">$180.00 DOP</span>
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-cart-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carrito de Compras -->
            <div class="col-md-4">
                <div class="cart">
                    <h4 class="mb-4">
                        <i class="bi bi-cart3 me-2"></i>Tu Pedido
                    </h4>
                    
                    <!-- Items del Carrito -->
                    <div class="cart-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6>Nachos con Queso</h6>
                                <small class="text-muted">1 x $120.00</small>
                            </div>
                            <span class="text-danger" style="cursor: pointer;">
                                <i class="bi bi-trash"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="cart-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6>Tacos al Pastor</h6>
                                <small class="text-muted">2 x $150.00</small>
                            </div>
                            <span class="text-danger" style="cursor: pointer;">
                                <i class="bi bi-trash"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="mt-4 pt-3 border-top">
                        <h5 class="d-flex justify-content-between">
                            <span>Total:</span>
                            <span>$420.00 DOP</span>
                        </h5>
                        <button class="btn btn-primary w-100 mt-3">
                            <i class="bi bi-check-circle me-2"></i>Confirmar Pedido
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>