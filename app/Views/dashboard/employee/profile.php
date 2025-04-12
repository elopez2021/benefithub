<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - BenefitHub</title>
    
    <style>
        .profile-section {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .avatar {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 3px solid #0d6efd;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>
</head>
<body>
    <!-- Menú Principal -->
    <?php include 'navbar.php'; ?>

    <!-- Contenido Principal -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Encabezado -->
                <div class="text-center mb-5">
                    <svg class="avatar mb-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                      </svg>
                    <h2 class="fw-bold">Mi Perfil</h2>
                    <p class="text-muted">Actualiza tu información personal y de seguridad</p>
                </div>

                <!-- Sección Información Personal -->
                <div class="profile-section mb-4">
                    <h4 class="mb-4">
                        <i class="bi bi-person-badge me-2"></i>Información Personal
                    </h4>
                    
                    <form id="update-profile-form">

                        
                        
                        <div class="mb-3">
                            <label class="form-label">Primer Nombre</label>
                            <input type="text" name="first_name"
                                   class="form-control" 
                                   value="<?= $employee['first_name'] ?>" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="last_name"
                                   class="form-control" 
                                   value="<?= $employee['last_name'] ?>" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <input type="text" name="username"
                                   class="form-control" 
                                   value="<?= $username ?>" 
                                   required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Guardar cambios
                        </button>
                    </form>
                </div>

                <!-- Sección Cambio de Contraseña -->
                <div class="profile-section mb-4">
                    <h4 class="mb-4">
                        <i class="bi bi-shield-lock me-2"></i>Seguridad
                    </h4>
                    
                    <form id="change-password-form">
                        <div class="mb-3">
                            <label class="form-label">Contraseña actual</label>
                            <input type="password" name="current_password"
                            id="current_password"
                                   class="form-control" 
                                   placeholder="••••••••" 
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nueva contraseña</label>
                            <input type="password" name="new_password"
                            id="new_password"
                                   class="form-control" 
                                   placeholder="••••••••" 
                                   
                                   required>
                            
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Confirmar nueva contraseña</label>
                            <input type="password" name="confirm_new_password"
                                id ="confirm_new_password"
                                   class="form-control" 
                                   placeholder="••••••••" 
                                   required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-key me-2"></i>Cambiar contraseña
                        </button>
                    </form>
                </div>

                
            </div>
        </div>
    </div>

    <script>
        document.getElementById('update-profile-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            

            // Send AJAX request (using axios)
            axios.put('/api/employee/profile/update', formData, {
                headers: {
                    'Content-Type': 'application/json'
                }
                })
                .then(response => {
                    alert('Información actualizada con éxito');
                })
                .catch(error => {
                    console.error('Error updating profile:', error);
                    alert(error.response.data.message);
    
                });
        });

        document.getElementById('change-password-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const currentPassword = document.getElementById('current_password').value;
            const newPassword = document.getElementById('new_password').value;
            const confirmNewPassword = document.getElementById('confirm_new_password').value;

            // Password validation
            if (newPassword !== confirmNewPassword) {
                alert('Las contraseñas no coinciden');
                return;
            }

            const data = {
                current_password: currentPassword,
                new_password: newPassword,
            };

            // Send AJAX request (using axios)
            axios.put('/api/employee/profile/change-password', data, {
                headers: {
                    'Content-Type': 'application/json'
                }
                })
                .then(response => {
                    alert('Contraseña cambiada con éxito');
                })
                .catch(error => {
                    console.error('Error changing password:', error);
                    alert(error.response.data.message);
                });
        });

    </script>

</body>
</html>