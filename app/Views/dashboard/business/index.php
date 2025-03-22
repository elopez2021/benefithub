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
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cédula de Identidad</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" required>
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

    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script>
        // Datos de ejemplo (simulados)
        const empleados = [
            {
                id: 1,
                nombre: "Juan",
                apellido: "Pérez",
                cedula: "001-1234567-8",
                usuario: "juan.perez",
                creditoDisponible: 500,
                consumidoSemana: 200
            },
            {
                id: 2,
                nombre: "María",
                apellido: "López",
                cedula: "002-7654321-9",
                usuario: "maria.lopez",
                creditoDisponible: 300,
                consumidoSemana: 150
            }
        ];

        // Función para guardar nuevo empleado
        async function guardarEmpleado(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            
            try {
                const nuevoEmpleado = {
                    id: empleados.length + 1,
                    nombre: formData.get('nombre'),
                    apellido: formData.get('apellido'),
                    cedula: formData.get('cedula'),
                    usuario: formData.get('usuario'),
                    creditoDisponible: 1000, // Crédito máximo
                    consumidoSemana: 0
                };

                empleados.push(nuevoEmpleado);
                alert('Empleado añadido correctamente');
                location.reload();

            } catch (error) {
                alert('Error: ' + error.message);
            }
        }

        // Función para ver detalles del empleado
        function verDetallesEmpleado(id) {
            const empleado = empleados.find(e => e.id === id);
            if (empleado) {
                document.getElementById('detalleNombre').textContent = empleado.nombre;
                document.getElementById('detalleApellido').textContent = empleado.apellido;
                document.getElementById('detalleCedula').textContent = empleado.cedula;
                document.getElementById('detalleUsuario').textContent = empleado.usuario;
                document.getElementById('detalleCreditoDisponible').textContent = `RD$ ${empleado.creditoDisponible.toFixed(2)}`;
                document.getElementById('detalleConsumidoSemana').textContent = `RD$ ${empleado.consumidoSemana.toFixed(2)}`;
                new bootstrap.Modal(document.getElementById('detallesEmpleado')).show();
            }
        }

        // Funciones para editar y eliminar (simuladas)
        function editarEmpleado(id) {
            alert(`Editar empleado con ID: ${id}`);
        }

        function eliminarEmpleado(id) {
            if (confirm('¿Estás seguro de eliminar este empleado?')) {
                alert(`Empleado con ID: ${id} eliminado`);
            }
        }
    </script>
</body>
</html>