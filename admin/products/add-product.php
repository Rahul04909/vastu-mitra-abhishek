<?php
require_once __DIR__ . '/../auth_init.php';

$successMsg = '';
$errorMsg = '';

// Fetch categories for the dropdown
try {
    $categories = $dbh->query("SELECT * FROM product_categories ORDER BY name ASC")->fetchAll();
} catch (PDOException $e) {
    $categories = [];
    $errorMsg = "Error fetching categories: " . $e->getMessage();
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_product') {
    $name = trim($_POST['name'] ?? '');
    $category_id = $_POST['category_id'] ?? '';
    $description = $_POST['description'] ?? '';
    $seo_title = $_POST['seo_title'] ?? '';
    $seo_description = $_POST['seo_description'] ?? '';
    $seo_keywords = $_POST['seo_keywords'] ?? '';
    $seo_schema = $_POST['seo_schema'] ?? '';
    
    // Generate Slug
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));

    try {
        $dbh->beginTransaction();

        // Check if slug exists
        $stmt = $dbh->prepare("SELECT COUNT(*) FROM products WHERE slug = ?");
        $stmt->execute([$slug]);
        if ($stmt->fetchColumn() > 0) {
            $slug .= '-' . time();
        }

        // Handle Main Image Upload
        $main_image = '';
        if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../uploads/products/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            
            $ext = pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION);
            $main_image = 'main_' . md5(time() . $name) . '.' . $ext;
            move_uploaded_file($_FILES['main_image']['tmp_name'], $uploadDir . $main_image);
        }

        // Handle OG Image Upload
        $og_image = '';
        if (isset($_FILES['og_image']) && $_FILES['og_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../uploads/products/seo/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            
            $ext = pathinfo($_FILES['og_image']['name'], PATHINFO_EXTENSION);
            $og_image = 'og_' . md5(time() . $name) . '.' . $ext;
            move_uploaded_file($_FILES['og_image']['tmp_name'], $uploadDir . $og_image);
        }

        // Insert Product
        $sql = "INSERT INTO products (category_id, name, slug, description, main_image, seo_title, seo_description, seo_keywords, seo_schema, og_image) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$category_id, $name, $slug, $description, $main_image, $seo_title, $seo_description, $seo_keywords, $seo_schema, $og_image]);
        $product_id = $dbh->lastInsertId();

        // Handle Gallery Uploads
        if (!empty($_FILES['gallery']['name'][0])) {
            $uploadDir = __DIR__ . '/../uploads/products/gallery/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

            foreach ($_FILES['gallery']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['gallery']['error'][$key] === UPLOAD_ERR_OK) {
                    $ext = pathinfo($_FILES['gallery']['name'][$key], PATHINFO_EXTENSION);
                    $gallery_img = 'gal_' . md5(time() . $key . $name) . '.' . $ext;
                    if (move_uploaded_file($tmp_name, $uploadDir . $gallery_img)) {
                        $stmt = $dbh->prepare("INSERT INTO product_gallery (product_id, image_path) VALUES (?, ?)");
                        $stmt->execute([$product_id, $gallery_img]);
                    }
                }
            }
        }

        $dbh->commit();
        $successMsg = "Product added successfully!";
        // Redirect or clear post needed here in real apps, but let's keep it simple for now
    } catch (Exception $e) {
        $dbh->rollBack();
        $errorMsg = "Error: " . $e->getMessage();
    }
}

include __DIR__ . '/../header.php';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add New Product</h1>
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

        <form action="add-product.php" method="POST" enctype="multipart/form-data" id="productForm">
            <input type="hidden" name="action" value="add_product">
            <div class="row">
                <!-- Product Basic Info -->
                <div class="col-md-8">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Product Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="Enter product name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="summernote" name="description"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Section -->
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Product Gallery</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Upload Gallery Images (One by one or multiple)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gallery" name="gallery[]" multiple accept="image/*">
                                    <label class="custom-file-label" for="gallery">Choose images</label>
                                </div>
                            </div>
                            <div id="gallery-preview" class="row mt-3"></div>
                        </div>
                    </div>

                    <!-- SEO Section -->
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">SEO & Schema Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="seo_title">SEO Meta Title</label>
                                <input type="text" class="form-control" id="seo_title" name="seo_title" placeholder="Professional Title">
                            </div>
                            <div class="form-group">
                                <label for="seo_description">SEO Meta Description</label>
                                <textarea class="form-control" id="seo_description" name="seo_description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="seo_keywords">SEO Meta Keywords</label>
                                <input type="text" class="form-control" id="seo_keywords" name="seo_keywords" placeholder="keyword1, keyword2">
                            </div>
                            <div class="form-group">
                                <label for="seo_schema">JSON-LD Schema (Auto-gen & Editable)</label>
                                <textarea class="form-control" id="seo_schema" name="seo_schema" rows="5"></textarea>
                                <small class="text-muted">A professional product schema will be generated automatically based on the info above.</small>
                            </div>
                            <div class="form-group">
                                <label>SEO Featured / OG Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="og_image" name="og_image" accept="image/*">
                                    <label class="custom-file-label" for="og_image">Choose SEO Image</label>
                                </div>
                                <img id="og-preview" src="#" alt="OG Preview" style="display:none; margin-top:10px; max-height:150px;" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Settings -->
                <div class="col-md-4">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Basic Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" name="category_id" id="category_id" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Main Product Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="main_image" name="main_image" accept="image/*" required>
                                    <label class="custom-file-label" for="main_image">Choose Product Image</label>
                                </div>
                                <img id="main-preview" src="#" alt="Main Preview" style="display:none; margin-top:10px; width:100%;" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-lg btn-block"><b>Publish Product</b></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Include Summernote -->
<link rel="stylesheet" href="<?= BASE_URL ?>/vendor/summernote/summernote/dist/summernote-bs4.css">
<script src="<?= BASE_URL ?>/vendor/summernote/summernote/dist/summernote-bs4.min.js"></script>

<script>
$(function () {
    // Initialize Summernote
    $('#summernote').summernote({
        height: 300,
        placeholder: 'Write professional product description here...'
    });

    // Main Image Preview
    $("#main_image").change(function(){
        readURL(this, '#main-preview');
    });

    // OG Image Preview
    $("#og_image").change(function(){
        readURL(this, '#og-preview');
    });

    // Gallery Preview
    $("#gallery").change(function(){
        $('#gallery-preview').html('');
        if (this.files) {
            Array.from(this.files).forEach(file => {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#gallery-preview').append(`
                        <div class="col-sm-3 mb-2">
                            <img src="${e.target.result}" class="img-thumbnail" style="height:100px; width:100%; object-fit:cover;">
                        </div>
                    `);
                }
                reader.readAsDataURL(file);
            });
        }
    });

    function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(previewId).attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Auto-generate Schema Placeholder
    $('#name').on('input', function() {
        let name = $(this).val();
        let schema = {
            "@context": "https://schema.org/",
            "@type": "Product",
            "name": name,
            "description": $('#seo_description').val() || "Professional product from Vastu Mitra.",
            "brand": {
                "@type": "Brand",
                "name": "Vastu Mitra"
            }
        };
        $('#seo_schema').val(JSON.stringify(schema, null, 2));
    });

    // Update custom file label
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
});
</script>

<?php include __DIR__ . '/../footer.php'; ?>
