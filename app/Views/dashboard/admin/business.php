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
                                       
                                        <button class="btn btn-sm btn-warning me-2 edit-business-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editBusiness"
                                                data-business-id="<?= $business['id'] ?>"
                                                data-legal-name="<?= htmlspecialchars($business['legal_name']) ?>"
                                                data-rnc="<?= htmlspecialchars($business['rnc']) ?>"
                                                data-phone="<?= htmlspecialchars($business['phone']) ?>"
                                                data-subsidy="<?= htmlspecialchars($business['daily_subsidy']) ?>"
                                                data-province="<?= htmlspecialchars($business['province']) ?>"
                                                data-address="<?= htmlspecialchars($business['address']) ?>"
                                                data-username="<?= htmlspecialchars($business['username']) ?>"
                                                data-email="<?= htmlspecialchars($business['email']) ?>">
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
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" required>
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
                                    min="0" step="1" required>
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

    <!-- Modal Editar Empresa -->
    <div class="modal fade" id="editBusiness">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Empresa</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editBusinessForm" method="PUT">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                    <input type="hidden" name="business_id">

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
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" required>
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
                                    min="0" step="1" required>
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
                        <button type="submit" class="btn btn-primary" id="editBusinessSubmit">
                            
                        <span id="buttonText">Editar Empresa</span>

                        <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        document.getElementById('editBusiness').addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const isEdit = button.classList.contains('edit-business-btn');
            
            const form = this.querySelector('form');
            const modalTitle = this.querySelector('.modal-title');
            const submitText = this.querySelector('#buttonText');
            
            if (isEdit) {
                // Edit mode - populate fields
                modalTitle.textContent = 'Editar Empresa';
                submitText.textContent = 'Guardar Cambios';
                
                form.querySelector('input[name="business_id"]').value = button.getAttribute('data-business-id');
                form.querySelector('input[name="legal_name"]').value = button.getAttribute('data-legal-name');
                form.querySelector('input[name="rnc"]').value = button.getAttribute('data-rnc');
                form.querySelector('input[name="phone"]').value = button.getAttribute('data-phone');
                form.querySelector('input[name="daily_subsidy"]').value = button.getAttribute('data-subsidy');
                form.querySelector('select[name="province"]').value = button.getAttribute('data-province');
                form.querySelector('textarea[name="address"]').value = button.getAttribute('data-address');
                form.querySelector('input[name="username"]').value = button.getAttribute('data-username');
                form.querySelector('input[name="email"]').value = button.getAttribute('data-email');
                
                // Clear password field for edits
                form.querySelector('input[name="password"]').value = '';
                form.querySelector('input[name="password"]').removeAttribute('required');
            } else {
                // Create mode - reset form
                form.reset();
                form.querySelector('input[name="password"]').setAttribute('required', '');
            }
        });


        


        document.getElementById('editBusinessForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            const businessId = formData.get('business_id');
            const isEdit = !!businessId;
            
            // Get CSRF token
            const csrfToken = document.querySelector('input[name="<?= csrf_token() ?>"]').value;
            
            // Show loading state
            const submitBtn = form.querySelector('#editBusinessSubmit');
            submitBtn.disabled = true;
            submitBtn.querySelector('#buttonText').textContent = 'Guardando...';
            submitBtn.querySelector('#loadingSpinner').classList.remove('d-none');
            
            // Prepare the request
            const requestConfig = {
                method: isEdit ? 'PUT' : 'POST',
                url: isEdit ? `/api/businesses/${businessId}` : '/api/businesses',
                headers: {
                      'Content-Type': 'application/json'
                },
                data: Object.fromEntries(formData)
            };
            
            // Remove null/empty values (optional)
            requestConfig.data = Object.fromEntries(
                Object.entries(requestConfig.data).filter(([_, v]) => v != null && v !== '')
            );
            
            // Execute the request
            axios(requestConfig)
                .then(response => {
                    // Hide modal on success
                    bootstrap.Modal.getInstance(form.closest('.modal')).hide();
                    
                    // Show success message
                    alert('Empresa actualizada exitosamente!');
                    window.location.reload();
                    
                    // Refresh business data or update specific row

                    /*
                    if (isEdit) {
                        
                    } else {
                        addNewBusinessRow(response.data.business);
                    }
                        */
                                        
                    // Update CSRF token if returned
                    
                })
                .catch(error => {
                    console.error('Error:', error.response.data.errors);
                    
                    // Handle validation errors
                    alert('Error: ' + (error.response.data.message || 'Ocurrió un error'));
                })
                .finally(() => {
                    // Reset button state
                    submitBtn.disabled = false;
                    submitBtn.querySelector('#buttonText').textContent = 
                        isEdit ? 'Guardar Cambios' : 'Registrar Empresa';
                    submitBtn.querySelector('#loadingSpinner').classList.add('d-none');
                });
        });

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
                    email: data.email,
                    password: form.querySelector('[name="password"]').value || undefined,
                    user_id: userId  // Add the user_id to business record
                }
                , {
                    headers: {
                        'Content-Type': 'application/json',
                        //'X-CSRF-TOKEN': newCsrfToken  // CodeIgniter looks for this header
                    }
                });

                
                
                // Success handling
                alert('Empresa y usuario registrados exitosamente!');
                form.reset();
                windows.location.reload();
                            
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