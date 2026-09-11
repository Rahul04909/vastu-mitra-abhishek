<?php
require_once __DIR__ . '/database/db_config.php';
require_once __DIR__ . '/includes/cart_functions.php';

$cart = get_cart($dbh);
$page_title = "Shopping Cart - Vastu Mitra Abhishek";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="icon" href="<?= BASE_URL ?>/favicon.png" type="image/x-icon">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/cart.css">
    
    <!-- Icons & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="cart-page-wrapper">
        <div class="cart-title-row">
            <div>
                <h1>Your Sacred Cart</h1>
                <span class="cart-count-subtitle" id="cartHeaderCount"><?= $cart['total_items'] ?> <?= ($cart['total_items'] === 1) ? 'item' : 'items' ?></span>
            </div>
            <a href="shop.php" class="continue-shopping-link" style="margin: 0;">
                <i class="fas fa-arrow-left mr-1"></i> Continue Browsing
            </a>
        </div>

        <?php if (empty($cart['items'])): ?>
            <!-- Empty Cart State -->
            <div class="cart-empty-state" id="emptyCartView">
                <div class="cart-empty-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h2>Your Cart is Currently Empty</h2>
                <p>Explore our consecrated yantras, energized vastu remedies, and spiritual products to begin.</p>
                <a href="shop.php" class="btn-explore">
                    <i class="fas fa-gem mr-1"></i> Explore Shop
                </a>
            </div>
        <?php else: ?>
            <div class="cart-layout-grid" id="activeCartView">
                <!-- Left: Items Table -->
                <div class="cart-items-card">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Subtotal</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="cartTableBody">
                            <?php foreach ($cart['items'] as $item): ?>
                                <tr id="cart-row-<?= $item['product_id'] ?>">
                                    <td>
                                        <div class="cart-item-info">
                                            <img src="<?= !empty($item['main_image']) ? 'admin/uploads/products/' . htmlspecialchars($item['main_image']) : 'assets/logo/logo.png' ?>" 
                                                 alt="<?= htmlspecialchars($item['name']) ?>" 
                                                 class="cart-item-img"
                                                 onerror="this.src='assets/logo/logo.png'">
                                            <div class="cart-item-details">
                                                <h4>
                                                    <a href="product-details.php?slug=<?= htmlspecialchars($item['slug']) ?>">
                                                        <?= htmlspecialchars($item['name']) ?>
                                                    </a>
                                                </h4>
                                                <?php if ($item['stock_status'] === 'out_of_stock'): ?>
                                                    <span class="stock-tag stock-out"><i class="fas fa-times-circle"></i> Out of stock</span>
                                                <?php else: ?>
                                                    <span class="stock-tag stock-in"><i class="fas fa-check-circle"></i> Energized &amp; In Stock</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="unit-price">₹<?= number_format($item['price'], 2) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="qty-control">
                                            <button type="button" class="qty-btn" onclick="modifyQty(<?= $item['product_id'] ?>, -1)" aria-label="Decrease quantity">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" 
                                                   class="qty-input" 
                                                   id="qty-input-<?= $item['product_id'] ?>" 
                                                   value="<?= $item['quantity'] ?>" 
                                                   min="1" 
                                                   max="99" 
                                                   onchange="changeQty(<?= $item['product_id'] ?>, this.value)"
                                                   aria-label="Item quantity">
                                            <button type="button" class="qty-btn" onclick="modifyQty(<?= $item['product_id'] ?>, 1)" aria-label="Increase quantity">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <span class="line-total" id="line-total-<?= $item['product_id'] ?>">
                                            ₹<?= number_format($item['line_total'], 2) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="remove-btn" onclick="removeItem(<?= $item['product_id'] ?>)" title="Remove Item">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Right: Summary Card -->
                <aside class="cart-summary-card">
                    <h3>Order Summary</h3>
                    <ul class="summary-list">
                        <li>
                            <span>Subtotal</span>
                            <strong id="cartSubtotalText">₹<?= number_format($cart['subtotal'], 2) ?></strong>
                        </li>
                        <li>
                            <span>Shipping (All India)</span>
                            <span class="shipping-free-badge">FREE</span>
                        </li>
                        <li class="grand-total">
                            <span>Estimated Total</span>
                            <strong id="cartTotalText">₹<?= number_format($cart['total_amount'], 2) ?></strong>
                        </li>
                    </ul>

                    <a href="checkout.php" class="btn-checkout">
                        Proceed to Checkout <i class="fas fa-arrow-right ml-1"></i>
                    </a>

                    <a href="shop.php" class="continue-shopping-link">
                        <i class="fas fa-plus mr-1"></i> Add More Items
                    </a>

                    <div class="trust-badges">
                        <div class="trust-badge-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>100% Secure Razorpay Checkout</span>
                        </div>
                        <div class="trust-badge-item">
                            <i class="fas fa-praying-hands"></i>
                            <span>Individually Energized &amp; Consecrated</span>
                        </div>
                        <div class="trust-badge-item">
                            <i class="fas fa-truck-fast"></i>
                            <span>Fast &amp; Free Insured Delivery</span>
                        </div>
                    </div>
                </aside>
            </div>
        <?php endif; ?>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <!-- SweetAlert2 for Toast Feedback -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });

        function modifyQty(productId, delta) {
            const input = document.getElementById('qty-input-' + productId);
            if (!input) return;
            let currentVal = parseInt(input.value) || 1;
            let newVal = currentVal + delta;
            if (newVal < 1) newVal = 1;
            input.value = newVal;
            changeQty(productId, newVal);
        }

        function changeQty(productId, qty) {
            let quantity = parseInt(qty) || 1;
            if (quantity < 1) quantity = 1;

            fetch('api/cart_handler.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'update', product_id: productId, quantity: quantity })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    updateCartUI(data.cart, data.cart_count);
                } else {
                    Toast.fire({ icon: 'error', title: data.message || 'Could not update quantity' });
                }
            })
            .catch(err => {
                console.error(err);
                Toast.fire({ icon: 'error', title: 'Network error updating cart' });
            });
        }

        function removeItem(productId) {
            Swal.fire({
                title: 'Remove this item?',
                text: 'Are you sure you want to remove this sacred item from your cart?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D4A843',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, remove it'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('api/cart_handler.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ action: 'remove', product_id: productId })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            const row = document.getElementById('cart-row-' + productId);
                            if (row) row.remove();
                            updateCartUI(data.cart, data.cart_count);
                            Toast.fire({ icon: 'success', title: 'Item removed from cart' });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Toast.fire({ icon: 'error', title: 'Error removing item' });
                    });
                }
            });
        }

        function updateCartUI(cart, count) {
            // Update counts in header and page
            const countHeader = document.getElementById('cartHeaderCount');
            if (countHeader) {
                countHeader.textContent = count + (count === 1 ? ' item' : ' items');
            }
            
            // Update global navbar cart badge if exists
            const navBadges = document.querySelectorAll('.cart-badge');
            navBadges.forEach(b => {
                b.textContent = count;
                b.style.display = count > 0 ? 'inline-flex' : 'none';
            });

            if (cart.items.length === 0) {
                location.reload();
                return;
            }

            // Update item row subtotal
            cart.items.forEach(item => {
                const lineTotalEl = document.getElementById('line-total-' + item.product_id);
                if (lineTotalEl) {
                    lineTotalEl.textContent = '₹' + Number(item.line_total).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            });

            // Update sidebar totals
            const subtotalEl = document.getElementById('cartSubtotalText');
            const totalEl = document.getElementById('cartTotalText');
            if (subtotalEl) {
                subtotalEl.textContent = '₹' + Number(cart.subtotal).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }
            if (totalEl) {
                totalEl.textContent = '₹' + Number(cart.total_amount).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }
        }
    </script>
</body>
</html>
