<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Restaurante - Productos</title>
    
    
</head>
<body>
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        
        <?php include 'navbar.php'; ?>
        

        <!-- Contenido Principal -->
        <div class="main-content flex-grow-1">
            <!-- Sección Productos -->
            <div id="productos">
                <div class="d-flex justify-content-between mb-4">
                    <h3><i class="bi bi-egg-fried me-2"></i>Gestión de Productos</h3>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoProducto">
                        <i class="bi bi-plus-circle me-2"></i>Nuevo Producto
                    </button>
                </div>

                <!-- Lista de Productos -->
                <div class="row g-4">
                    <!-- Producto Ejemplo -->
                    <div class="col-md-4">
                        <div class="card product-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">Tostadas Francesas</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-link" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="editarProducto(1)">Editar</a></li>
                                            <li><a class="dropdown-item text-danger" href="#" onclick="eliminarProducto(1)">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-muted small">Pan francés con miel y frutas</p>
                                <div class="mb-3">
                                    <span class="badge bg-primary">Desayunos</span>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge schedule-badge">8:00 AM - 12:00 PM</span>
                                    <span class="badge schedule-badge">2:00 PM - 5:00 PM</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold">RD$ 250.00</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo Producto -->
    <div class="modal fade" id="nuevoProducto">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formProducto" onsubmit="guardarProducto(event)">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Categoría</label>
                                <div class="input-group">
                                    <select class="form-select" id="categoriaProducto" required>
                                        <option value="">Seleccionar categoría...</option>
                                        <!-- Categorías cargadas dinámicamente -->
                                    </select>
                                    <button type="button" class="btn btn-outline-secondary" 
                                            data-bs-toggle="modal" data-bs-target="#nuevaCategoria">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" rows="3" maxlength="200"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Precio (DOP)</label>
                                <input type="number" class="form-control" min="50" step="10" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Horarios Disponibles</label>
                                <div class="border p-3" style="max-height: 200px; overflow-y: auto;">
                                    <!-- Horarios cargados dinámicamente -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1">
                                        <label class="form-check-label">Desayuno (8:00 AM - 11:00 AM)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Nueva Categoría -->
    <div class="modal fade" id="nuevaCategoria">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formCategoria" onsubmit="guardarCategoria(event)">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre de la Categoría</label>
                            <input type="text" class="form-control" required maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción (opcional)</label>
                            <textarea class="form-control" rows="3" maxlength="200"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</body>
</html>