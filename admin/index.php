<?php 
include './header.php'; 

// Fetch real-time stats
$total_products = $dbh->query("SELECT COUNT(*) FROM products")->fetchColumn();
$total_blogs = $dbh->query("SELECT COUNT(*) FROM blogs")->fetchColumn();
$total_enquiries = $dbh->query("SELECT COUNT(*) FROM enquiries")->fetchColumn();

// Self-healing check for product_enquiries table (just in case)
try {
    $total_product_enquiries = $dbh->query("SELECT COUNT(*) FROM product_enquiries")->fetchColumn();
} catch (Exception $e) {
    $total_product_enquiries = 0;
}
?>

<div class="row pt-3">
    <!-- Total Products -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info shadow-sm">
            <div class="inner">
                <h3><?= number_format($total_products) ?></h3>
                <p>Total Products</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <a href="<?= ADMIN_URL ?>/products/index.php" class="small-box-footer">View Products
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Blogs -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success shadow-sm">
            <div class="inner">
                <h3><?= number_format($total_blogs) ?></h3>
                <p>Total Blogs</p>
            </div>
            <div class="icon">
                <i class="fas fa-blog"></i>
            </div>
            <a href="<?= ADMIN_URL ?>/blogs/index.php" class="small-box-footer">View Blogs
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- General Enquiries -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning shadow-sm">
            <div class="inner">
                <h3><?= number_format($total_enquiries) ?></h3>
                <p>Total Enquiries</p>
            </div>
            <div class="icon">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <a href="<?= ADMIN_URL ?>/enquiries/index.php" class="small-box-footer">View Enquiries
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Product Enquiries -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger shadow-sm">
            <div class="inner">
                <h3><?= number_format($total_product_enquiries) ?></h3>
                <p>Product Enquiries</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="<?= ADMIN_URL ?>/products/enquiries.php" class="small-box-footer">View Lead
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<?php include './footer.php'; ?>