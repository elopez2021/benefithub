<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empresas - Créditos</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            background: #2c3e50;
            min-height: 100vh;
            color: white;
            padding: 20px;
        }
        
        .main-content {
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        
        .credit-card {
            transition: all 0.3s;
            border: 1px solid #dee2e6;
        }
        
        .credit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .transaction-list {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .filter-section {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        
        <?php include 'navbar.php'; ?>

        <!-- Contenido Principal -->
        <div class="main-content flex-grow-1">
            <!-- Sección Créditos -->
            <div id="creditos">
                <h3><i class="bi bi-credit-card me-2"></i>Gestión de Créditos</h3>

                <!-- Resumen de Créditos -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card credit-card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Crédito Total Disponible</h5>
                                <p class="display-6">RD$ 10,000.00</p>
                                <p class="text-muted small">Crédito asignado a todos los empleados.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card credit-card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Crédito Consumido</h5>
                                <p class="display-6">RD$ 4,500.00</p>
                                <p class="text-muted small">Total consumido por los empleados.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card credit-card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Crédito Restante</h5>
                                <p class="display-6">RD$ 5,500.00</p>
                                <p class="text-muted small">Crédito disponible para uso.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filtros para Historial de Transacciones -->
                <div class="filter-section">
                    <h5>Filtrar Historial de Transacciones</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Filtrar por Fecha</label>
                            <select class="form-select" id="filtroFecha">
                                <option value="todos">Todos</option>
                                <option value="semana">Última Semana</option>
                                <option value="mes">Último Mes</option>
                                <option value="año">Último Año</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Filtrar por Empleado</label>
                            <select class="form-select" id="filtroEmpleado">
                                <option value="todos">Todos</option>
                                <option value="1">Juan Pérez</option>
                                <option value="2">María López</option>
                                <option value="3">Carlos Rodríguez</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary mt-4" onclick="filtrarTransacciones()">
                                <i class="bi bi-funnel me-2"></i>Aplicar Filtros
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Historial de Transacciones -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Historial de Transacciones</h5>
                        <div class="transaction-list">
                            <table class="table" id="tablaTransacciones">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Empleado</th>
                                        <th>Monto</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Transacciones cargadas dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Filtros para Crédito por Empleado -->
                <div class="filter-section">
                    <h5>Filtrar Crédito por Empleado</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Filtrar por Empleado</label>
                            <select class="form-select" id="filtroEmpleadoCredito">
                                <option value="todos">Todos</option>
                                <option value="1">Juan Pérez</option>
                                <option value="2">María López</option>
                                <option value="3">Carlos Rodríguez</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary mt-4" onclick="filtrarCreditoEmpleado()">
                                <i class="bi bi-funnel me-2"></i>Aplicar Filtros
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Resumen por Empleado -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Crédito por Empleado</h5>
                        <div class="transaction-list">
                            <table class="table" id="tablaCreditoEmpleado">
                                <thead>
                                    <tr>
                                        <th>Empleado</th>
                                        <th>Crédito Disponible</th>
                                        <th>Crédito Consumido</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Datos cargados dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>