<?php
require_once __DIR__ . '/../auth_init.php';

$successMsg = '';
$errorMsg = '';

// Fetch Categories for dropdown
try {
    $categories = $dbh->query("SELECT * FROM blog_categories ORDER BY name ASC")->fetchAll();
} catch (PDOException $e) {
    $categories = [];
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
    
    // Slug generation
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));

    // Handle Main Image Upload
    $featured_image = '';
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === 0) {
        $uploadDir = __DIR__ . '/../uploads/blogs/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        
        $ext = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
        $featured_image = time() . '_blog.' . $ext;
        move_uploaded_file($_FILES['featured_image']['tmp_name'], $uploadDir . $featured_image);
    }

    // Handle OG Image Upload
    $og_image = '';
    if (isset($_FILES['og_image']) && $_FILES['og_image']['error'] === 0) {
        $uploadDir = __DIR__ . '/../uploads/blogs/seo/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        
        $ext = pathinfo($_FILES['og_image']['name'], PATHINFO_EXTENSION);
        $og_image = time() . '_og_blog.' . $ext;
        move_uploaded_file($_FILES['og_image']['tmp_name'], $uploadDir . $og_image);
    }

    if (empty($title) || empty($featured_image) || empty($category_id)) {
        $errorMsg = "Title, Category, and Featured Image are required.";
    } else {
        try {
            $sql = "INSERT INTO blogs (category_id, title, slug, description, featured_image, seo_title, seo_desc, seo_keywords, seo_schema, og_image, status) 
                    VALUES (:cat_id, :title, :slug, :desc, :img, :s_title, :s_desc, :s_key, :s_schema, :og, :status)";
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
                ':status' => $status
            ]);
            $successMsg = "Blog post added successfully!";
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
                <h1>Add New Blog</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <?php if ($successMsg): ?>
            <div class="alert alert-success"><?= $successMsg ?> <a href="index.php">View List</a></div>
        <?php endif; ?>
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger"><?= $errorMsg ?></div>
        <?php endif; ?>

        <form action="add-blog.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <!-- Main Info -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Blog Title</label>
                                <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter title here" required>
                            </div>
                            <div class="form-group mb-0">
                                <label for="description">Content</label>
                                <textarea name="description" id="summernote" required></textarea>
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
                                <input type="text" name="seo_title" id="seo_title" class="form-control" placeholder="Browser tab title">
                            </div>
                            <div class="form-group">
                                <label>SEO Meta Description</label>
                                <textarea name="seo_desc" class="form-control" rows="3" placeholder="Summary for search engines"></textarea>
                            </div>
                            <div class="form-group">
                                <label>SEO Meta Keywords</label>
                                <input type="text" name="seo_keywords" class="form-control" placeholder="keyword1, keyword2...">
                            </div>
                            <div class="form-group">
                                <label>Article Schema (JSON-LD)</label>
                                <textarea name="seo_schema" id="seo_schema" class="form-control" rows="5" placeholder='{"@context": "https://schema.org", "@type": "Article", ...}'></textarea>
                                <small class="text-info mt-1 d-block"><i class="fas fa-magic"></i> Auto-generates from title as you type, but you can edit.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Actions -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Publish</h3>
                        </div>
                        <div class="card-body text-sm">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-block mt-4" style="background-color: #28a645; border-color: #28a645;">
                                <i class="fas fa-save mr-1"></i> Save Blog
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
                                <img id="featuredPreview" src="<?= ADMIN_URL ?>/src/images/placeholder.png" class="img-fluid rounded border" style="max-height: 200px; width: 100%; object-fit: cover;">
                            </div>
                            <div class="custom-file">
                                <input type="file" name="featured_image" class="custom-file-input" id="featured_image" accept="image/*" onchange="previewImage(this, 'featuredPreview')" required>
                                <label class="custom-file-label" for="featured_image">Choose image</label>
                            </div>
                        </div>
                    </div>

                    <!-- Open Graph Information -->
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-white">
                            <h3 class="card-title">Open Graph Info</h3>
                        </div>
                        <div class="card-body">
                            <label class="text-muted d-block mb-2 small">Image for social sharing</label>
                            <div id="ogPreviewContainer" class="mb-3 text-center d-none">
                                <img id="ogPreview" src="#" class="img-fluid rounded border shadow-sm" style="max-height: 150px;">
                            </div>
                            <div class="custom-file">
                                <input type="file" name="og_image" class="custom-file-input" id="og_image" accept="image/*" onchange="previewImage(this, 'ogPreview', 'ogPreviewContainer')">
                                <label class="custom-file-label text-truncate" for="og_image">Upload OG Image</label>
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

    // Auto-generate Slug & Schema from Title
    $('#title').on('input', function() {
        var title = $(this).val();
        var slug = title.toLowerCase().trim().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, '');
        $('#seo_title').val(title);
        
        // Dynamic Schema Update
        var schema = {
            "@context": "https://schema.org",
            "@type": "BlogPosting",
            "headline": title,
            "datePublished": new Date().toISOString().split('T')[0],
            "author": {
                "@type": "Person",
                "name": "Admin"
            }
        };
        $('#seo_schema').val(JSON.stringify(schema, null, 2));
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
