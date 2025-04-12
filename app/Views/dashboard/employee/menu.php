<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - La Cantina Mexicana</title>

    <style>
        .menu-item-card {
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .menu-item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .cart {
            position: sticky;
            top: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .cart-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <!-- Menú Principal -->
    <?php include 'navbar.php'; ?>


    <!-- Contenido Principal -->
    <div class="container my-5">
        <div class="row">
            <!-- Restaurant Menu Section -->
            <div class="col-md-8">
                <h2 class="mb-4">Menú de <?= esc($restaurant['commercial_name']) ?></h2>
                
                <!-- Current Time Display -->
                <div class="alert alert-info mb-4">
                    <i class="bi bi-clock me-2"></i> Horario actual: 
                    <?= date('h:i A', strtotime($currentTime)) ?> - 
                    <?= [
                        'monday' => 'Lunes',
                        'tuesday' => 'Martes',
                        'wednesday' => 'Miércoles',
                        'thursday' => 'Jueves',
                        'friday' => 'Viernes',
                        'saturday' => 'Sábado',
                        'sunday' => 'Domingo'
                    ][strtolower($currentDay)] ?? $currentDay ?>
                </div>

                <!-- Category Filter -->
                <div class="mt-2 mb-4">
                    <select class="form-select" id="categoryFilter">
                        <option value="">Todas las categorías disponibles</option>
                        <?php foreach ($categories as $category): 
                            $schedule = $categorySchedules[$category['id']] ?? ['start_time' => '', 'end_time' => ''];
                        ?>
                            <option value="<?= esc($category['id']) ?>">
                                <?= esc($category['name']) ?> 
                                (<?= date('h:i A', strtotime($schedule['start_time'])) ?> - 
                                <?= date('h:i A', strtotime($schedule['end_time'])) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Product Display -->
                <?php if (empty($groupedProducts)): ?>
                    <div class="alert alert-warning mt-4">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        No hay productos disponibles en este horario.
                    </div>
                <?php else: ?>
                    <?php foreach ($groupedProducts as $categoryName => $categoryProducts): 
                        $firstCategoryId = $categoryProducts[0]['categories'][0]['id'] ?? '';
                        $schedule = $categorySchedules[$firstCategoryId] ?? ['start_time' => '', 'end_time' => ''];
                    ?>
                        <div class="category-section" data-category="<?= esc($firstCategoryId) ?>">
                            <h4 class="mt-4 mb-3 d-flex align-items-center">
                                <?= esc($categoryName) ?>
                                <small class="ms-2 text-muted">
                                    (<?= date('h:i A', strtotime($schedule['start_time'])) ?> - 
                                    <?= date('h:i A', strtotime($schedule['end_time'])) ?>)
                                </small>
                            </h4>
                            
                            <div class="row g-4">
                                <?php foreach ($categoryProducts as $productData): 
                                    $product = $productData['product'];
                                    $categories = $productData['categories'];
                                ?>
                                    <div class="col-md-6 menu-item">
                                        <div class="card menu-item-card h-100">
                                            
                                            <div class="card-body">
                                                <h5 class="card-title"><?= esc($product['name']) ?></h5>
                                                <p class="text-muted"><?= esc($product['description']) ?></p>
                                                
                                                <!-- Category Badges -->
                                                <div class="mb-2">
                                                    <?php foreach ($categories as $cat): ?>
                                                        <span class="badge bg-secondary me-1" 
                                                            data-category-id="<?= esc($cat['id']) ?>">
                                                            <?= esc($cat['name']) ?>
                                                        </span>
                                                    <?php endforeach; ?>
                                                </div>
                                                
                                                <!-- Price and Add to Cart -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="fw-bold">RD$ <?= number_format($product['price'], 2) ?></span>
                                                    <button class="btn btn-primary btn-sm add-to-cart" 
                                                            data-product-id="<?= $product['id'] ?>"
                                                            data-product-name="<?= esc($product['name']) ?>"
                                                            data-product-price="<?= $product['price'] ?>">
                                                        <i class="bi bi-cart-plus"></i> Agregar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Shopping Cart Section -->
            <div class="col-md-4">
                <div class="card shadow sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h4 class="mb-4">
                            <i class="bi bi-cart3 me-2"></i>Tu Pedido
                        </h4>
                        
                        <!-- Cart Items -->
                        <div id="cartItems" class="mb-3">
                            <div class="alert alert-secondary mb-0 empty-cart-message">
                                <i class="bi bi-info-circle me-2"></i>
                                No hay items en tu pedido
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span id="subtotal">RD$ 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subsidio:</span>
                                <span id="subsidy">RD$ <?= $subsidy_left_today ?></span>
                            </div>
                            <h5 class="d-flex justify-content-between mt-3">
                                <span>Total:</span>
                                <span id="cartTotal">RD$ 0.00</span>
                            </h5>
                            <button class="btn btn-primary w-100 mt-3" id="placeOrder">
                                <i class="bi bi-check-circle me-2"></i>Confirmar Pedido
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Cart functionality
    let cart = JSON.parse(localStorage.getItem('cart')) || {};

    // Initialize cart display
    updateCartDisplay();

    // Add to cart buttons
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productPrice = parseFloat(this.getAttribute('data-product-price'));
            
            // Add to cart or increment quantity
            if (cart[productId]) {
                cart[productId].quantity += 1;
            } else {
                cart[productId] = {
                    name: productName,
                    price: productPrice,
                    quantity: 1
                };
            }
            
            saveCart();
            updateCartDisplay();
        });
    });

    // Save cart to localStorage
    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    // Update cart display
    function updateCartDisplay() {
        const cartItemsContainer = document.getElementById('cartItems');
        const emptyCartMessage = document.querySelector('.empty-cart-message');
        
        if (Object.keys(cart).length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="alert alert-secondary mb-0 empty-cart-message">
                    <i class="bi bi-info-circle me-2"></i>
                    No hay items en tu pedido
                </div>
            `;
        } else {
            let itemsHTML = '';
            let subtotal = 0;
            
            for (const [productId, item] of Object.entries(cart)) {
                subtotal += item.price * item.quantity;
                
                itemsHTML += `
                    <div class="cart-item mb-3" data-product-id="${productId}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">${item.name}</h6>
                                <small class="text-muted">${item.quantity} x RD$ ${item.price.toFixed(2)}</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-outline-secondary decrease-quantity me-1">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <span class="mx-2">${item.quantity}</span>
                                <button class="btn btn-sm btn-outline-secondary increase-quantity me-2">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger remove-item">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }
            
            const subsidy = parseFloat(document.getElementById('subsidy').textContent.replace(/[^0-9.]/g, ''));
            const total = Math.abs(subtotal - subsidy);
            
            cartItemsContainer.innerHTML = itemsHTML;
            document.getElementById('subtotal').textContent = `RD$ ${subtotal.toFixed(2)}`;

            document.getElementById('cartTotal').textContent = `RD$ ${total.toFixed(2)}`;
            
            // Add event listeners to new buttons
            document.querySelectorAll('.decrease-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.closest('.cart-item').getAttribute('data-product-id');
                    if (cart[productId].quantity > 1) {
                        cart[productId].quantity -= 1;
                        saveCart();
                        updateCartDisplay();
                    }
                });
            });
            
            document.querySelectorAll('.increase-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.closest('.cart-item').getAttribute('data-product-id');
                    cart[productId].quantity += 1;
                    saveCart();
                    updateCartDisplay();
                });
            });
            
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.closest('.cart-item').getAttribute('data-product-id');
                    delete cart[productId];
                    saveCart();
                    updateCartDisplay();
                    location.reload();
                });
            });
        }
    }

    // Place order button
    document.getElementById('placeOrder').addEventListener('click', function() {
        if (Object.keys(cart).length === 0) {
            alert('Tu carrito está vacío');
            return;
        }
        
        axios.post('/api/orders/create', {
            restaurant_id: <?= $restaurant['id'] ?>,
            employee_id: <?= $employee['id'] ?? 0 ?>,
            items: cart,
            total: document.getElementById('cartTotal').textContent.replace(/[^0-9.]/g, '')
        })
        .then(response => {
            alert('Pedido realizado con éxito!');
            localStorage.removeItem('cart');
            cart = {};
            updateCartDisplay();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al realizar el pedido: ' + (error.response?.data?.message || error.message));
        });
    });

    // Category filter
    document.getElementById('categoryFilter').addEventListener('change', function() {
        const categoryId = this.value;
        document.querySelectorAll('.category-section').forEach(section => {
            if (!categoryId || section.getAttribute('data-category') === categoryId) {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>