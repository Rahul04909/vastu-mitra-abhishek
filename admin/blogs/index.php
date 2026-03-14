<?php
require_once __DIR__ . '/../auth_init.php';

// Failsafe table creation
try {
    $dbh->exec("CREATE TABLE IF NOT EXISTS `blogs` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `category_id` INT NOT NULL,
        `title` VARCHAR(255) NOT NULL,
        `slug` VARCHAR(255) NOT NULL UNIQUE,
        `description` LONGTEXT NOT NULL,
        `featured_image` VARCHAR(255) NOT NULL,
        `seo_title` VARCHAR(255) DEFAULT NULL,
        `seo_desc` TEXT DEFAULT NULL,
        `seo_keywords` TEXT DEFAULT NULL,
        `seo_schema` LONGTEXT DEFAULT NULL,
        `og_image` VARCHAR(255) DEFAULT NULL,
        `status` ENUM('published', 'draft') DEFAULT 'published',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (`category_id`) REFERENCES `blog_categories`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
} catch (PDOException $e) {
    // Silent fail if already exists or other error
}

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Filters
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$where = " WHERE 1=1 ";
$params = [];

if ($category_id > 0) {
    $where .= " AND b.category_id = :category_id ";
    $params[':category_id'] = $category_id;
}

if (!empty($search)) {
    $where .= " AND (b.title LIKE :search OR b.description LIKE :search) ";
    $params[':search'] = "%$search%";
}

// Fetch Blogs
try {
    $count_sql = "SELECT COUNT(*) FROM blogs b" . $where;
    $count_stmt = $dbh->prepare($count_sql);
    $count_stmt->execute($params);
    $total_blogs = $count_stmt->fetchColumn();
    $total_pages = ceil($total_blogs / $limit);

    $sql = "SELECT b.*, bc.name as category_name 
            FROM blogs b 
            LEFT JOIN blog_categories bc ON b.category_id = bc.id 
            $where 
            ORDER BY b.created_at DESC 
            LIMIT $limit OFFSET $offset";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $blogs = $stmt->fetchAll();

    $categories = $dbh->query("SELECT * FROM blog_categories ORDER BY name ASC")->fetchAll();
} catch (PDOException $e) {
    $blogs = [];
    $categories = [];
    $errorMsg = "Database error: " . $e->getMessage();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        $stmt = $dbh->prepare("SELECT featured_image FROM blogs WHERE id = ?");
        $stmt->execute([$id]);
        $blog = $stmt->fetch();
        
        if ($blog) {
            $stmt = $dbh->prepare("DELETE FROM blogs WHERE id = ?");
            if ($stmt->execute([$id])) {
                if (file_exists(__DIR__ . '/../uploads/blogs/' . $blog['featured_image'])) {
                    unlink(__DIR__ . '/../uploads/blogs/' . $blog['featured_image']);
                }
                header("Location: index.php?msg=deleted");
                exit;
            }
        }
    } catch (PDOException $e) {
        $errorMsg = "Error deleting blog: " . $e->getMessage();
    }
}

include __DIR__ . '/../header.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Blog Posts</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="add-blog.php" class="btn btn-success" style="background-color: #28a645;">
                    <i class="fas fa-plus"></i> Add New Blog
                </a>
            </div>
        </div>
    </div>
</div>

<section class="content text-sm">
    <div class="container-fluid">
        <!-- Filters -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="index.php" method="GET" class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Search by title..." value="<?= htmlspecialchars($search) ?>">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="category" class="form-control">
                            <option value="">All Categories</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $category_id ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    </div>
                    <div class="col-md-2 mb-2">
                        <a href="index.php" class="btn btn-secondary btn-block">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div class="alert alert-success">Blog post deleted successfully!</div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 80px">Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($blogs)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">No blog posts found.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($blogs as $blog): ?>
                                    <tr>
                                        <td>
                                            <img src="<?= BASE_URL ?>/admin/uploads/blogs/<?= $blog['featured_image'] ?>" alt="Thumb" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <strong><?= htmlspecialchars($blog['title']) ?></strong>
                                            <div class="text-muted small"><?= htmlspecialchars($blog['slug']) ?></div>
                                        </td>
                                        <td>
                                            <span class="badge badge-info"><?= htmlspecialchars($blog['category_name']) ?></span>
                                        </td>
                                        <td>
                                            <?php if ($blog['status'] == 'published'): ?>
                                                <span class="badge badge-success">Published</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Draft</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d M Y', strtotime($blog['created_at'])) ?></td>
                                        <td>
                                            <div class="d-flex gap-1" style="gap: 5px;">
                                                <a href="edit-blog.php?id=<?= $blog['id'] ?>" class="btn btn-outline-primary btn-sm flex-fill">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="index.php?delete=<?= $blog['id'] ?>" class="btn btn-outline-danger btn-sm flex-fill" onclick="return confirm('Delete this blog post?')">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if ($total_pages > 1): ?>
                <div class="card-footer bg-white">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="index.php?page=<?= $i ?>&category=<?= $category_id ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../footer.php'; ?>
