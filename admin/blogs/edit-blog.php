<?php
require_once __DIR__ . '/../auth_init.php';

$successMsg = '';
$errorMsg = '';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Fetch Blog Data
try {
    $stmt = $dbh->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    $blog = $stmt->fetch();
    
    if (!$blog) {
        header("Location: index.php");
        exit;
    }

    $categories = $dbh->query("SELECT * FROM blog_categories ORDER BY name ASC")->fetchAll();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $category_id = (int)($_POST['category_id'] ?? 0);
    $description = $_POST['description'] ?? '';
    $status = $_POST['status'] ?? 'published';
    
    $seo_title = trim($_POST['seo_title'] ?? '');
    $seo_desc = trim($_POST['seo_desc'] ?? '');
    $seo_keywords = trim($_POST['seo_keywords'] ?? '');
    $seo_schema = $_POST['seo_schema'] ?? '';
    
    // Slug generation (if title changed)
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));

    // Handle Main Image Update
    $featured_image = $blog['featured_image'];
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === 0) {
        $uploadDir = __DIR__ . '/../uploads/blogs/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        
        // Remove old image
        if (file_exists($uploadDir . $featured_image)) {
            unlink($uploadDir . $featured_image);
        }
        
        $ext = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
        $featured_image = time() . '_blog.' . $ext;
        move_uploaded_file($_FILES['featured_image']['tmp_name'], $uploadDir . $featured_image);
    }

    // Handle OG Image Update
    $og_image = $blog['og_image'];
    if (isset($_FILES['og_image']) && $_FILES['og_image']['error'] === 0) {
        $uploadDir = __DIR__ . '/../uploads/blogs/seo/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        
        // Remove old og image
        if ($og_image && file_exists($uploadDir . $og_image)) {
            unlink($uploadDir . $og_image);
        }
        
        $ext = pathinfo($_FILES['og_image']['name'], PATHINFO_EXTENSION);
        $og_image = time() . '_og_blog.' . $ext;
        move_uploaded_file($_FILES['og_image']['tmp_name'], $uploadDir . $og_image);
    }

    if (empty($title) || empty($category_id)) {
        $errorMsg = "Title and Category are required.";
    } else {
        try {
            $sql = "UPDATE blogs SET 
                    category_id = :cat_id, 
                    title = :title, 
                    slug = :slug, 
                    description = :desc, 
                    featured_image = :img, 
                    seo_title = :s_title, 
                    seo_desc = :s_desc, 
                    seo_keywords = :s_key, 
                    seo_schema = :s_schema, 
                    og_image = :og, 
                    status = :status 
                    WHERE id = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ':cat_id' => $category_id,
                ':title' => $title,
                ':slug' => $slug,
                ':desc' => $description,
                ':img' => $featured_image,
                ':s_title' => $seo_title,
                ':s_desc' => $seo_desc,
                ':s_key' => $seo_keywords,
                ':s_schema' => $seo_schema,
                ':og' => $og_image,
                ':status' => $status,
                ':id' => $id
            ]);
            $successMsg = "Blog post updated successfully!";
            
            // Refresh blog data
            $stmt = $dbh->prepare("SELECT * FROM blogs WHERE id = ?");
            $stmt->execute([$id]);
            $blog = $stmt->fetch();
        } catch (PDOException $e) {
            $errorMsg = "Database error: " . $e->getMessage();
        }
    }
}

include __DIR__ . '/../header.php';
?>

<!-- Summernote & Scripts -->
<link rel="stylesheet" href="<?= BASE_URL ?>/vendor/summernote/summernote/dist/summernote-bs4.css">
<script src="<?= BASE_URL ?>/vendor/summernote/summernote/dist/summernote-bs4.min.js"></script>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Blog</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Back to List</a>
            </div>
        </div>
    </div>
</div>

<section class="content text-sm">
    <div class="container-fluid">
        <?php if ($successMsg): ?>
            <div class="alert alert-success"><?= $successMsg ?></div>
        <?php endif; ?>
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger"><?= $errorMsg ?></div>
        <?php endif; ?>

        <form action="edit-blog.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <!-- Main Info -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Blog Title</label>
                                <input type="text" name="title" id="title" class="form-control form-control-lg" value="<?= htmlspecialchars($blog['title']) ?>" required>
                            </div>
                            <div class="form-group mb-0">
                                <label for="description">Content</label>
                                <textarea name="description" id="summernote" required><?= $blog['description'] ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Section -->
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-white">
                            <h3 class="card-title text-primary"><i class="fas fa-search mr-2"></i> SEO Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>SEO Meta Title</label>
                                <input type="text" name="seo_title" id="seo_title" class="form-control" value="<?= htmlspecialchars($blog['seo_title']) ?>">
                            </div>
                            <div class="form-group">
                                <label>SEO Meta Description</label>
                                <textarea name="seo_desc" class="form-control" rows="3"><?= htmlspecialchars($blog['seo_desc']) ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>SEO Meta Keywords</label>
                                <input type="text" name="seo_keywords" class="form-control" value="<?= htmlspecialchars($blog['seo_keywords']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Article Schema (JSON-LD)</label>
                                <textarea name="seo_schema" id="seo_schema" class="form-control" rows="5"><?= $blog['seo_schema'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Actions -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Update Post</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $blog['category_id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="published" <?= $blog['status'] == 'published' ? 'selected' : '' ?>>Published</option>
                                    <option value="draft" <?= $blog['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-block mt-4" style="background-color: #28a645; border-color: #28a645;">
                                <i class="fas fa-sync-alt mr-1"></i> Update Blog
                            </button>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-white">
                            <h3 class="card-title">Featured Image</h3>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img id="featuredPreview" src="<?= BASE_URL ?>/admin/uploads/blogs/<?= $blog['featured_image'] ?>" class="img-fluid rounded border" style="max-height: 200px; width: 100%; object-fit: cover;">
                            </div>
                            <div class="custom-file">
                                <input type="file" name="featured_image" class="custom-file-input" id="featured_image" accept="image/*" onchange="previewImage(this, 'featuredPreview')">
                                <label class="custom-file-label text-truncate" for="featured_image">Change image</label>
                            </div>
                        </div>
                    </div>

                    <!-- Open Graph Information -->
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-white">
                            <h3 class="card-title">Open Graph Info</h3>
                        </div>
                        <div class="card-body">
                            <div id="ogPreviewContainer" class="mb-3 text-center <?= $blog['og_image'] ? '' : 'd-none' ?>">
                                <img id="ogPreview" src="<?= $blog['og_image'] ? BASE_URL . '/admin/uploads/blogs/seo/' . $blog['og_image'] : '#' ?>" class="img-fluid rounded border shadow-sm" style="max-height: 150px;">
                            </div>
                            <div class="custom-file">
                                <input type="file" name="og_image" class="custom-file-input" id="og_image" accept="image/*" onchange="previewImage(this, 'ogPreview', 'ogPreviewContainer')">
                                <label class="custom-file-label text-truncate" for="og_image"><?= $blog['og_image'] ? 'Change OG Image' : 'Upload OG Image' ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
$(document).ready(function() {
    $('#summernote').summernote({
        height: 400,
        placeholder: 'Write your blog content here...',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['link', 'picture', 'video', 'table']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});

function previewImage(input, previewId, containerId = null) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#' + previewId).attr('src', e.target.result);
            if(containerId) $('#' + containerId).removeClass('d-none');
        }
        reader.readAsDataURL(input.files[0]);
        $(input).next('.custom-file-label').html(input.files[0].name);
    }
}
</script>

<?php include __DIR__ . '/../footer.php'; ?>
