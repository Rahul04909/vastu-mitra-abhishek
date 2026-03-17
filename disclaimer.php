<?php
require_once __DIR__ . '/database/db_config.php';

$page_title = "Disclaimer - Vastu Mitra Abhishek";
$meta_desc = "Important medical and professional disclaimer regarding Vastu Shastra services provided by Vastu Mitra Abhishek.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <meta name="description" content="<?= $meta_desc ?>">
    <link rel="icon" href="<?= BASE_URL ?>/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/legal-pages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <section class="legal-hero">
        <div class="container">
            <h1>Disclaimer</h1>
        </div>
    </section>

    <section class="legal-content-section">
        <div class="container">
            <div class="legal-card">
                <div class="legal-body">
                    <h2>Professional Disclaimer</h2>
                    <p>Vastu Shastra is an ancient Indian science that provides guidance on balancing energies in your environment. The information provided by Vastu Mitra Abhishek on this website and during consultations is for general informational purposes only.</p>
                    
                    <p>All Vastu suggestions and remedies are based on the individual's specific property analysis and traditional principles. They are intended as <strong>supplementary guidance</strong> and should not be treated as a substitute for professional legal, financial, or medical advice.</p>

                    <h2>No Guarantees</h2>
                    <p>While most of our clients experience significant positive changes, results can vary from person to person depending on multiple factors beyond our control, including personal karma and the accuracy of implementing the suggested remedies. We make no guarantees of absolute results.</p>

                    <h2>Health Disclaimer</h2>
                    <p>Consultations regarding health through Vastu are energetic in nature. They should never be used as a replacement for medical diagnosis, treatment, or advice from a qualified healthcare professional.</p>

                    <h2>External Links</h2>
                    <p>This website may contain links to external sites that are not provided or maintained by or in any way affiliated with Vastu Mitra Abhishek. Please note that we do not guarantee the accuracy, relevance, timeliness, or completeness of any information on these external websites.</p>

                    <div class="last-updated">Last Updated: March 17, 2026</div>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
</body>
</html>
