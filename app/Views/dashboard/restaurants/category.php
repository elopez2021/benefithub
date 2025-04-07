<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Restaurante - Categorías</title>
   
</head>
<body>
    <div class="wrapper d-flex">
    <?php include 'navbar.php'; ?>

        <!-- Contenido Principal -->
        <div class="main-content flex-grow-1">
            <!-- Sección Categorías -->
            <div id="categorias">
                <div class="d-flex justify-content-between mb-4">
                    <h3><i class="bi bi-tags me-2"></i>Gestión de Categorías</h3>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaCategoria">
                        <i class="bi bi-plus-circle me-2"></i>Nueva Categoría
                    </button>
                </div>

                <!-- Lista de Categorías -->
                <div class="row g-4">
                    <!-- Categoría Ejemplo -->
                    <div class="row">
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <div class="col-md-4">
                                    <div class="card category-card h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title mb-0"><?= esc($category['name']) ?></h5>
                                                <div class="dropdown">
                                                    <button class="btn btn-link" data-bs-toggle="dropdown">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="editarCategoria(<?= esc($category['id']) ?>)">Editar</a></li>
                                                        <li><a class="dropdown-item text-danger" href="#" onclick="eliminarCategoria(<?= esc($category['id']) ?>)">Eliminar</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="text-muted small"><?= esc($category['description']) ?></p>
                                            
                                            <!-- Display Schedule -->
                                            <?php if (!empty($category['schedules'])): ?>
                                                <?php
                                                    $days = array_map(fn($s) => esc($s['day_of_week']), $category['schedules']);
                                                    $startTime = date('g:i A', strtotime($category['schedules'][0]['start_time']));
                                                    $endTime = date('g:i A', strtotime($category['schedules'][0]['end_time']));
                                                ?>
                                                <div class="mb-2">
                                                    <span class="badge bg-primary">
                                                        <?= implode(', ', $days) ?><br>
                                                        <?= $startTime ?> - <?= $endTime ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>


                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No se encontraron categorías.</p>
                        <?php endif; ?>
                    </div>

                
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nueva Categoría -->
    <div class="modal fade" id="nuevaCategoria">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formCategoria" onsubmit="guardarCategoria(event)">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre de la Categoría</label>
                            <input type="text" class="form-control" name="name" required maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción (opcional)</label>
                            <textarea class="form-control" rows="3" name="description" maxlength="200"></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="mb-2">
                                <label for="start_time" class="form-label">Hora de inicio</label>
                                <input type="time" class="form-control" id="start_time" name="start_time" required>
                            </div>

                            <div class="mb-2">
                                <label for="end_time" class="form-label">Hora de fin</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Días de la semana</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Lunes" id="monday">
                                <label class="form-check-label" for="monday">Lunes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Martes" id="tuesday">
                                <label class="form-check-label" for="tuesday">Martes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Miercoles" id="wednesday">
                                <label class="form-check-label" for="wednesday">Miércoles</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Jueves" id="thursday">
                                <label class="form-check-label" for="thursday">Jueves</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Viernes" id="friday">
                                <label class="form-check-label" for="friday">Viernes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Sabado" id="saturday">
                                <label class="form-check-label" for="saturday">Sábado</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="days[]" value="Domingo" id="sunday">
                                <label class="form-check-label" for="sunday">Domingo</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function guardarCategoria(event) {
            event.preventDefault();

            const form = document.getElementById('formCategoria');
            const formData = new FormData(form);

            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;

            if (!startTime || !endTime) {
                alert('Ambas horas son obligatorias.');
                return;
            }

            if (endTime <= startTime) {
                alert('La hora de fin debe ser posterior a la hora de inicio.');
                return;
            }
            
            axios.post('<?= route_to('api/category/create'); ?>', formData, {
            headers: {
                'Content-Type': 'application/json', // Set the Content-Type to JSON
            }
            })
                .then(response => {
                    alert('Categoría guardada correctamente');
                    location.reload(); // o actualiza la tabla/lista dinámicamente
                })
                .catch(error => {
                    console.error(error);
                    alert('Error al guardar la categoría');
                    console.error(error.response.data.errors); // Log the error response for debugging
                });
        }
    </script>

</body>
</html>