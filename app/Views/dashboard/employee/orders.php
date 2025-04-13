<?php
$statusTranslations = [
    'pending'    => 'Pendiente',
    'processing' => 'En proceso',
    'completed'  => 'Completado',
    'cancelled'  => 'Cancelado'
];
?>

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


     <?php include 'navbar.php'; ?>
    <!-- Contenido Principal -->
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Mis Pedidos</h2>
                    <p class="text-muted">Revisa el historial de tus pedidos realizados con tus beneficios</p>
                </div>

                <!-- Filters -->
                <div class="d-flex justify-content-between mb-4">
                    <div>
                        <select class="form-select" id="statusFilter">
                            <option value="">Todos los estados</option>
                            <option value="pending">Pendiente</option>
                            <option value="processing">En proceso</option>
                            <option value="completed">Completado</option>
                            <option value="cancelled">Cancelado</option>
                        </select>
                    </div>
                    <div>
                        <input type="date" class="form-control" id="dateFilter">
                    </div>
                </div>

                <!-- Orders List -->
                <div class="list-group" id="ordersList">
                    <?php if (empty($orders)): ?>
                        <div class="alert alert-info">
                            No has realizado ningún pedido aún.
                        </div>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <div class="list-group-item order-card mb-3" 
                                data-status="<?= strtolower($order['status']) ?>"
                                
                                data-date="<?= date('Y-m-d', strtotime($order['created_at'])) ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1"><?= esc($order['restaurant_name']) ?></h5>
                                        <small class="text-muted">
                                            <?= $order['formatted_date'] ?> - <?= $order['formatted_time'] ?>
                                        </small>
                                    </div>
                                    <div>
                                        <span class="badge 
                                            <?= $order['status'] === 'completed' ? 'bg-success' : '' ?>
                                            <?= $order['status'] === 'pending' ? 'bg-warning text-dark' : '' ?>
                                            <?= $order['status'] === 'processing' ? 'bg-warning text-dark' : '' ?>
                                            <?= $order['status'] === 'cancelled' ? 'bg-danger' : '' ?>">
                                            <?= $statusTranslations[$order['status']] ?? ucfirst($order['status']) ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <?php foreach ($order['items'] as $item): ?>
                                        <p class="mb-1">
                                            <?= $item['quantity'] ?>x <?= esc($item['product_name']) ?> - 
                                            RD$ <?= number_format($item['price'], 2) ?>
                                        </p>
                                    <?php endforeach; ?>
                                    <div class="mt-2 pt-2 border-top">
                                        <p class="mb-1 fw-bold">Subtotal: RD$ <?= number_format($order['subtotal'], 2) ?></p>
                                        <p class="mb-1 fw-bold">Total: RD$ <?= number_format($order['total'], 2) ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Pagination would go here -->
            </div>
        </div>
    </div>

    <style>
        .order-card {
            border-radius: 8px;
            border-left: 4px solid #0d6efd;
            transition: all 0.3s ease;
        }
        .order-card:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>

    <script>
    // Filter orders by status and date
    document.getElementById('statusFilter').addEventListener('change', filterOrders);
    document.getElementById('dateFilter').addEventListener('change', filterOrders);

    function filterOrders() {
        const statusFilter = document.getElementById('statusFilter').value;
        const dateFilter = document.getElementById('dateFilter').value;
        const orderCards = document.querySelectorAll('.order-card');
        
        orderCards.forEach(card => {
            const cardStatus = card.getAttribute('data-status');
            const cardDate = card.getAttribute('data-date');
            
            const statusMatch = !statusFilter || cardStatus === statusFilter;
            const dateMatch = !dateFilter || cardDate === dateFilter;
            
            if (statusMatch && dateMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    </script>
</body>
</html>