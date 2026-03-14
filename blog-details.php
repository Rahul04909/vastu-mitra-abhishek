<?php
require_once __DIR__ . '/database/db_config.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

if (empty($slug)) {
    header("Location: blog.php");
    exit;
}

// Fetch Blog Data
try {
    $sql = "SELECT b.*, bc.name as category_name 
            FROM blogs b 
            JOIN blog_categories bc ON b.category_id = bc.id 
            WHERE b.slug = :slug AND b.status = 'published'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([':slug' => $slug]);
    $blog = $stmt->fetch();
    
    if (!$blog) {
        header("Location: blog.php");
        exit;
    }

    // Fetch Related Posts
    $related_stmt = $dbh->prepare("SELECT title, slug, featured_image, created_at 
                                  FROM blogs 
                                  WHERE category_id = :cat_id AND id != :id AND status = 'published' 
                                  LIMIT 3");
    $related_stmt->execute([':cat_id' => $blog['category_id'], ':id' => $blog['id']]);
    $related_posts = $related_stmt->fetchAll();

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$page_title = $blog['seo_title'] ?: $blog['title'] . " - Vastu Mitra Abhishek";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($blog['seo_desc']) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($blog['seo_keywords']) ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($blog['title']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($blog['seo_desc']) ?>">
    <?php if ($blog['og_image']): ?>
    <meta property="og:image" content="<?= BASE_URL ?>/admin/uploads/blogs/seo/<?= htmlspecialchars($blog['og_image']) ?>">
    <?php else: ?>
    <meta property="og:image" content="<?= BASE_URL ?>/admin/uploads/blogs/<?= htmlspecialchars($blog['featured_image']) ?>">
    <?php endif; ?>
    <meta property="og:type" content="article">
    
    <!-- JSON-LD Schema -->
    <?php if ($blog['seo_schema']): ?>
    <script type="application/ld+json">
    <?= $blog['seo_schema'] ?>
    </script>
    <?php endif; ?>

    <!-- Favicon -->
    <link rel="icon" href="favicon.png" type="image/x-icon">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/blog.css">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Outfit', sans-serif; background-color: #f8f9fa;">

    <?php include 'includes/header.php'; ?>

    <main class="blog-details-container">
        <div class="details-header">
            <span class="details-category"><?= htmlspecialchars($blog['category_name']) ?></span>
            <h1><?= htmlspecialchars($blog['title']) ?></h1>
            <div class="blog-meta" style="justify-content: center;">
                <span><i class="fas fa-calendar-alt"></i> <?= date('M d, Y', strtotime($blog['created_at'])) ?></span>
                <span><i class="fas fa-user"></i> Admin</span>
            </div>
        </div>

        <img src="admin/uploads/blogs/<?= htmlspecialchars($blog['featured_image']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="featured-img-full">

        <article class="blog-article">
            <?= $blog['description'] ?>
        </article>

        <!-- Social Share placeholder -->
        <div style="margin-top: 60px; padding-top: 30px; border-top: 1px solid var(--border-color); display: flex; align-items: center; gap: 20px;">
            <span style="font-weight: 700; color: var(--text-dark);">Share this article:</span>
            <div style="display: flex; gap: 15px;">
                <a href="#" style="color: #3b5998; font-size: 1.5rem;"><i class="fab fa-facebook"></i></a>
                <a href="#" style="color: #1da1f2; font-size: 1.5rem;"><i class="fab fa-twitter"></i></a>
                <a href="#" style="color: #25d366; font-size: 1.5rem;"><i class="fab fa-whatsapp"></i></a>
                <a href="#" style="color: #0077b5; font-size: 1.5rem;"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

        <!-- Related Posts -->
        <?php if (!empty($related_posts)): ?>
        <div style="margin-top: 80px;">
            <h3 style="font-size: 1.5rem; color: var(--text-dark); margin-bottom: 30px; position: relative; padding-bottom: 10px;">
                Related Articles
                <div style="position: absolute; left: 0; bottom: 0; width: 60px; height: 3px; background: var(--primary-green);"></div>
            </h3>
            <div class="blog-grid" style="grid-template-columns: repeat(3, 1fr);">
                <?php foreach ($related_posts as $rp): ?>
                    <article class="blog-card" style="box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                        <div class="blog-img-box">
                            <img src="admin/uploads/blogs/<?= htmlspecialchars($rp['featured_image']) ?>" alt="<?= htmlspecialchars($rp['title']) ?>">
                        </div>
                        <div class="blog-content" style="padding: 20px;">
                            <h4 style="font-size: 1.1rem; margin-bottom: 15px;">
                                <a href="blog-details.php?slug=<?= $rp['slug'] ?>" style="text-decoration: none; color: var(--text-dark);"><?= htmlspecialchars($rp['title']) ?></a>
                            </h4>
                            <a href="blog-details.php?slug=<?= $rp['slug'] ?>" class="read-more" style="font-size: 0.85rem;">Read More</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <?php include 'includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="assets/js/header.js"></script>
</body>
</html>
