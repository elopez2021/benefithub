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
                        <h2 class="text-primary">
                        <?= $totalBusinesses ?>
                        </h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <h5>Restaurantes Afiliados</h5>
                        <h2 class="text-success"><?= $totalRestaurants ?></h2>
                    </div>
                </div>
            </div>

            <!-- Sección Empresas -->
            <div id="empresas" class="mb-5">
                <div class="d-flex justify-content-between mb-3">
                    <h4>Gestión de Empresas</h4>
                    <a href="<?= base_url('admin/business'); ?>" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Nueva Empresa
                    </a>
                </div>

                <!-- Tabla de Empresas -->
                <div class="table table-hover">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre Legal</th>
                                <th>RNC</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Subsidio Diario</th>
                                <th>Provincia</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($businesses as $business): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="mb-0"><?= esc($business['legal_name']) ?></h6>
                                                <small class="text-muted"><?= esc($business['email']) ?></small>
                                            </div> 
                                        </div>
                                    </td>
                                    <td><?= esc($business['rnc']) ?></td>
                                    <td><?= esc($business['email']) ?></td>
                                    <td><?= esc($business['phone']) ?></td>
                                    <td>RD$ <?= number_format($business['daily_subsidy'], 2) ?></td>
                                    <td><?= esc($business['province']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $business['status'] == 1 ? 'success' : 'danger' ?>">
                                            <?= $business['status'] == 1 ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                    
                                </tr>

                            <?php endforeach; ?>
                            

                        </tbody>
                    </table>
            </div>

            <!-- Sección Restaurantes -->
            <div id="restaurantes">
                <div class="d-flex justify-content-between mb-3">
                    <h4>Gestión de Restaurantes</h4>
                    <a href="<?= base_url('admin/restaurants'); ?>" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Nuevo Restaurante
                    </a>
                </div>

                <!-- Tabla de Restaurantes -->
                <table class="table table-hover">
                    <thead>
                        <tr>

                            <th>Nombre Comercial</th>
                                <th>RNC</th>
                                <th>Teléfono</th>
                                <th>Provincia</th>
                                <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($restaurants as $restaurant): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0"><?= esc($restaurant['commercial_name']) ?></h6>
                                            <small class="text-muted"><?= esc($restaurant['address']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><?= esc($restaurant['rnc']) ?></td>
                                <td>
                                    <i class="bi bi-telephone me-2"></i><?= esc($restaurant['phone']) ?>
                                </td>
                                <td><?= esc($restaurant['province']) ?></td>
                                <td>
                                    <span class="badge <?= $restaurant['active'] ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $restaurant['active'] ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </td>
                            
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

       
        
</body>
</html>