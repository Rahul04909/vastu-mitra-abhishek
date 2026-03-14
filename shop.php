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
                        <article class="product-card">
                            <div class="product-image-container">
                                <span class="category-tag"><?= htmlspecialchars($p['category_name']) ?></span>
                                <img src="admin/uploads/products/<?= htmlspecialchars($p['main_image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                            </div>
                            <div class="product-info">
                                <h4><?= htmlspecialchars($p['name']) ?></h4>
                                <a href="product-details.php?slug=<?= $p['slug'] ?>" class="view-btn">View Details</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="assets/js/header.js"></script>
</body>
</html>
