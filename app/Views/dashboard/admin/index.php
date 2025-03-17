<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BenefitHub</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        <?php include 'navbar.php'; ?>

        <!-- Contenido Principal -->
        <div class="main-content flex-grow-1">
            <!-- Estadísticas -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <h5>Empresas Registradas</h5>
                        <h2 class="text-primary">248</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <h5>Restaurantes Afiliados</h5>
                        <h2 class="text-success">1,532</h2>
                    </div>
                </div>
            </div>

            <!-- Sección Empresas -->
            <div id="empresas" class="mb-5">
                <div class="d-flex justify-content-between mb-3">
                    <h4>Gestión de Empresas</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaEmpresa">
                        <i class="bi bi-plus-circle me-2"></i>Nueva Empresa
                    </button>
                </div>

                <!-- Tabla de Empresas -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Subsidio Mensual</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>TechSolutions MX</td>
                            <td>contacto@techsolutions.com</td>
                            <td>$150,000 DOP</td>
                            <td><span class="badge bg-success">Activa</span></td>
                            <td>
                                <button class="btn btn-sm btn-warning me-2">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Más filas... -->
                    </tbody>
                </table>
            </div>

            <!-- Sección Restaurantes -->
            <div id="restaurantes">
                <div class="d-flex justify-content-between mb-3">
                    <h4>Gestión de Restaurantes</h4>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoRestaurante">
                        <i class="bi bi-plus-circle me-2"></i>Nuevo Restaurante
                    </button>
                </div>

                <!-- Tabla de Restaurantes -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Descuento</th>
                            <th>Afiliación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>La Cantina Mexicana</td>
                            <td>Comida Mexicana</td>
                            <td>20%</td>
                            <td>2024-01-15</td>
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
        </div>
    </div>

    <!-- Sección Empresas -->
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
                                    <!-- Resto de provincias RD -->
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

    <!-- Sección Restaurantes -->
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
                                    <!-- Resto de provincias RD -->
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
        
</body>
</html>