<?php
require_once __DIR__ . '/database/db_config.php';

// Get Active Category
$cat_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;

// Fetch Categories with Product Counts
try {
    $cat_query = "SELECT c.*, (SELECT COUNT(*) FROM products WHERE category_id = c.id) as p_count 
                  FROM product_categories c ORDER BY name ASC";
    $stmt_cat = $dbh->query($cat_query);
    $categories = $stmt_cat->fetchAll();
    
    // Fetch Total Product Count
    $total_products_count = $dbh->query("SELECT COUNT(*) FROM products")->fetchColumn();
} catch (PDOException $e) {
    $categories = [];
    $total_products_count = 0;
}

// Fetch Products based on filtering
try {
    $where = $cat_id ? "WHERE p.category_id = :cat_id" : "";
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            JOIN product_categories c ON p.category_id = c.id 
            $where 
            ORDER BY p.created_at DESC";
    
    $stmt = $dbh->prepare($sql);
    if ($cat_id) {
        $stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
    }
    $stmt->execute();
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    $products = [];
}

$page_title = "Shop - Vastu Mitra Abhishek";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <!-- Favicon -->
    <link rel="icon" href="favicon.png" type="image/x-icon">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/shop.css">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <div class="shop-container">
        <!-- Sidebar -->
        <aside class="shop-sidebar">
            <div class="category-widget">
                <h3>Categories</h3>
                <ul class="category-list">
                    <li>
                        <a href="shop.php" class="<?= !$cat_id ? 'active' : '' ?>">
                            All Products <span class="count-badge"><?= $total_products_count ?></span>
                        </a>
                    </li>
                    <?php foreach ($categories as $cat): ?>
                        <li>
                            <a href="shop.php?category=<?= $cat['id'] ?>" class="<?= $cat_id == $cat['id'] ? 'active' : '' ?>">
                                <?= htmlspecialchars($cat['name']) ?> 
                                <span class="count-badge"><?= $cat['p_count'] ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="shop-main">
            <div class="product-grid">
                <?php if (empty($products)): ?>
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-box-open fa-3x text-light mb-3"></i>
                        <p>No products found in this category.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($products as $p): ?>
                        <?php
                            $price = (float)($p['price'] ?? 0);
                            $salePrice = ($p['sale_price'] !== null && (float)$p['sale_price'] > 0) ? (float)$p['sale_price'] : null;
                            $hasDiscount = $salePrice !== null && $salePrice < $price;
                            $effectivePrice = $hasDiscount ? $salePrice : $price;
                            $discountPercent = ($hasDiscount && $price > 0) ? round((($price - $salePrice) / $price) * 100) : 0;
                            $isOutOfStock = isset($p['stock_status']) && $p['stock_status'] === 'out_of_stock';
                        ?>
                        <article class="product-card">
                            <div class="product-image-container">
                                <span class="category-tag"><?= htmlspecialchars($p['category_name']) ?></span>
                                
                                <?php if ($isOutOfStock): ?>
                                    <span class="product-stock-badge-out">Out of Stock</span>
                                <?php elseif ($hasDiscount): ?>
                                    <span class="product-discount-badge"><?= $discountPercent ?>% OFF</span>
                                <?php endif; ?>

                                <a href="product-details.php?slug=<?= $p['slug'] ?>">
                                    <img src="admin/uploads/products/<?= htmlspecialchars($p['main_image']) ?>" 
                                         alt="<?= htmlspecialchars($p['name']) ?>"
                                         onerror="this.src='assets/logo/logo.png'">
                                </a>
                            </div>
                            <div class="product-info">
                                <h4>
                                    <a href="product-details.php?slug=<?= $p['slug'] ?>" style="color: inherit; text-decoration: none;">
                                        <?= htmlspecialchars($p['name']) ?>
                                    </a>
                                </h4>

                                <div class="product-price-row">
                                    <?php if ($effectivePrice > 0): ?>
                                        <span class="product-price-current">₹<?= number_format($effectivePrice, 2) ?></span>
                                        <?php if ($hasDiscount): ?>
                                            <span class="product-price-old">₹<?= number_format($price, 2) ?></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="product-price-current" style="font-size: 1.05rem; color: #28a745;">Consult / Enquire</span>
                                    <?php endif; ?>
                                </div>

                                <div class="product-actions-row">
                                    <?php if ($isOutOfStock): ?>
                                        <button type="button" class="btn-card-cart btn-card-disabled" disabled>Out of Stock</button>
                                        <a href="product-details.php?slug=<?= $p['slug'] ?>" class="btn-card-buy">Details</a>
                                    <?php elseif ($effectivePrice > 0): ?>
                                        <button type="button" class="btn-card-cart" onclick="shopAddToCart(<?= $p['id'] ?>, this)">
                                            <i class="fas fa-cart-plus"></i> Add
                                        </button>
                                        <a href="checkout.php?buy_now=<?= $p['id'] ?>&qty=1" class="btn-card-buy">
                                            Buy Now
                                        </a>
                                    <?php else: ?>
                                        <a href="product-details.php?slug=<?= $p['slug'] ?>" class="view-btn" style="width: 100%;">View Details</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- SweetAlert2 & Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/header.js"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });

        function shopAddToCart(productId, btn) {
            const originalContent = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            fetch('api/cart_handler.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'add', product_id: productId, quantity: 1 })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update global navbar cart badge
                    const navBadges = document.querySelectorAll('.cart-badge');
                    navBadges.forEach(b => {
                        b.textContent = data.cart_count;
                        b.style.display = data.cart_count > 0 ? 'inline-flex' : 'none';
                    });

                    Toast.fire({
                        icon: 'success',
                        title: data.message || 'Added to cart!'
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.message || 'Could not add to cart.'
                    });
                }
            })
            .catch(err => {
                console.error(err);
                Toast.fire({
                    icon: 'error',
                    title: 'Network error adding to cart.'
                });
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = originalContent;
            });
        }
    </script>
</body>
</html>
