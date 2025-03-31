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
                                    <option value="">Seleccionar...</option>
                                    <option>Distrito Nacional</option>
                                    <option>Santo Domingo</option>
                                    <option>Santiago</option>
                
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
                                <th>RNC</th>
                                <th>Teléfono</th>
                                <th>Provincia</th>
                                <th>Estado</th>
                                <th>Acciones</th>
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
                                <td>


                                <button class="btn btn-sm btn-warning me-2" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editarRestauranteModal"
                                        data-restaurant-id="<?= $restaurant['id'] ?>"
                                        data-commercial-name="<?= htmlspecialchars($restaurant['commercial_name']) ?>"
                                        data-rnc="<?= htmlspecialchars($restaurant['rnc']) ?>"
                                        data-phone="<?= htmlspecialchars($restaurant['phone']) ?>"
                                        data-province="<?= htmlspecialchars($restaurant['province']) ?>"
                                        data-address="<?= htmlspecialchars($restaurant['address']) ?>"
                                        data-username="<?= htmlspecialchars($restaurant['username']) ?>">
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

    <!-- Modal Nuevo Restaurante -->
    <div class="modal fade" id="nuevoRestaurante">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Afiliar Nuevo Restaurante</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addRestaurantForm">
                    
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre Comercial</label>
                                <input type="text" class="form-control" name="commercial_name" required>
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
                                <label class="form-label">Provincia</label>
                                <select class="form-select" name="province" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Distrito Nacional">Distrito Nacional</option>
                                    <option value="Santo Domingo">Santo Domingo</option>
                                    <option value="Santiago">Santiago</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">RNC</label>
                                <input type="text" class="form-control" name="rnc" 
                                    pattern="\d{9}" 
                                    title="9 dígitos sin guiones" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Dirección Completa</label>
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
                        <button type="submit" class="btn btn-success">Afiliar Restaurante</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Editar Restaurante Modal-->
    <div class="modal fade" id="editarRestauranteModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Restaurante</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editRestaurantForm">
                    <input type="hidden" name="restaurant_id">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre Comercial</label>
                                <input type="text" class="form-control" name="commercial_name" required>
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
                                <label class="form-label">Provincia</label>
                                <select class="form-select" name="province" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Distrito Nacional">Distrito Nacional</option>
                                    <option value="Santo Domingo">Santo Domingo</option>
                                    <option value="Santiago">Santiago</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">RNC</label>
                                <input type="text" class="form-control" name="rnc" 
                                    pattern="\d{9}" 
                                    title="9 dígitos sin guiones" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label">Dirección Completa</label>
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
                        <button type="submit" class="btn btn-success">Editar Restaurante</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        document.getElementById('editarRestauranteModal').addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const form = this.querySelector('form');
            
            // Populate form fields
            form.querySelector('input[name="restaurant_id"]').value = button.getAttribute('data-restaurant-id');
            form.querySelector('input[name="commercial_name"]').value = button.getAttribute('data-commercial-name');
            form.querySelector('input[name="rnc"]').value = button.getAttribute('data-rnc');
            form.querySelector('input[name="phone"]').value = button.getAttribute('data-phone');
            form.querySelector('select[name="province"]').value = button.getAttribute('data-province');
            form.querySelector('textarea[name="address"]').value = button.getAttribute('data-address');
            form.querySelector('input[name="username"]').value = button.getAttribute('data-username');
            
            // Handle password field
            const passwordField = form.querySelector('input[name="password"]');
            if (passwordField) {
                passwordField.value = '';
                passwordField.removeAttribute('required');
            }

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Get form data
                const formData = {
                    restaurant_id: form.querySelector('[name="restaurant_id"]').value,
                    commercial_name: form.querySelector('[name="commercial_name"]').value,
                    rnc: form.querySelector('[name="rnc"]').value,
                    phone: form.querySelector('[name="phone"]').value,
                    province: form.querySelector('[name="province"]').value,
                    address: form.querySelector('[name="address"]').value,
                    username: form.querySelector('[name="username"]').value,
                    password: form.querySelector('[name="password"]').value || undefined
                };

                try {
                    // Show loading state
                    const submitBtn = form.querySelector('button[type="submit"]');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Actualizando...';

                    // Send update request
                    const response = await axios.put(`/api/restaurants/${formData.restaurant_id}`, formData);

                    // Show success message
                    alert('Restaurante actualizado exitosamente!');
                    window.location.reload();

                } catch (error) {
                    console.error('Error:', error.response.data.error);
                    console.error('Data sent:', error.response.data.data);
                    
                    // Show error message
                    let errorMessage = 'Error al actualizar el restaurante';
                    if (error.response?.data?.errors) {
                        errorMessage = Object.values(error.response.data.errors).join('<br>');
                    } else if (error.response?.data?.message) {
                        errorMessage = error.response.data.message;
                    }

                    alert(errorMessage);
                } finally {
                    // Reset button state
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Guardar Cambios';
                    }
                }
            });
        });


        document.querySelector('#addRestaurantForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = {
                username: this.querySelector('[name="username"]').value,
                password: this.querySelector('[name="password"]').value,
                commercial_name: this.querySelector('[name="commercial_name"]').value,
                phone: this.querySelector('[name="phone"]').value,
                rnc: this.querySelector('[name="rnc"]').value,
                province: this.querySelector('[name="province"]').value,
                address: this.querySelector('[name="address"]').value
            };

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...';

            try {
                

                // 1. First create the user
                const userResponse = await axios.post('/api/user/register', {
                    username: formData.username,
                    password: formData.password,
                    role_id: 4
                });

                // 2. Then create the restaurant with the user_id
                const restaurantResponse = await axios.post('/api/restaurants/create', {
                    user_id: userResponse.data.user_id,
                    commercial_name: formData.commercial_name,
                    rnc: formData.rnc,
                    phone: formData.phone,
                    address: formData.address,
                    province: formData.province,
                });

                // Show success message
                alert('Restaurante afiliado exitosamente!');
                window.location.reload();


            } catch (error) {
                console.error('Error:', error.response.data.error);
                console.error('Data sent:', error.response.data.data);
                
                // Show error message
                let errorMessage = 'Ocurrió un error al procesar la solicitud';
                if (error.response) {
                    if (error.response.data.errors) {
                        errorMessage = Object.values(error.response.data.errors).join('<br>');
                    } else if (error.response.data.message) {
                        errorMessage = error.response.data.message;
                    }
                }

                alert(errorMessage);

            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.textContent = 'Afiliar Restaurante';
            }
        });
    </script>

</body>
</html>