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
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Subsidio Diario</th>
                                <th>Provincia</th>
                                <th>Estado</th>
                                <th>Acciones</th>
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
                                    <td>
                                        <button class="btn btn-sm btn-warning me-2">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                            

                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <?= $pager->links() ?>
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
                <form id="registerBusinessForm">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre Legal</label>
                                <input type="text" class="form-control" name="legal_name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">RNC</label>
                                <input type="text" class="form-control" name="rnc" 
                                    pattern="\d{9}" 
                                    title="9 dígitos sin guiones" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" 
                                    class="form-control" 
                                    name="phone" 
                                    placeholder="Ej: 8095551234"
                                    pattern="(809|829|849)\d{7}" 
                                    title="Formato: 8095551234 (10 dígitos sin +1, guiones o espacios)"
                                    inputmode="numeric"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subsidio Semanal (DOP)</label>
                                <input type="number" class="form-control" name="daily_subsidy" 
                                    min="0" step="10" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Provincia</label>
                                <select class="form-select" name="province" required>
                                    <option value="">Seleccionar...</option>
                                    <option>Distrito Nacional</option>
                                    <option>Santo Domingo</option>
                                    <option>Santiago</option>
                                </select>
                            </div>

                            
                            
                            <div class="col-12">
                                <label class="form-label">Dirección Fiscal</label>
                                <textarea class="form-control" name="address" 
                                        placeholder="Ej: Av. 27 de Febrero #123, Santo Domingo D.N." 
                                        required></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="username" required autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="submitBusiness">
                            
                        <span id="buttonText">Registrar Empresa</span>

                        <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('#registerBusinessForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Get form elements
            const form = e.target;
            const submitButton = form.querySelector('button[type="submit"]');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            
            // Show loading state
            submitButton.disabled = true;
            buttonText.textContent = 'Procesando...';
            loadingSpinner.classList.remove('d-none');
            
            try {
                // Get all form data
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                const csrfToken = data['<?= csrf_token() ?>'];

                
                // 1. First register the user
                const userResponse = await axios.post('/api/user/register', {
                    username: data.username,
                    password: data.password,
                    role_id: 3
                }, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken  // CodeIgniter looks for this header
                    }
                });
                
                const userId = userResponse.data.user_id;
                const newCsrfToken = userResponse.data.new_csrf_token;
                
                // 2. Then create the business with the user_id
                const businessResponse = await axios.post('/api/businesses/create', {
                    legal_name: data.legal_name,
                    rnc: data.rnc,
                    phone: data.phone,
                    daily_subsidy: data.daily_subsidy,
                    province: data.province,
                    address: data.address,
                    user_id: userId  // Add the user_id to business record
                }
                , {
                    headers: {
                        'Content-Type': 'application/json',
                        //'X-CSRF-TOKEN': newCsrfToken  // CodeIgniter looks for this header
                    }
                });

                if(userResponse.data.status !== 'success' || businessResponse.data.status !== 'success') {
                    throw new Error(userResponse.data.message || businessResponse.data.message);
                }
                
                // Success handling
                alert('Empresa y usuario registrados exitosamente!');
                form.reset();
                            
            } catch (error) {
                console.error('Error:', error.response.data.error_details || error.response.data.message);
                console.error(error.response.data.error);
                console.error(error.response.data.data);
                let errorMessage = 'Ocurrió un error al registrar';
                
                if (error.response) {
                    errorMessage = error.response.data.message || errorMessage;
                }
                
                alert(errorMessage);
            } finally {
                // Reset button state
                submitButton.disabled = false;
                buttonText.textContent = 'Registrar Empresa';
                loadingSpinner.classList.add('d-none');
            }
        });
    </script>
</body>
</html>