<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenes</title>
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
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="120">N° Pedido</th>
                                    <th>Cliente</th>
                                    <th>Productos</th>
                                    <th width="120">Total</th>
                                    <th width="150">Estado</th>
                                    <th width="150">Fecha</th>
                                    <th width="100" class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Ejemplo de fila de pedido -->
                                <tr>
                                    <td class="fw-bold">#1001</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <div class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-person-fill text-muted"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">Juan Pérez</h6>
                                                <small class="text-muted">809-555-1234</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <span class="badge bg-light text-dark border">2x Pizza Pepperoni</span>
                                            <span class="badge bg-light text-dark border">1x Refresco</span>
                                        </div>
                                    </td>
                                    <td class="fw-bold">RD$ 1,250.00</td>
                                    <td>
                                        <span class="badge bg-warning text-dark rounded-pill">Pendiente</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">15/05/2023 18:30</small>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detallePedidoModal">
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
                                
                                <!-- Segunda fila de ejemplo -->
                                <tr>
                                    <td class="fw-bold">#1002</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <div class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-person-fill text-muted"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">María Rodríguez</h6>
                                                <small class="text-muted">829-555-5678</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <span class="badge bg-light text-dark border">1x Ensalada César</span>
                                            <span class="badge bg-light text-dark border">1x Lasagna</span>
                                        </div>
                                    </td>
                                    <td class="fw-bold">RD$ 980.00</td>
                                    <td>
                                        <span class="badge bg-info text-white rounded-pill">En preparación</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">15/05/2023 19:15</small>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detallePedidoModal">
                                                        <i class="bi bi-eye me-2"></i>Ver detalle
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item text-success">
                                                        <i class="bi bi-check-circle me-2"></i>Completar
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
<div class="modal fade" id="detallePedidoModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle del Pedido #1001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-3"><i class="bi bi-person me-2"></i>Información del Cliente</h6>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Nombre:</span>
                                <span class="fw-bold">Juan Pérez</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Teléfono:</span>
                                <span>809-555-1234</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Dirección:</span>
                                <span>Calle Principal #123, Santo Domingo</span>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Información del Pedido</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Fecha:</span>
                                <span>15/05/2023 18:30</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Estado:</span>
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <h6 class="mt-4 mb-3"><i class="bi bi-basket me-2"></i>Productos</h6>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th width="50">Cant</th>
                                <th>Producto</th>
                                <th class="text-end">P. Unitario</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>Pizza Pepperoni (Grande)</td>
                                <td class="text-end">RD$ 550.00</td>
                                <td class="text-end">RD$ 1,100.00</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Refresco 2L</td>
                                <td class="text-end">RD$ 150.00</td>
                                <td class="text-end">RD$ 150.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Subtotal:</th>
                                <th class="text-end">RD$ 1,250.00</th>
                            </tr>
                            <tr class="table-active">
                                <th colspan="3" class="text-end">Total:</th>
                                <th class="text-end">RD$ 1,537.50</th>
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
    
</body>
</html>