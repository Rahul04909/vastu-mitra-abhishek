<?php
require_once __DIR__ . '/database/db_config.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

if (!$slug) {
    header("Location: shop.php");
    exit;
}

// Fetch Product Details
try {
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            JOIN product_categories c ON p.category_id = c.id 
            WHERE p.slug = :slug";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
    $stmt->execute();
    $product = $stmt->fetch();

    if (!$product) {
        header("Location: shop.php");
        exit;
    }

    // Fetch Gallery
    $stmt_gal = $dbh->prepare("SELECT * FROM product_gallery WHERE product_id = ?");
    $stmt_gal->execute([$product['id']]);
    $gallery = $stmt_gal->fetchAll();

} catch (PDOException $e) {
    die("Error fetching product: " . $e->getMessage());
}

$page_title = $product['seo_title'] ?: ($product['name'] . " - Vastu Mitra Abhishek");
$meta_desc = $product['seo_description'];
$meta_keywords = $product['seo_keywords'];
$og_image = $product['og_image'] ? "admin/uploads/products/seo/" . $product['og_image'] : "admin/uploads/products/" . $product['main_image'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta_desc) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta_keywords) ?>">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta_desc) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($og_image) ?>">
    <meta property="og:type" content="product">

    <!-- Schema.org JSON-LD -->
    <?php if ($product['seo_schema']): ?>
        <script type="application/ld+json">
            <?= $product['seo_schema'] ?>
        </script>
    <?php endif; ?>

    <!-- Favicon -->
    <link rel="icon" href="favicon.png" type="image/x-icon">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/product-details.css">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <section class="product-details-container">
        <div class="product-details-row">
            <!-- Left: Gallery -->
            <div class="product-gallery-section">
                <div class="main-image-container">
                    <img id="mainImage" src="admin/uploads/products/<?= $product['main_image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <?php if (!empty($gallery)): ?>
                    <div class="gallery-thumbnails">
                        <div class="thumb-item active" onclick="changeImage('admin/uploads/products/<?= $product['main_image'] ?>', this)">
                            <img src="admin/uploads/products/<?= $product['main_image'] ?>" alt="Main">
                        </div>
                        <?php foreach ($gallery as $gal): ?>
                            <div class="thumb-item" onclick="changeImage('admin/uploads/products/gallery/<?= $gal['image_path'] ?>', this)">
                                <img src="admin/uploads/products/gallery/<?= $gal['image_path'] ?>" alt="Gallery">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right: Info & Enquiry -->
            <div class="product-info-section">
                <span class="product-category-label"><?= htmlspecialchars($product['category_name']) ?></span>
                <h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>
                
                <!-- Enquiry Form Card -->
                <div class="enquiry-card">
                    <h3>Enquire About This Product</h3>
                    <form id="enquiryForm" action="process-enquiry.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
                        
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Your Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" class="form-control" rows="3" placeholder="How can we help you with this product?" required></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn text-white">
                            <i class="fas fa-paper-plane text-white"></i> Send Enquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Full Width Description Section -->
        <div class="product-description-row">
            <div class="description-card">
                <h3>Product Description</h3>
                <hr>
                <div class="description-content">
                    <?= $product['description'] // Render HTML from Summernote ?>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="assets/js/header.js"></script>
    <script>
        function changeImage(src, element) {
            document.getElementById('mainImage').src = src;
            // Update active state
            document.querySelectorAll('.thumb-item').forEach(item => item.classList.remove('active'));
            element.classList.add('active');
        }

        // Handle Form Submission with SweetAlert (assuming it's available or user will add)
        document.getElementById('enquiryForm').onsubmit = function(e) {
            // This is a placeholder for actual backend processing
            // For now, it shows the professional intent
            console.log('Enquiry sent for: <?= htmlspecialchars($product['name']) ?>');
        };
    </script>
</body>
</html>
