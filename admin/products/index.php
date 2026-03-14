<?php
require_once __DIR__ . '/../auth_init.php';

$successMsg = '';
$errorMsg = '';

// Handle Delete Request
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        // Fetch image paths to delete files
        $stmt = $dbh->prepare("SELECT main_image, og_image FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch();

        if ($product) {
            // Delete main image
            if ($product['main_image'] && file_exists(__DIR__ . '/../uploads/products/' . $product['main_image'])) {
                unlink(__DIR__ . '/../uploads/products/' . $product['main_image']);
            }
            // Delete OG image
            if ($product['og_image'] && file_exists(__DIR__ . '/../uploads/products/seo/' . $product['og_image'])) {
                unlink(__DIR__ . '/../uploads/products/seo/' . $product['og_image']);
            }

            // Delete gallery images
            $stmt = $dbh->prepare("SELECT image_path FROM product_gallery WHERE product_id = ?");
            $stmt->execute([$id]);
            $gallery = $stmt->fetchAll();
            foreach ($gallery as $img) {
                if (file_exists(__DIR__ . '/../uploads/products/gallery/' . $img['image_path'])) {
                    unlink(__DIR__ . '/../uploads/products/gallery/' . $img['image_path']);
                }
            }

            // Delete from database (Cascading will handle gallery records)
            $stmt = $dbh->prepare("DELETE FROM products WHERE id = ?");
            if ($stmt->execute([$id])) {
                $successMsg = "Product deleted successfully.";
            }
        }
    } catch (PDOException $e) {
        $errorMsg = "Error deleting product: " . $e->getMessage();
    }
}

// Pagination & Filtering
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$whereClauses = [];
$params = [];

if (!empty($_GET['name'])) {
    $whereClauses[] = "p.name LIKE ?";
    $params[] = "%" . $_GET['name'] . "%";
}
if (!empty($_GET['category'])) {
    $whereClauses[] = "p.category_id = ?";
    $params[] = (int)$_GET['category'];
}

$whereSql = !empty($whereClauses) ? " WHERE " . implode(" AND ", $whereClauses) : "";

// Fetch Products
try {
    $sql = "SELECT p.*, c.name as category_name FROM products p 
            JOIN product_categories c ON p.category_id = c.id 
            $whereSql 
            ORDER BY p.created_at DESC LIMIT $limit OFFSET $offset";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll();

    // Get total for pagination
    $stmtTotal = $dbh->prepare("SELECT COUNT(*) FROM products p $whereSql");
    $stmtTotal->execute($params);
    $totalProducts = $stmtTotal->fetchColumn();
    $totalPages = ceil($totalProducts / $limit);
} catch (PDOException $e) {
    $products = [];
    $errorMsg = "Error fetching products: " . $e->getMessage();
}

// Fetch categories for filter dropdown
$categories = $dbh->query("SELECT * FROM product_categories ORDER BY name ASC")->fetchAll();

include __DIR__ . '/../header.php';
?>

<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Products</h1>
            </div>
            <div class="col-sm-6">
                <a href="add-product.php" class="btn btn-primary float-sm-right"><i class="fas fa-plus"></i> Add New Product</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        
        <?php if ($successMsg): ?>
            <div class="alert alert-success"><?= $successMsg ?></div>
        <?php endif; ?>
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger"><?= $errorMsg ?></div>
        <?php endif; ?>

        <!-- Filters -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Filter Products</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="index.php" class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Search by name" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= (isset($_GET['category']) && $_GET['category'] == $cat['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-group mr-2">
                            <button type="submit" class="btn btn-info">Apply Filters</button>
                        </div>
                        <div class="form-group">
                            <a href="index.php" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Product List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Products List</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Date Created</th>
                            <th style="width: 150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No products found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($products as $p): ?>
                                <tr>
                                    <td><?= $p['id'] ?></td>
                                    <td>
                                        <img src="<?= BASE_URL ?>/admin/uploads/products/<?= htmlspecialchars($p['main_image']) ?>" 
                                             class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td><strong><?= htmlspecialchars($p['name']) ?></strong></td>
                                    <td><span class="badge badge-info shadow-sm" style="background-color: #28a645;"><?= htmlspecialchars($p['category_name']) ?></span></td>
                                    <td><?= date('d M Y', strtotime($p['created_at'])) ?></td>
                                    <td>
                                        <div class="d-flex" style="gap: 5px;">
                                            <a href="edit-product.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary" title="Edit Product">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="index.php?delete=<?= $p['id'] ?>" 
                                               class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Delete this product and all its images?')"
                                               title="Delete Product">
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
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&category=<?= $_GET['category'] ?? '' ?>">&laquo;</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&category=<?= $_GET['category'] ?? '' ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&name=<?= urlencode($_GET['name'] ?? '') ?>&category=<?= $_GET['category'] ?? '' ?>">&raquo;</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../footer.php'; ?>
