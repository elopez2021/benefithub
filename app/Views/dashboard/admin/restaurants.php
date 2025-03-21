<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Restaurantes</title>
    
</head>
<body>
    <div class="wrapper d-flex">
    <!-- Sidebar -->
    <?php include 'navbar.php'; ?>

        <!-- Contenido Principal -->
        <div class="main-content flex-grow-1">
            <!-- Sección Restaurantes -->
            <div id="restaurantes" class="mb-5">
                <div class="d-flex justify-content-between mb-4">
                    <h4 class="mb-0"><i class="bi bi-shop me-2"></i>Gestión de Restaurantes Afiliados</h4>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoRestaurante">
                        <i class="bi bi-plus-circle me-2"></i>Nuevo Restaurante
                    </button>
                </div>

                <!-- Filtros y Búsqueda -->
                <div class="row mb-4 g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Buscar por nombre...">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Todas las provincias</option>
                            <option>Distrito Nacional</option>
                            <option>Santo Domingo</option>
                            <option>Santiago</option>
                            <option>La Altagracia</option>
                            <!-- Otras provincias -->
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Todos los estados</option>
                            <option>Activo</option>
                            <option>Inactivo</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-secondary w-100">
                            <i class="bi bi-funnel"></i> Filtrar
                        </button>
                    </div>
                </div>

                <!-- Tabla de Restaurantes -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre Comercial</th>
                                <th>Tipo de Cocina</th>
                                <th>Teléfono</th>
                                <th>Provincia</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Restaurante 1 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" 
                                             class="rounded-circle me-3" 
                                             alt="Logo"
                                             style="width: 50px; height: 50px;">
                                        <div>
                                            <h6 class="mb-0">El Sazón Criollo</h6>
                                            <small class="text-muted">Santo Domingo Este</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Criolla Dominicana</td>
                                <td>
                                    <i class="bi bi-telephone me-2"></i>+1-809-555-1234
                                </td>
                                <td>Santo Domingo Este</td>
                                <td>
                                    <span class="badge bg-success">Activo</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-2">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Restaurante 2 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" 
                                             class="rounded-circle me-3" 
                                             alt="Logo"
                                             style="width: 50px; height: 50px;">
                                        <div>
                                            <h6 class="mb-0">Mariscos Caribeños</h6>
                                            <small class="text-muted">La Romana</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Mariscos</td>
                                <td>
                                    <i class="bi bi-telephone me-2"></i>+1-809-555-5678
                                </td>
                                <td>La Romana</td>
                                <td>
                                    <span class="badge bg-warning text-dark">En revisión</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-2">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Más restaurantes... -->
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
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

    <!-- Modal Nuevo Restaurante -->
    <div class="modal fade" id="nuevoRestaurante">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Afiliar Nuevo Restaurante</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre Comercial</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tipo de Cocina</label>
                                <select class="form-select" required>
                                    <option value="">Seleccionar...</option>
                                    <option>Criolla Dominicana</option>
                                    <option>Mariscos</option>
                                    <option>Internacional</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" 
                                       pattern="\+1-(809|829|849)\d{3}-\d{4}" 
                                       required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Provincia</label>
                                <select class="form-select" required>
                                    <option value="">Seleccionar...</option>
                                    <option>Distrito Nacional</option>
                                    <option>Santo Domingo Este</option>
                                    <option>La Altagracia</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Dirección Completa</label>
                                <input type="text" class="form-control" 
                                       placeholder="Ej: Calle El Conde #45, Zona Colonial, D.N." 
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Afiliar Restaurante</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>