<?php
require_once __DIR__ . '/database/db_config.php';

// Get Active Category
$cat_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Pagination
$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch Categories with Blog Counts
try {
    $cat_query = "SELECT c.*, (SELECT COUNT(*) FROM blogs WHERE category_id = c.id AND status = 'published') as b_count 
                  FROM blog_categories c ORDER BY name ASC";
    $stmt_cat = $dbh->query($cat_query);
    $categories = $stmt_cat->fetchAll();
    
    // Fetch Total Blog Count (published)
    $total_blogs_count = $dbh->query("SELECT COUNT(*) FROM blogs WHERE status = 'published'")->fetchColumn();
} catch (PDOException $e) {
    $categories = [];
    $total_blogs_count = 0;
}

// Fetch Blogs based on filtering
try {
    $where = "WHERE b.status = 'published'";
    $params = [];
    
    if ($cat_id) {
        $where .= " AND b.category_id = :cat_id";
        $params[':cat_id'] = $cat_id;
    }
    
    if (!empty($search)) {
        $where .= " AND (b.title LIKE :search OR b.description LIKE :search)";
        $params[':search'] = "%$search%";
    }

    // Count for pagination
    $count_sql = "SELECT COUNT(*) FROM blogs b $where";
    $count_stmt = $dbh->prepare($count_sql);
    $count_stmt->execute($params);
    $total_records = $count_stmt->fetchColumn();
    $total_pages = ceil($total_records / $limit);

    $sql = "SELECT b.*, bc.name as category_name 
            FROM blogs b 
            JOIN blog_categories bc ON b.category_id = bc.id 
            $where 
            ORDER BY b.created_at DESC 
            LIMIT $limit OFFSET $offset";
    
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $blogs = $stmt->fetchAll();

    // Recent Posts for Sidebar
    $recent_stmt = $dbh->query("SELECT title, slug, created_at FROM blogs WHERE status = 'published' ORDER BY created_at DESC LIMIT 5");
    $recent_posts = $recent_stmt->fetchAll();
} catch (PDOException $e) {
    $blogs = [];
    $total_pages = 0;
    $recent_posts = [];
}

$page_title = "Blog - Vastu Mitra Abhishek";
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
    <link rel="stylesheet" href="assets/css/blog.css">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Outfit', sans-serif;">

    <?php include 'includes/header.php'; ?>

    <div class="blog-container">
        <!-- Main Content -->
        <main class="blog-main">
            <div class="blog-grid">
                <?php if (empty($blogs)): ?>
                    <div style="grid-column: 1/-1; text-align: center; padding: 60px 0;">
                        <i class="fas fa-newspaper fa-4x text-muted mb-3" style="opacity: 0.3;"></i>
                        <p class="text-muted">No blog posts found matching your criteria.</p>
                        <a href="blog.php" class="btn btn-primary mt-3" style="background: var(--primary-green); color:#fff; padding: 10px 20px; text-decoration:none; border-radius:30px;">View All Posts</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($blogs as $blog): ?>
                        <article class="blog-card">
                            <div class="blog-img-box">
                                <img src="admin/uploads/blogs/<?= htmlspecialchars($blog['featured_image']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>">
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span><i class="fas fa-calendar-alt"></i> <?= date('M d, Y', strtotime($blog['created_at'])) ?></span>
                                    <span><i class="fas fa-folder"></i> <?= htmlspecialchars($blog['category_name']) ?></span>
                                </div>
                                <h2><?= htmlspecialchars($blog['title']) ?></h2>
                                <p><?= strip_tags($blog['description']) ?></p>
                                <a href="blog-details.php?slug=<?= $blog['slug'] ?>" class="read-more">
                                    Read Article <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <div style="display: flex; justify-content: center; gap: 10px; margin-top: 50px;">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="blog.php?page=<?= $i ?>&category=<?= $cat_id ?>&search=<?= urlencode($search) ?>" 
                           style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%; border: 1px solid var(--border-color); text-decoration: none; color: <?= $i == $page ? '#fff' : 'var(--text-dark)' ?>; background: <?= $i == $page ? 'var(--primary-green)' : '#fff' ?>; transition: var(--transition);">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </main>

        <!-- Sidebar -->
        <aside class="blog-sidebar">
            <!-- Search Widget -->
            <div class="sidebar-widget">
                <h3>Search</h3>
                <form action="blog.php" method="GET" style="display: flex; gap: 10px;">
                    <input type="text" name="search" placeholder="Enter keywords..." value="<?= htmlspecialchars($search) ?>" 
                           style="flex: 1; padding: 10px 15px; border: 1px solid var(--border-color); border-radius: 30px; outline: none;">
                    <button type="submit" style="background: var(--primary-green); color: #fff; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Category Widget -->
            <div class="sidebar-widget">
                <h3>Categories</h3>
                <ul class="cat-list">
                    <li>
                        <a href="blog.php" class="<?= !$cat_id ? 'active' : '' ?>">
                            All Topics <span class="count-badge"><?= $total_blogs_count ?></span>
                        </a>
                    </li>
                    <?php foreach ($categories as $cat): ?>
                        <li>
                            <a href="blog.php?category=<?= $cat['id'] ?>" class="<?= $cat_id == $cat['id'] ? 'active' : '' ?>">
                                <?= htmlspecialchars($cat['name']) ?> 
                                <span class="count-badge"><?= $cat['b_count'] ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Recent Posts -->
            <div class="sidebar-widget">
                <h3>Recent Posts</h3>
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <?php foreach ($recent_posts as $rp): ?>
                        <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
                            <a href="blog-details.php?slug=<?= $rp['slug'] ?>" style="text-decoration: none; color: var(--text-dark); font-weight: 600; font-size: 0.95rem; line-height: 1.4; display: block; margin-bottom: 5px;">
                                <?= htmlspecialchars($rp['title']) ?>
                            </a>
                            <span style="font-size: 0.8rem; color: var(--text-muted);"><i class="far fa-calendar-alt mr-1"></i> <?= date('M d, Y', strtotime($rp['created_at'])) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </aside>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- Scripts -->
    <script src="assets/js/header.js"></script>
</body>
</html>
