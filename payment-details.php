<?php
require_once __DIR__ . '/database/db_config.php';

$page_title = "Payment Details - Vastu Mitra Abhishek";
$meta_desc = "View payment methods and secure payment information for Vastu Mitra Abhishek services and products.";
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
            <h1>Payment Details</h1>
        </div>
    </section>

    <section class="legal-content-section">
        <div class="container">
            <div class="legal-card">
                <div class="legal-body">
                    <h2>Secure Payment Methods</h2>
                    <p>We accept various secure payment methods to ensure a smooth experience for our clients. You can choose from the following options:</p>
                    
                    <ul>
                        <li><strong>Online Transfer (NEFT/IMPS):</strong> Direct bank transfers are preferred for professional consultations.</li>
                        <li><strong>UPI:</strong> Pay securely using any UPI app (Google Pay, PhonePe, Paytm).</li>
                        <li><strong>Debit/Credit Cards:</strong> Secure online payments via our integrated payment gateway.</li>
                    </ul>

                    <h2>Bank Details for Transfer</h2>
                    <p>For direct bank transfers, please use the following details:</p>
                    <div style="background: white; padding: 25px; border-radius: 15px; border: 1px dashed var(--legal-secondary); margin-bottom: 30px;">
                        <p><strong>Account Name:</strong> Vastu Mitra Abhishek</p>
                        <p><strong>Bank Name:</strong> [Your Bank Name Here]</p>
                        <p><strong>Account Number:</strong> [Your Account Number Here]</p>
                        <p><strong>IFSC Code:</strong> [Your IFSC Code Here]</p>
                        <p><strong>Account Type:</strong> Current/Savings</p>
                    </div>

                    <h2>Confirmation</h2>
                    <p>Once the payment is made, please share a screenshot of the transaction on WhatsApp (+91-9971799858) or email us at <strong>info@vastumitraabhishek.in</strong> along with your name and order ID for quick processing.</p>

                    <div class="last-updated">Last Updated: March 17, 2026</div>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
</body>
</html>
