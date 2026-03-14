<?php
require_once __DIR__ . '/../auth_init.php';

$successMsg = '';
$errorMsg = '';

// Handle Category Addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_category') {
    $name = trim($_POST['name'] ?? '');
    
    if (empty($name)) {
        $errorMsg = "Category name cannot be empty.";
    } else {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        
        try {
            // Check if table exists, if not create it (failsafe)
            $dbh->exec("CREATE TABLE IF NOT EXISTS `blog_categories` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(255) NOT NULL,
                `slug` VARCHAR(255) NOT NULL UNIQUE,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

            // Check for duplicates
            $stmt = $dbh->prepare("SELECT COUNT(*) FROM blog_categories WHERE name = ? OR slug = ?");
            $stmt->execute([$name, $slug]);
            if ($stmt->fetchColumn() > 0) {
                $errorMsg = "Category already exists.";
            } else {
                $stmt = $dbh->prepare("INSERT INTO blog_categories (name, slug) VALUES (?, ?)");
                if ($stmt->execute([$name, $slug])) {
                    $successMsg = "Blog category added successfully.";
                } else {
                    $errorMsg = "Error adding category.";
                }
            }
        } catch (PDOException $e) {
            $errorMsg = "Database error: " . $e->getMessage();
        }
    }
}

// Handle Category Deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        $stmt = $dbh->prepare("DELETE FROM blog_categories WHERE id = ?");
        if ($stmt->execute([$id])) {
            $successMsg = "Category deleted successfully.";
        } else {
            $errorMsg = "Error deleting category.";
        }
    } catch (PDOException $e) {
        $errorMsg = "Database error: " . $e->getMessage();
    }
}

// Fetch all categories
try {
    $categories = $dbh->query("SELECT * FROM blog_categories ORDER BY name ASC")->fetchAll();
} catch (PDOException $e) {
    $categories = [];
    // If table doesn't exist, we don't want to crash, just show empty
}

include __DIR__ . '/../header.php';
?>

<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Blog Categories</h1>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        
        <?php if ($successMsg): ?>
            <div class="alert alert-success mt-2"><?= htmlspecialchars($successMsg) ?></div>
        <?php endif; ?>
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger mt-2"><?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>

        <div class="row mt-4">
            <!-- Add Category Form -->
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Blog Category</h3>
                    </div>
                    <form action="add-blog-category.php" method="POST">
                        <input type="hidden" name="action" value="add_category">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Vastu Tips" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Category List Table -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title">Existing Blog Categories</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th style="width: 100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($categories)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">No blog categories found.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($categories as $index => $cat): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><strong><?= htmlspecialchars($cat['name']) ?></strong></td>
                                            <td><code><?= htmlspecialchars($cat['slug']) ?></code></td>
                                            <td>
                                                <a href="add-blog-category.php?delete=<?= $cat['id'] ?>" 
                                                   class="btn btn-outline-danger btn-sm"
                                                   onclick="return confirm('Are you sure you want to delete this category?')">
                                                   <i class="fas fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../footer.php'; ?>
