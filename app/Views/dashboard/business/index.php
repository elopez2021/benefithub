<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empresas - Empleados</title>
</head>
<body>
    <div class="wrapper d-flex">
        <!-- Sidebar -->

        <?php include 'navbar.php'; ?>
        
        <!-- Contenido Principal -->
        <div class="main-content flex-grow-1">
            <!-- Sección Empleados -->
            <div id="empleados">
                <div class="d-flex justify-content-between mb-4">
                    <h3><i class="bi bi-people me-2"></i>Gestión de Empleados</h3>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoEmpleado">
                        <i class="bi bi-plus-circle me-2"></i>Añadir Empleado
                    </button>
                </div>

                <!-- Lista de Empleados -->
                <div class="row g-4">
                    <!-- Empleado Ejemplo -->
                    <div class="col-md-4">
                        <div class="card employee-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">Juan Pérez</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-link" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="editarEmpleado(1)">Editar</a></li>
                                            <li><a class="dropdown-item text-danger" href="#" onclick="eliminarEmpleado(1)">Eliminar</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="verDetallesEmpleado(1)">Ver Detalles</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-muted small">Cédula: 001-1234567-8</p>
                                <p class="text-muted small">Usuario: juan.perez</p>
                                <div class="mb-3">
                                    <span class="badge bg-primary">Crédito Disponible: RD$ 500.00</span>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge credit-badge">Consumido esta semana: RD$ 200.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Otro Empleado -->
                    <div class="col-md-4">
                        <div class="card employee-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">María López</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-link" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="editarEmpleado(2)">Editar</a></li>
                                            <li><a class="dropdown-item text-danger" href="#" onclick="eliminarEmpleado(2)">Eliminar</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="verDetallesEmpleado(2)">Ver Detalles</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-muted small">Cédula: 002-7654321-9</p>
                                <p class="text-muted small">Usuario: maria.lopez</p>
                                <div class="mb-3">
                                    <span class="badge bg-primary">Crédito Disponible: RD$ 300.00</span>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge credit-badge">Consumido esta semana: RD$ 150.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo Empleado -->
    <div class="modal fade" id="nuevoEmpleado">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Añadir Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEmpleado" onsubmit="guardarEmpleado(event)">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ID Empleado</label>
                            <input type="number" name="employee_id" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cédula de Identidad</label>
                            <input type="text" 
                            name="id_number" 
                            class="form-control" 
                            pattern="\d{11}" 
                            title="La cédula debe tener exactamente 11 dígitos (sin espacios ni guiones)"
                            required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <input type="text" name="username" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" autocomplete="new-password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Empleado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detalles del Empleado -->
    <div class="modal fade" id="detallesEmpleado">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles del Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> <span id="detalleNombre"></span></p>
                    <p><strong>Apellido:</strong> <span id="detalleApellido"></span></p>
                    <p><strong>Cédula:</strong> <span id="detalleCedula"></span></p>
                    <p><strong>Usuario:</strong> <span id="detalleUsuario"></span></p>
                    <p><strong>Crédito Disponible:</strong> <span id="detalleCreditoDisponible"></span></p>
                    <p><strong>Consumido esta semana:</strong> <span id="detalleConsumidoSemana"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    async function guardarEmpleado(event) {
        event.preventDefault();
        
        // Get form elements
        const form = document.getElementById('formEmpleado');
        if (!form) {
            console.error('Form not found');
            return;
        }
        
        const submitBtn = form.querySelector('button[type="submit"]');
        if (!submitBtn) {
            console.error('Submit button not found');
            return;
        }
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...';
        
        try {
            // Get form values using name attributes (more reliable)
            const formData = new FormData(form);
            const username = form.querySelector('[name="username"]')?.value;
            const password = form.querySelector('[name="password"]')?.value;
            const first_name = form.querySelector('[name="first_name"]')?.value;
            const last_name = form.querySelector('[name="last_name"]')?.value;
            const employee_id = form.querySelector('[name="employee_id"]')?.value;
            const id_number = form.querySelector('[name="id_number"]')?.value;

            // Validate required fields
            if (!username || !password || !first_name || !last_name || !employee_id || !id_number) {
                console.log('Validation failed:', { username, password, first_name, last_name, employee_id, id_number });
                throw new Error('Todos los campos son obligatorios');
                
            }

            // Prepare user data
            const userData = {
                username: username,
                password: password,
                role_id: 2
            };
            
            // 1. First create the user
            const userResponse = await axios.post('/api/user/register', userData);
            console.log('User response:', userResponse);
            
            if (userResponse.data?.status === 'success') {    
                const employeeData = {
                    user_id: userResponse.data.user_id,
                    first_name: first_name,
                    last_name: last_name,
                    employee_id: employee_id,
                    id_number: id_number
                };
                
                const employeeResponse = await axios.post('/api/employees/create', employeeData, {
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    responseType: 'json' 
                });
                
                
                    alert('Empleado guardado satisfactoriamente');
                    form.reset();
                    location.reload();
                
            } else {
                throw new Error(userResponse.data);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Ocurrió un error: ' + (error.response?.data?.message || error.message));
        } finally {
            // Re-enable button
            submitBtn.disabled = false;
            submitBtn.textContent = 'Guardar Empleado';
        }
    }
    </script>
    
</body>
</html>