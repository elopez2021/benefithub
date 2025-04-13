<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenes</title>

    <style>
    .avatar-sm {
        width: 32px;
        height: 32px;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .badge {
        font-weight: 500;
    }
</style>
</head>
<body>
<div class="wrapper d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <?php include 'navbar.php'; ?>
    </div>
    
    <!-- Contenido Principal -->
    <div class="main-content flex-grow-1">
        <!-- Sección Pedidos -->
        <div id="pedidos">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="bi bi-receipt me-2"></i>Gestión de Pedidos</h3>
                <div class="d-flex gap-2">
                    <div class="input-group" style="width: 250px;">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Buscar pedidos...">
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-funnel me-1"></i> Filtros
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Todos</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Pendientes</a></li>
                            <li><a class="dropdown-item" href="#">En preparación</a></li>
                            <li><a class="dropdown-item" href="#">Completados</a></li>
                            <li><a class="dropdown-item" href="#">Cancelados</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tabla de Pedidos -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="120">N° Pedido</th>
                                    <th>Empleado</th>
                                    <th>Productos</th>
                                    <th width="120">SubTotal</th>
                                    <th width="120">Total</th>
                                    <th width="150">Estado</th>
                                    <th width="150">Fecha</th>
                                    <th width="100" class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td class="fw-bold">#<?= $order['id'] ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-person-fill text-muted"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0"><?= esc($order['employee_name'] ?? 'N/A') ?></h6>
                                                    <small class="text-muted">ID: <?= esc($order['employee_id']) ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <?php foreach ($order['items'] as $item): ?>
                                                    <span class="badge bg-light text-dark border"><?= $item['quantity'] ?>x Producto #<?= $item['product_id'] ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        </td>
                                        <td class="fw-bold">RD$ <?= number_format($order['subtotal'], 2) ?></td>
                                        <td class="fw-bold">RD$ <?= number_format($order['total'], 2) ?></td>                                        
                                        <td>
                                            <?php
                                                $statusClasses = [
                                                    'pending' => 'bg-warning text-dark',
                                                    'processing' => 'bg-info text-white',
                                                    'completed' => 'bg-success text-white',
                                                    'cancelled' => 'bg-danger text-white',
                                                ];
                                                $statusLabel = [
                                                    'pending' => 'Pendiente',
                                                    'processing' => 'En preparación',
                                                    'completed' => 'Completado',
                                                    'cancelled' => 'Cancelado',
                                                ];
                                                $status = $order['status'];
                                            ?>
                                            <span class="badge <?= $statusClasses[$status] ?> rounded-pill">
                                                <?= $statusLabel[$status] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></small>
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detallePedidoModal" 
                                                    data-order-id="<?= $order['id']; ?>" 
                                                    data-customer-name="<?= esc($order['employee_name'] ?? 'N/A'); ?>" 
                                                    data-order-date="<?= $order['created_at']; ?>" 
                                                    data-order-status="<?= $order['status']; ?>" 
                                                    data-order-total="<?= $order['total']; ?>"
                                                    data-business-name="<?= $order['business_name']; ?>"
                                                    data-products="<?= htmlspecialchars(json_encode($order['items']), ENT_QUOTES, 'UTF-8'); ?>">
                                                        <i class="bi bi-eye me-2"></i>Ver detalle
                                                    </button>

                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item text-success">
                                                            <i class="bi bi-hourglass-split me-2"></i>Preparar
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item text-danger">
                                                            <i class="bi bi-x-circle me-2"></i>Cancelar
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <!-- Paginación -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Mostrando 1 a 2 de 10 pedidos
                </div>
                <nav>
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detalle Pedido -->
<div class="modal fade" id="detallePedidoModal" tabindex="-1" aria-labelledby="detallePedidoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallePedidoModalLabel">Detalle del Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-3"><i class="bi bi-person me-2"></i>Información del Cliente</h6>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Nombre:</span>
                                <span id="customer-name" class="fw-bold"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Empresa:</span>
                                <span id="business-name"></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Información del Pedido</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Fecha:</span>
                                <span id="order-date"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Estado:</span>
                                <span id="order-status" class="badge"></span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <h6 class="mt-4 mb-3"><i class="bi bi-basket me-2"></i>Productos</h6>
                <div class="table-responsive">
                    <table class="table table-sm" id="product-table">
                        <thead>
                            <tr>
                                <th width="50">Cant</th>
                                <th>Producto</th>
                                <th class="text-end">P. Unitario</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic Product Rows will be added here -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Subtotal:</th>
                                <th id="order-subtotal" class="text-end"></th>
                            </tr>
                            <tr class="table-active">
                                <th colspan="3" class="text-end">Total:</th>
                                <th id="order-total" class="text-end"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('detallePedidoModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        
        try {
            var orderId = button.getAttribute('data-order-id');
            var customerName = button.getAttribute('data-customer-name');
            var orderDate = button.getAttribute('data-order-date');
            var orderStatus = button.getAttribute('data-order-status');
            var orderTotal = button.getAttribute('data-order-total');
            var productsJson = button.getAttribute('data-products');
            var businessName = button.getAttribute('data-business-name');
            
            // Safely parse JSON
            var products = [];
            try {
                products = JSON.parse(productsJson);
            } catch (e) {
                console.error('Error parsing products JSON:', e);
                products = [];
            }

            // Rest of your modal population code...
            document.getElementById('customer-name').textContent = customerName;
            document.getElementById('order-date').textContent = new Date(orderDate).toLocaleString();
            
            // Status display
            var statusLabel = {
                'pending': 'Pendiente',
                'processing': 'En preparación',
                'completed': 'Completado',
                'cancelled': 'Cancelado'
            };
            
            var statusClass = {
                'pending': 'bg-warning text-dark',
                'processing': 'bg-info text-white',
                'completed': 'bg-success text-white',
                'cancelled': 'bg-danger text-white'
            };
            
            var orderStatusElement = document.getElementById('order-status');
            orderStatusElement.textContent = statusLabel[orderStatus] || orderStatus;
            orderStatusElement.className = 'badge rounded-pill ' + (statusClass[orderStatus] || 'bg-secondary');
            
            // Product table population
            var productTableBody = document.querySelector('#product-table tbody');
            productTableBody.innerHTML = '';
            
            var subtotal = 0;
            
            products.forEach(function(product) {
                var row = document.createElement('tr');
                
                // Add cells for each product property
                ['quantity', 'name', 'unit_price', 'subtotal'].forEach(function(prop) {
                    var cell = document.createElement('td');
                    if (prop === 'unit_price' || prop === 'subtotal') {
                        cell.className = 'text-end';
                        cell.textContent = 'RD$ ' + (parseFloat(product[prop] || 0)).toFixed(2);
                        if (prop === 'subtotal') subtotal += parseFloat(product[prop] || 0);
                    } else {
                        cell.textContent = product[prop] || (prop === 'name' ? 'Producto #' + (product.product_id || '') : '');
                    }
                    row.appendChild(cell);
                });
                
                productTableBody.appendChild(row);
            });
            
            // Update totals
            document.getElementById('order-subtotal').textContent = 'RD$ ' + subtotal.toFixed(2);
            document.getElementById('order-total').textContent = 'RD$ ' + parseFloat(orderTotal).toFixed(2);
            document.getElementById('business-name').textContent = businessName;
            
        } catch (error) {
            console.error('Error showing order details:', error);
        }
    });
</script>

    
</body>
</html>