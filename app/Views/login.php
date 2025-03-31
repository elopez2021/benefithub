<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BenefitHub - Subsidios Alimentarios</title>    
</head>
<body>

<!-- Navbar -->
<?php include 'navbar.php'; ?>

<!-- Login -->

<section class="vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Formulario de inicio de sesión -->
                        <div id="login-form">
                            <h2 class="text-center mb-4">Iniciar Sesión</h2>
                            <form id="loginForm">

                            <div id="errorAlert" class="alert alert-danger d-none" role="alert">
                                <!-- Error message will be inserted here -->
                            </div>
                            
                                <input type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Recuérdame</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" id="submitButton">
                                    <span id="buttonText">Ingresar</span>
                                    <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                            </form>
                            <div class="text-center mt-3">
                                <a href="#" onclick="toggleForms(event)">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>

                        <!-- Formulario de recuperación de contraseña -->
                        <div id="reset-form" style="display: none;">
                            <h2 class="text-center mb-4">Recuperar Contraseña</h2>
                            <p class="text-center text-muted">Ingresa tu correo electrónico y te enviaremos instrucciones para restablecer tu contraseña.</p>
                            <form>
                                <div class="mb-3">
                                    <label for="reset-email" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="reset-email" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Enviar Instrucciones</button>
                            </form>
                            <div class="text-center mt-3">
                                <a href="#" onclick="toggleForms(event)">Volver al inicio de sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Footer -->

<footer class="bg-dark text-white pt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h4 class="mb-3">BenefitHub</h4>
                <p class="text-muted">Transformando beneficios alimentarios desde 2024</p>
                <div class="d-flex gap-3 fs-5">
                    <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>
            
            <div class="col-md-2">
                <h5>Empresa</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Sobre nosotros</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Blog</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Carreras</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Socios</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h5>Legal</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Términos de servicio</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Política de privacidad</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Seguridad</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Cookies</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h5>Contacto</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-envelope me-2"></i>soporte@benefithub.com</li>
                    <li><i class="bi bi-telephone me-2"></i>+1 809 555 1234</li>
                    <li><i class="bi bi-geo-alt me-2"></i>Av. Principal 123, CDMX</li>
                </ul>
            </div>
        </div>
        
        <div class="border-top mt-5 pt-3">
            <div class="row">
                <div class="col-md-6">
                    <small class="text-muted">© 2024 BenefitHub. Todos los derechos reservados</small>
                </div>
                <div class="col-md-6 text-md-end">
                    <img src="https://via.placeholder.com/80x30" alt="Certificaciones" class="me-2">
                    <img src="https://via.placeholder.com/80x30" alt="Métodos de pago">
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="assets/js/axios.min.js"></script>
<script>
    function toggleForms(event) {
        event.preventDefault();
        document.getElementById('login-form').style.display = 
            document.getElementById('login-form').style.display === 'none' ? 'block' : 'none';
        document.getElementById('reset-form').style.display = 
            document.getElementById('reset-form').style.display === 'none' ? 'block' : 'none';
    }

    
    
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const submitButton = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonText');
        const loadingSpinner = document.getElementById('loadingSpinner');

        const errorAlert = document.getElementById('errorAlert');
        errorAlert.classList.add('d-none'); // Hide the alert
        errorAlert.textContent = ''; // Clear the message


        // Disable the button and show the spinner
        submitButton.disabled = true;
        buttonText.textContent = 'Ingresando...';
        loadingSpinner.classList.remove('d-none');

        const formData = new FormData(this);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });

        // Debugging: Log the data being sent
        console.log('Data being sent:', data);

        axios.post('<?= route_to('login/submit'); ?>', data, {
            headers: {
                'Content-Type': 'application/json', // Set the Content-Type to JSON
            }, withCredentials: true
            })        
            .then(response => {
            
                if (response.data.success) {
                    const role = response.data.role_id;
                    if (role == 1) {
                        window.location.href = '<?= site_url('admin/dashboard'); ?>';
                    } else if (role == 2) {
                        window.location.href = '<?= site_url('employee/dashboard'); ?>';
                    } else if(role == 3) {
                        window.location.href = '<?= site_url('business/dashboard'); ?>';
                    } else {
                        alert('Rol de usuario desconocido: ' + role);
                    }
                } else {
                    alert(response.data.message || 'Error en el inicio de sesión');
                }

                
            })
            .catch(error => {
                // Debugging: Log the error
                console.error('Error:', error);
                errorAlert.classList.remove('d-none'); // Show the alert
                errorAlert.textContent = error.response.data.message;

                /*

                if (error.response) {
                    // The request was made and the server responded with a status code
                    console.error('Response data:', error.response.data);
                    console.error('Response status:', error.response.status);
                    console.error('Response headers:', error.response.headers);

                    if (error.response.status === 400) {
                        alert('Error 400: Solicitud incorrecta. Verifique los datos enviados.');
                    } else if (error.response.status === 403) {
                        alert('Error 403: Acceso prohibido. Verifique el token CSRF o la sesión.');
                    }
                } else if (error.request) {
                    // The request was made but no response was received
                    console.error('No response received:', error.request);
                    alert('No se recibió respuesta del servidor.');
                } else {
                    // Something happened in setting up the request
                    console.error('Request setup error:', error.message);
                    alert('Error al configurar la solicitud.');
                }
                    */
            })
            .finally(() => {
                // Re-enable the button and hide the spinner
                submitButton.disabled = false;
                buttonText.textContent = 'Ingresar';
                loadingSpinner.classList.add('d-none');
            });
        

    });
    
</script>
</body>
</html>