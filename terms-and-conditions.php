<?php
require_once __DIR__ . '/database/db_config.php';

$page_title = "Terms and Condition - Vastu Mitra Abhishek";
$meta_desc = "Read the terms and conditions for using services and purchasing products from Vastu Mitra Abhishek.";
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
            <h1>Terms and Condition</h1>
        </div>
    </section>

    <section class="legal-content-section">
        <div class="container">
            <div class="legal-card">
                <div class="legal-body">
                    <h2>Welcome to Vastu Mitra</h2>
                    <p>By accessing this website and utilizing our services, you accept these terms and conditions in full. Do not continue to use Vastu Mitra Abhishek's website if you do not accept all of the terms and conditions stated on this page.</p>

                    <h2>Service Usage</h2>
                    <p>Our Vastu consultations are intended to provide guidance based on the ancient science of Vastu Shastra. While we strive for accuracy and positive results, Vastu is a supplementary science and should not replace professional medical, legal, or financial advice.</p>
                    <ul>
                        <li>Clients must provide accurate property details for effective analysis.</li>
                        <li>Implementation of suggested remedies is at the client's discretion.</li>
                    </ul>

                    <h2>Intellectual Property</h2>
                    <p>Unless otherwise stated, Vastu Mitra Abhishek owns the intellectual property rights for all material on the website. All intellectual property rights are reserved.</p>

                    <h2>Payment Terms</h2>
                    <p>Full payment is required prior to the commencement of any professional consultation or the shipment of any Vastu products. All prices are inclusive of applicable taxes unless stated otherwise.</p>

                    <h2>Governing Law</h2>
                    <p>Any claim relating to Vastu Mitra Abhishek's website shall be governed by the laws of India without regard to its conflict of law provisions.</p>

                    <div class="last-updated">Last Updated: March 17, 2026</div>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
</body>
</html>
