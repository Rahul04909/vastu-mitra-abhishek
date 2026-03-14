<?php
require_once __DIR__ . '/../auth_init.php';

$successMsg = '';
$errorMsg = '';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Fetch Product Data
try {
    $stmt = $dbh->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    if (!$product) {
        header("Location: index.php");
        exit;
    }

    // Fetch Gallery
    $stmt = $dbh->prepare("SELECT * FROM product_gallery WHERE product_id = ?");
    $stmt->execute([$id]);
    $gallery = $stmt->fetchAll();

} catch (PDOException $e) {
    $errorMsg = "Error: " . $e->getMessage();
}

// Fetch categories
$categories = $dbh->query("SELECT * FROM product_categories ORDER BY name ASC")->fetchAll();

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_product') {
    $name = trim($_POST['name'] ?? '');
    $category_id = $_POST['category_id'] ?? '';
    $description = $_POST['description'] ?? '';
    $seo_title = $_POST['seo_title'] ?? '';
    $seo_description = $_POST['seo_description'] ?? '';
    $seo_keywords = $_POST['seo_keywords'] ?? '';
    $seo_schema = $_POST['seo_schema'] ?? '';
    
    // Slugs are usually not updated unless explicitly asked, but let's keep it consistent
    // Or just keep the old slug. Let's keep the old one for SEO stability.
    $slug = $product['slug'];

    try {
        $dbh->beginTransaction();

        // Handle Main Image Update
        $main_image = $product['main_image'];
        if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../uploads/products/';
            
            // Delete old
            if ($main_image && file_exists($uploadDir . $main_image)) unlink($uploadDir . $main_image);
            
            $ext = pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION);
            $main_image = 'main_' . md5(time() . $name) . '.' . $ext;
            move_uploaded_file($_FILES['main_image']['tmp_name'], $uploadDir . $main_image);
        }

        // Handle OG Image Update
        $og_image = $product['og_image'];
        if (isset($_FILES['og_image']) && $_FILES['og_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../uploads/products/seo/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            
            // Delete old
            if ($og_image && file_exists($uploadDir . $og_image)) unlink($uploadDir . $og_image);

            $ext = pathinfo($_FILES['og_image']['name'], PATHINFO_EXTENSION);
            $og_image = 'og_' . md5(time() . $name) . '.' . $ext;
            move_uploaded_file($_FILES['og_image']['tmp_name'], $uploadDir . $og_image);
        }

        // Update Product
        $sql = "UPDATE products SET category_id = ?, name = ?, description = ?, main_image = ?, seo_title = ?, seo_description = ?, seo_keywords = ?, seo_schema = ?, og_image = ? 
                WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$category_id, $name, $description, $main_image, $seo_title, $seo_description, $seo_keywords, $seo_schema, $og_image, $id]);

        // Handle New Gallery Uploads
        if (!empty($_FILES['gallery']['name'][0])) {
            $uploadDir = __DIR__ . '/../uploads/products/gallery/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

            foreach ($_FILES['gallery']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['gallery']['error'][$key] === UPLOAD_ERR_OK) {
                    $ext = pathinfo($_FILES['gallery']['name'][$key], PATHINFO_EXTENSION);
                    $gallery_img = 'gal_' . md5(time() . $key . $name) . '.' . $ext;
                    if (move_uploaded_file($tmp_name, $uploadDir . $gallery_img)) {
                        $stmt = $dbh->prepare("INSERT INTO product_gallery (product_id, image_path) VALUES (?, ?)");
                        $stmt->execute([$id, $gallery_img]);
                    }
                }
            }
        }

        // Handle Gallery Image Deletions
        if (!empty($_POST['delete_gallery'])) {
            foreach ($_POST['delete_gallery'] as $galId) {
                $stmt = $dbh->prepare("SELECT image_path FROM product_gallery WHERE id = ?");
                $stmt->execute([$galId]);
                $galImg = $stmt->fetchColumn();
                if ($galImg) {
                    if (file_exists(__DIR__ . '/../uploads/products/gallery/' . $galImg)) {
                        unlink(__DIR__ . '/../uploads/products/gallery/' . $galImg);
                    }
                    $stmt = $dbh->prepare("DELETE FROM product_gallery WHERE id = ?");
                    $stmt->execute([$galId]);
                }
            }
        }

        $dbh->commit();
        $successMsg = "Product updated successfully!";
        
        // Refresh product data
        $stmt = $dbh->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        
        $stmt = $dbh->prepare("SELECT * FROM product_gallery WHERE product_id = ?");
        $stmt->execute([$id]);
        $gallery = $stmt->fetchAll();

    } catch (Exception $e) {
        $dbh->rollBack();
        $errorMsg = "Error: " . $e->getMessage();
    }
}

include __DIR__ . '/../header.php';
?>

<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Product: <?= htmlspecialchars($product['name']) ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
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

        <form action="edit-product.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit_product">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Product Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" required value="<?= htmlspecialchars($product['name']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="summernote" name="description"><?= htmlspecialchars($product['description']) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Section -->
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Product Gallery</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <?php foreach ($gallery as $gal): ?>
                                    <div class="col-sm-3 text-center mb-3">
                                        <img src="<?= ADMIN_URL ?>/../uploads/products/gallery/<?= htmlspecialchars($gal['image_path']) ?>" class="img-thumbnail mb-1" style="height:100px; width:100%; object-fit:cover;">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="del_<?= $gal['id'] ?>" name="delete_gallery[]" value="<?= $gal['id'] ?>">
                                            <label for="del_<?= $gal['id'] ?>" class="custom-control-label text-danger">Delete</label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Upload More Gallery Images</label>
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
                                <input type="text" class="form-control" id="seo_title" name="seo_title" value="<?= htmlspecialchars($product['seo_title']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="seo_description">SEO Meta Description</label>
                                <textarea class="form-control" id="seo_description" name="seo_description" rows="3"><?= htmlspecialchars($product['seo_description']) ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="seo_keywords">SEO Meta Keywords</label>
                                <input type="text" class="form-control" id="seo_keywords" name="seo_keywords" value="<?= htmlspecialchars($product['seo_keywords']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="seo_schema">JSON-LD Schema</label>
                                <textarea class="form-control" id="seo_schema" name="seo_schema" rows="5"><?= htmlspecialchars($product['seo_schema']) ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>SEO Featured / OG Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="og_image" name="og_image" accept="image/*">
                                    <label class="custom-file-label" for="og_image">Change SEO Image</label>
                                </div>
                                <?php if ($product['og_image']): ?>
                                    <img src="<?= ADMIN_URL ?>/../uploads/products/seo/<?= $product['og_image'] ?>" style="margin-top:10px; max-height:150px;" class="img-thumbnail d-block">
                                <?php endif; ?>
                                <img id="og-preview" src="#" alt="OG Preview" style="display:none; margin-top:10px; max-height:150px;" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" name="category_id" id="category_id" required>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= ($product['category_id'] == $cat['id']) ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Main Product Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="main_image" name="main_image" accept="image/*">
                                    <label class="custom-file-label" for="main_image">Change Image</label>
                                </div>
                                <div class="mt-2">
                                    <p class="mb-1">Current Image:</p>
                                    <img src="<?= ADMIN_URL ?>/../uploads/products/<?= $product['main_image'] ?>" style="width:100%;" class="img-thumbnail" id="current_main">
                                </div>
                                <img id="main-preview" src="#" alt="Main Preview" style="display:none; margin-top:10px; width:100%;" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-lg btn-block"><b>Save Changes</b></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Include Summernote -->
<link rel="stylesheet" href="<?= ADMIN_URL ?>/../vendor/summernote/summernote-bs4.min.css">
<script src="<?= ADMIN_URL ?>/../vendor/summernote/summernote-bs4.min.js"></script>

<script>
$(function () {
    $('#summernote').summernote({ height: 300 });

    $("#main_image").change(function(){
        readURL(this, '#main-preview');
        $('#current_main').hide();
    });

    $("#og_image").change(function(){
        readURL(this, '#og-preview');
    });

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

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
});
</script>

<?php include __DIR__ . '/../footer.php'; ?>
