<?php
require_once __DIR__ . '/database/db_config.php';

$page_title = "Refund Policy - Vastu Mitra Abhishek";
$meta_desc = "Read our refund and cancellation policy for Vastu consultation services and products at Vastu Mitra Abhishek.";
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
            <h1>Refund Policy</h1>
        </div>
    </section>

    <section class="legal-content-section">
        <div class="container">
            <div class="legal-card">
                <div class="legal-body">
                    <h2>Consultation Services</h2>
                    <p>Our Vastu consultation services involve intellectual work and time commitment. Once a consultation has been conducted and technical reports have been shared, no refunds will be issued.</p>
                    <ul>
                        <li><strong>Cancellations:</strong> If you cancel a booking at least 48 hours before the scheduled session, a full refund (minus any processing fees) will be provided.</li>
                        <li><strong>Rescheduling:</strong> You may reschedule your session up to 24 hours in advance without any extra charge.</li>
                    </ul>

                    <h2>Product Returns (Shop)</h2>
                    <p>For Vastu products purchased through our shop:</p>
                    <ul>
                        <li><strong>Damaged Goods:</strong> If you receive a damaged product, please contact us within 24 hours of delivery with photographic evidence. We will arrange a replacement or refund.</li>
                        <li><strong>Change of Mind:</strong> Due to the energetic nature of Vastu remedies, we generally do not accept returns for "change of mind" once the product has been shipped.</li>
                    </ul>

                    <h2>Refund Processing</h2>
                    <p>Approved refunds will be processed via the original payment method within 7-10 working days.</p>

                    <h2>Contact Support</h2>
                    <p>For any refund-related queries, please reach out to us at <strong>vastumabhishek@gmail.com</strong>.</p>

                    <div class="last-updated">Last Updated: March 17, 2026</div>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
</body>
</html>
