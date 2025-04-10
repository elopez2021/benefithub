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
                    
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" 
                                   class="form-control" 
                                   value="Juan Pérez" 
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" 
                                   class="form-control" 
                                   value="juan.perez@empresa.com" 
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
                    
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Contraseña actual</label>
                            <input type="password" 
                                   class="form-control" 
                                   placeholder="••••••••" 
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nueva contraseña</label>
                            <input type="password" 
                                   class="form-control" 
                                   placeholder="••••••••" 
                                   minlength="8"
                                   required>
                            <small class="form-text text-muted">Mínimo 8 caracteres</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Confirmar nueva contraseña</label>
                            <input type="password" 
                                   class="form-control" 
                                   placeholder="••••••••" 
                                   required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-key me-2"></i>Cambiar contraseña
                        </button>
                    </form>
                </div>

                <!-- Sección Eliminar Cuenta -->
                <div class="profile-section border border-danger">
                    <h4 class="text-danger mb-4">
                        <i class="bi bi-exclamation-triangle me-2"></i>Zona Peligrosa
                    </h4>
                    
                    <div class="alert alert-danger">
                        <h5>Eliminar cuenta permanentemente</h5>
                        <p class="mb-2">Esta acción no se puede deshacer. Todos tus datos serán eliminados.</p>
                        <button class="btn btn-outline-danger">
                            <i class="bi bi-trash3 me-2"></i>Eliminar mi cuenta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>