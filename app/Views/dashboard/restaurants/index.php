<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Restaurante - Productos</title>
    
    
</head>
<body>
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        
        <?php include 'navbar.php'; ?>
        

        <!-- Contenido Principal -->
        <div class="main-content flex-grow-1">
            <!-- Sección Productos -->
            <div id="productos">
                <div class="d-flex justify-content-between mb-4">
                    <h3><i class="bi bi-egg-fried me-2"></i>Gestión de Productos</h3>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoProducto">
                        <i class="bi bi-plus-circle me-2"></i>Nuevo Producto
                    </button>
                </div>

                <!-- Lista de Productos -->
                <div class="row g-4">
                    <?php if (empty($productos)): ?>
                            <div class="col-12">
                                <div class="alert alert-info" role="alert">
                                    No hay productos disponibles en este momento.
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($productos as $producto): ?>
                                <div class="col-md-4">
                                    <div class="card product-card h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title mb-0"><?= esc($producto['name']) ?></h5>
                                                <div class="dropdown">
                                                    <button class="btn btn-link" data-bs-toggle="dropdown">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="editarProducto(<?= esc($producto['id']) ?>)">Editar</a></li>
                                                        <li><a class="dropdown-item text-danger" href="#" onclick="eliminarProducto(<?= esc($producto['id']) ?>)">Eliminar</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="text-muted small"><?= esc($producto['description']) ?></p>
                                            <div class="mb-3">
                                                <?php if (!empty($producto['category_name'])): ?>
                                                    <span class="badge bg-primary"><?= esc($producto['category_name']) ?></span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <span class="fw-bold">RD$ <?= number_format($producto['price'], 2) ?></span>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" <?= $producto['active'] ? 'checked' : '' ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo Producto -->
    <div class="modal fade" id="nuevoProducto">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formProducto" onsubmit="guardarProducto(event)">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            
                        

                            <div class="col-12">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" rows="3" maxlength="200" name="descripcion"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Precio (DOP)</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Categorias Disponibles</label>
                                <div class="border p-3" style="max-height: 200px; overflow-y: auto;">
                                    <?php if (!empty($categories)): ?>
                                   
                                    <?php foreach ($categories as $category): ?>
                                    <div class="form-check">
                                        <input class="form-check-input category-checkbox" name="categories[]" type="checkbox" value="<?= esc($category['id']) ?>">
                                        <label class="form-check-label"><?= esc($category['name']) ?></label>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>No se encontraron categorías.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function guardarProducto(event) {
            event.preventDefault(); // Prevent default form submission

            const form = document.getElementById('formProducto');
            const formData = new FormData(form);

            // Check that at least one category is selected
            const selectedCategories = formData.getAll('categories[]');
            if (selectedCategories.length === 0) {
                alert('Por favor, selecciona al menos una categoría.');
                return;
            }

            // Manually build the object
            const data = {
                name: formData.get('name'),
                descripcion: formData.get('descripcion'),
                price: formData.get('price'),
                categories: selectedCategories
            };
            // Send the data to the server using Axios
            axios.post('<?= route_to('api/product/create'); ?>', data, {
            headers: {
                'Content-Type': 'application/json', // Set the Content-Type to JSON
            }
            })
                .then(response => {
                    // Handle the response from the server
                    if (response.data.success) {
                        alert('Producto guardado exitosamente');
                        console.log(response.data.data);
                        // Optionally, reset the form or update UI after saving
                        document.getElementById('formProducto').reset();
                        //location.reload();
                    } else {
                        alert('Hubo un error al guardar el producto');
                        console.log(response.data);
                    }
                    
                })
                .catch(error => {
                    console.error(error);
                    console.error(error.response.data.errors);
                    alert('Ocurrió un error al guardar el producto. Por favor, inténtelo de nuevo.');
                });
        }

    </script>
    
</body>
</html>