<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Empresas</title>
    
</head>
<body>
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        <?php include 'navbar.php'; ?>

        <!-- Contenido Principal -->
        <div class="main-content flex-grow-1">
            <!-- Sección Empresas -->
            <div id="empresas" class="mb-5">
                <div class="d-flex justify-content-between mb-4">
                    <h4 class="mb-0"><i class="bi bi-building me-2"></i>Gestión de Empresas</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaEmpresa">
                        <i class="bi bi-plus-circle me-2"></i>Nueva Empresa
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

                <!-- Tabla de Empresas -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre Legal</th>
                                <th>RNC</th>
                                <th>Subsidio Diario</th>
                                <th>Credito Semanal Disponible</th>
                                <th>Provincia</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Empresa 1 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" 
                                             class="rounded-circle me-3" 
                                             alt="Logo"
                                             style="width: 50px; height: 50px;">
                                        <div>
                                            <h6 class="mb-0">TechSolutions MX</h6>
                                            <small class="text-muted">contacto@techsolutions.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>123456789</td>
                                <td>RD$ 150,000</td>
                                <td>RD$ 200,000</td>
                                <td>Distrito Nacional</td>
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

                            <!-- Empresa 2 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" 
                                             class="rounded-circle me-3" 
                                             alt="Logo"
                                             style="width: 50px; height: 50px;">
                                        <div>
                                            <h6 class="mb-0">AgroDominicana</h6>
                                            <small class="text-muted">info@agrodominicana.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>987654321</td>
                                <td>RD$ 200,000</td>
                                <td>RD$ 200,000</td>
                                <td>Santiago</td>
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

    <!-- Modal Nueva Empresa -->
    <div class="modal fade" id="nuevaEmpresa">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nueva Empresa</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre Legal</label>
                                <input type="text" class="form-control" name="nombre_legal" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">RNC</label>
                                <input type="text" class="form-control" name="rnc" 
                                       pattern="\d{9}" 
                                       title="9 dígitos sin guiones" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" name="telefono" 
                                       placeholder="Ej: +1-809-555-5555" 
                                       pattern="\+1-(809|829|849)\d{3}-\d{4}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subsidio Mensual (DOP)</label>
                                <input type="number" class="form-control" name="subsidio" 
                                       min="5000" step="500" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Provincia</label>
                                <select class="form-select" name="provincia" required>
                                    <option value="">Seleccionar...</option>
                                    <option>Distrito Nacional</option>
                                    <option>Santo Domingo</option>
                                    <option>Santiago</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Dirección Fiscal</label>
                                <textarea class="form-control" name="direccion" 
                                          placeholder="Ej: Av. 27 de Febrero #123, Santo Domingo D.N." 
                                          required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Registrar Empresa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>