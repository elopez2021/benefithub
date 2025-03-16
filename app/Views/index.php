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

<!-- Hero Section -->
<section class="hero-section py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Beneficios alimentarios para tu empresa</h1>
                <p class="lead mb-4">Ofrece subsidios en restaurantes afiliados y mejora el bienestar de tus empleados</p>
                <div class="d-flex gap-3">
                    <a href="#contacto" class="btn btn-light btn-lg px-4">Empieza ahora</a>
                    <a href="#restaurantes" class="btn btn-outline-light btn-lg px-4">Soy restaurante</a>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Como Funciona -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">¿Cómo funciona BenefitHub?</h2>
        
        <!-- Pestañas para diferentes usuarios -->
        <ul class="nav nav-pills justify-content-center mb-5" id="howItWorksTabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="pill" href="#empresas-tab">Para Empresas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#empleados-tab">Para Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#restaurantes-tab">Para Restaurantes</a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- Pestaña Empresas -->
            <div class="tab-pane fade show active" id="empresas-tab">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="step-number bg-primary text-white rounded-circle mb-3 mx-auto">1</div>
                                <h5>Registro Corporativo</h5>
                                <p>Crea tu cuenta empresarial y configura los parámetros de tu programa de beneficios</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="step-number bg-primary text-white rounded-circle mb-3 mx-auto">2</div>
                                <h5>Vinculación de Empleados</h5>
                                <p>Importa tu nómina o invita a tus empleados mediante correo electrónico</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="step-number bg-primary text-white rounded-circle mb-3 mx-auto">3</div>
                                <h5>Gestión de Fondos</h5>
                                <p>Transfiere los fondos del subsidio y monitorea el uso en tiempo real</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pestaña Empleados -->
            <div class="tab-pane fade" id="empleados-tab">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-wallet2 fs-1 text-primary mb-3"></i>
                                <h5>Recibe tu Saldo</h5>
                                <p>Tu empresa asigna un monto mensual a tu cuenta BenefitHub</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-search fs-1 text-primary mb-3"></i>
                                <h5>Busca Restaurantes</h5>
                                <p>Encuentra establecimientos afiliados cerca de ti</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-credit-card fs-1 text-primary mb-3"></i>
                                <h5>Realiza tu Pedido</h5>
                                <p>Usa tu saldo al pagar en restaurantes participantes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-graph-up fs-1 text-primary mb-3"></i>
                                <h5>Monitorea tu Saldo</h5>
                                <p>Revisa tu historial y saldo disponible en cualquier momento</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pestaña Restaurantes -->
            <div class="tab-pane fade" id="restaurantes-tab">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h5><i class="bi bi-patch-check-fill text-success me-2"></i>Proceso de Afiliación</h5>
                                <ol class="mt-3">
                                    <li>Registra tu establecimiento</li>
                                    <li>Verificamos tus datos</li>
                                    <li>Integración con tu POS</li>
                                    <li>¡Empieza a recibir clientes!</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h5><i class="bi bi-bar-chart-line-fill text-primary me-2"></i>Beneficios para Restaurantes</h5>
                                <ul class="mt-3">
                                    <li>Aumento de clientela</li>
                                    <li>Pagos garantizados</li>
                                    <li>Dashboard analítico</li>
                                    <li>Promoción gratuita</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Sección Empresas -->
<section id="empresas" class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold mb-4">Beneficios para empresas</h2>
                <ul class="list-unstyled">
                    <li class="mb-3"><i class="bi bi-check2-circle text-primary me-2"></i>Mejora el bienestar laboral</li>
                    <li class="mb-3"><i class="bi bi-check2-circle text-primary me-2"></i>Atracción y retención de talento</li>
                    <li class="bi bi-check2-circle text-primary me-2"></i>Gestón automatizada de subsidios</li>
                </ul>
            </div>
            <div class="col-md-6">
                <i class="bi bi-currency-exchange me-2" style="margin-left:200px; font-size: 100px; color:blue;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Directorio Restaurantes -->
<section id="restaurantes" class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4">Restaurantes afiliados</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card restaurant-card">
                    <img src="https://placehold.co/600x400?text=Restaurant+Image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">La Trattoria</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-secondary">Italiana</span>
                                <span class="badge bg-secondary">$$</span>
                            </div>
                            <a href="#" class="btn btn-sm btn-primary">Ver menú</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card restaurant-card">
                    <img src="https://placehold.co/600x400?text=Restaurant+Image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Sushi Express</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-secondary">Japonesa</span>
                                <span class="badge bg-secondary">$$$</span>
                            </div>
                            <a href="#" class="btn btn-sm btn-primary">Ver menú</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card restaurant-card">
                    <img src="https://placehold.co/600x400?text=Restaurant+Image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Burger House</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-secondary">Americana</span>
                                <span class="badge bg-secondary">$$</span>
                            </div>
                            <a href="#" class="btn btn-sm btn-primary">Ver menú</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Contacto -->
<section id="contacto" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Contáctanos</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9+\-\s]*" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo de usuario</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Selecciona una opción</option>
                            <option value="proveedor">Restaurante</option>
                            <option value="empresa">Empresa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar</button>
                </form>
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
                    <small class="text-white">© 2024 BenefitHub. Todos los derechos reservados</small>
                </div>
            </div>
        </div>
    </div>
</footer>


</body>
</html>