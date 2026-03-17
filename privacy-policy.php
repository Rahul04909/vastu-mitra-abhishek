<?php
require_once __DIR__ . '/database/db_config.php';

$page_title = "Privacy Policy - Vastu Mitra Abhishek";
$meta_desc = "Our Privacy Policy outlines how we collect, use, and protect your personal information at Vastu Mitra Abhishek.";
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
            <h1>Privacy Policy</h1>
        </div>
    </section>

    <section class="legal-content-section">
        <div class="container">
            <div class="legal-card">
                <div class="legal-body">
                    <p>At Vastu Mitra Abhishek, accessible from vastumitraabhishek.in, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Vastu Mitra Abhishek and how we use it.</p>

                    <h2>Information We Collect</h2>
                    <p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
                    <ul>
                        <li><strong>Contact Data:</strong> Name, email address, phone number when you fill out a form.</li>
                        <li><strong>Inquiry Data:</strong> Information regarding your Vastu requirements or property details provided for consultation.</li>
                        <li><strong>Usage Data:</strong> Information about how you use our website, products, and services.</li>
                    </ul>

                    <h2>How We Use Your Information</h2>
                    <p>We use the information we collect in various ways, including to:</p>
                    <ul>
                        <li>Provide, operate, and maintain our website.</li>
                        <li>Improve, personalize, and expand our website.</li>
                        <li>Understand and analyze how you use our website.</li>
                        <li>Develop new products, services, features, and functionality.</li>
                        <li>Communicate with you for customer service and Vastu consultation.</li>
                    </ul>

                    <h2>Data Protection</h2>
                    <p>We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</p>

                    <h2>Contact Us</h2>
                    <p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us at <strong>info@vastumitraabhishek.in</strong>.</p>

                    <div class="last-updated">Last Updated: March 17, 2026</div>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
</body>
</html>
