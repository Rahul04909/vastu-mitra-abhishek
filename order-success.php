<?php
require_once __DIR__ . '/database/db_config.php';

$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
$token    = isset($_GET['token']) ? trim($_GET['token']) : '';

if (!$order_id) {
    header("Location: shop.php");
    exit;
}

try {
    $stmt = $dbh->prepare("SELECT * FROM `shop_orders` WHERE `id` = ?");
    $stmt->execute([$order_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        header("Location: shop.php");
        exit;
    }

    // Security check: Verify token or session
    $expectedToken = md5($order['order_number'] . RAZORPAY_KEY_SECRET);
    $sessionMatched = isset($_SESSION['last_paid_order_id']) && (int)$_SESSION['last_paid_order_id'] === $order_id;

    if ($token !== $expectedToken && !$sessionMatched) {
        // Disallow arbitrary browsing of orders
        header("Location: shop.php");
        exit;
    }

    // Fetch order items
    $stmtItems = $dbh->prepare("SELECT * FROM `shop_order_items` WHERE `order_id` = ?");
    $stmtItems->execute([$order_id]);
    $items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    die("Error loading order details: " . $e->getMessage());
}

$page_title = "Order Confirmed - #" . $order['order_number'] . " | Vastu Mitra Abhishek";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="icon" href="<?= BASE_URL ?>/favicon.png" type="image/x-icon">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/footer.css">
    
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #1a1a40;
            --gold: #D4A843;
            --gold-dark: #A8822F;
            --success: #28a745;
            --bg-light: #f8f9fa;
            --card-border: rgba(212, 168, 67, 0.2);
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Outfit', sans-serif;
            color: #2c3e50;
        }

        .success-page-container {
            max-width: 850px;
            margin: 120px auto 60px;
            padding: 0 20px;
        }

        .success-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--card-border);
            overflow: hidden;
        }

        .success-header {
            background: linear-gradient(135deg, #1a1a40 0%, #29244c 100%);
            color: #ffffff;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .check-icon-wrapper {
            width: 76px;
            height: 76px;
            background: rgba(40, 167, 69, 0.15);
            border: 2px solid #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            color: #28a745;
            font-size: 2.2rem;
            animation: pulse-ring 2s infinite ease-in-out;
        }

        @keyframes pulse-ring {
            0% { transform: scale(0.96); box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.4); }
            70% { transform: scale(1); box-shadow: 0 0 0 16px rgba(40, 167, 69, 0); }
            100% { transform: scale(0.96); box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
        }

        .success-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            margin-bottom: 8px;
            color: #ffffff;
        }

        .success-header p {
            color: #e0e0e0;
            font-size: 1.05rem;
            max-width: 580px;
            margin: 0 auto;
        }

        .order-meta-bar {
            background: #faf7f0;
            padding: 18px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .meta-group {
            display: flex;
            flex-direction: column;
        }

        .meta-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #7f8c8d;
            font-weight: 600;
        }

        .meta-val {
            font-weight: 700;
            color: var(--primary);
            font-size: 1rem;
        }

        .badge-payment {
            background: #28a745;
            color: #fff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .success-body {
            padding: 35px 30px;
        }

        .section-heading {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            border-bottom: 2px solid var(--gold);
            padding-bottom: 8px;
            display: inline-block;
        }

        /* Items list */
        .order-item-row {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
            gap: 20px;
        }

        .item-thumb {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #eee;
            background: #fafafa;
        }

        .item-info {
            flex-grow: 1;
        }

        .item-name {
            font-weight: 600;
            font-size: 1.05rem;
            margin-bottom: 4px;
            color: #2c3e50;
        }

        .item-pricing {
            font-size: 0.9rem;
            color: #666;
        }

        .item-total {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1rem;
        }

        /* Calculation Summary */
        .summary-totals {
            margin-top: 25px;
            background: #fdfaf4;
            padding: 20px 25px;
            border-radius: 12px;
            border: 1px dashed var(--gold);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .summary-row.grand-total {
            border-top: 1px solid rgba(212, 168, 67, 0.3);
            margin-top: 12px;
            padding-top: 12px;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--primary);
        }

        /* Customer & Shipping Details Grid */
        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-top: 35px;
        }

        .info-box {
            background: #fdfdfd;
            border: 1px solid #f0f0f0;
            padding: 20px;
            border-radius: 12px;
        }

        .info-box h4 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-box h4 i {
            color: var(--gold);
        }

        .info-box p {
            margin-bottom: 6px;
            font-size: 0.95rem;
            line-height: 1.6;
            color: #555;
        }

        /* Action Buttons */
        .action-bar {
            margin-top: 40px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .btn-action {
            padding: 14px 28px;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
        }

        .btn-primary-action {
            background: var(--gold);
            color: #1a1a40;
        }

        .btn-primary-action:hover {
            background: #e5b954;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(212, 168, 67, 0.3);
        }

        .btn-outline-action {
            background: #fff;
            border: 1px solid #ccc;
            color: #333;
        }

        .btn-outline-action:hover {
            border-color: #999;
            background: #f8f8f8;
        }

        .btn-whatsapp-action {
            background: #25d366;
            color: #fff;
        }

        .btn-whatsapp-action:hover {
            background: #20b859;
            color: #fff;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .details-grid {
                grid-template-columns: 1fr;
            }
            .order-meta-bar {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media print {
            header, footer, .action-bar {
                display: none !important;
            }
            .success-page-container {
                margin: 0 !important;
                max-width: 100% !important;
            }
            .success-card {
                box-shadow: none !important;
                border: 1px solid #ccc !important;
            }
        }
    </style>
</head>
<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="success-page-container">
        <div class="success-card">
            <!-- Header Banner -->
            <div class="success-header">
                <div class="check-icon-wrapper">
                    <i class="fas fa-check"></i>
                </div>
                <h1>Order Confirmed!</h1>
                <p>Thank you for choosing Vastu Mitra Abhishek. Your sacred order has been recorded and will be consecrated as per Vedic rituals before dispatch.</p>
            </div>

            <!-- Meta Details Bar -->
            <div class="order-meta-bar">
                <div class="meta-group">
                    <span class="meta-label">Order Number</span>
                    <span class="meta-val"><?= htmlspecialchars($order['order_number']) ?></span>
                </div>
                <div class="meta-group">
                    <span class="meta-label">Date & Time</span>
                    <span class="meta-val"><?= date('d M Y, h:i A', strtotime($order['created_at'])) ?></span>
                </div>
                <div class="meta-group">
                    <span class="meta-label">Payment Status</span>
                    <span class="badge-payment"><i class="fas fa-shield-alt"></i> Paid (Razorpay)</span>
                </div>
                <div class="meta-group">
                    <span class="meta-label">Payment Ref ID</span>
                    <span class="meta-val small text-muted"><?= htmlspecialchars($order['razorpay_payment_id'] ?: 'Online Verified') ?></span>
                </div>
            </div>

            <!-- Body Details -->
            <div class="success-body">
                <h3 class="section-heading">Items Ordered</h3>
                
                <div class="order-items-container">
                    <?php foreach ($items as $item): ?>
                        <div class="order-item-row">
                            <img src="<?= !empty($item['product_image']) ? 'admin/uploads/products/' . htmlspecialchars($item['product_image']) : 'assets/logo/logo.png' ?>" 
                                 alt="<?= htmlspecialchars($item['product_name']) ?>" 
                                 class="item-thumb" 
                                 onerror="this.src='assets/logo/logo.png'">
                            
                            <div class="item-info">
                                <h4 class="item-name"><?= htmlspecialchars($item['product_name']) ?></h4>
                                <div class="item-pricing">
                                    ₹<?= number_format((float)$item['price'], 2) ?> × <?= (int)$item['quantity'] ?>
                                </div>
                            </div>
                            
                            <div class="item-total">
                                ₹<?= number_format((float)$item['total'], 2) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Summary Totals -->
                <div class="summary-totals">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>₹<?= number_format((float)$order['subtotal'], 2) ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping & Delivery (All India)</span>
                        <span class="text-success font-weight-bold">FREE</span>
                    </div>
                    <div class="summary-row grand-total">
                        <span>Total Paid</span>
                        <span>₹<?= number_format((float)$order['total_amount'], 2) ?></span>
                    </div>
                </div>

                <!-- Details Grid -->
                <div class="details-grid">
                    <div class="info-box">
                        <h4><i class="fas fa-map-marker-alt"></i> Delivery Address</h4>
                        <p><strong><?= htmlspecialchars($order['customer_name']) ?></strong></p>
                        <p><?= nl2br(htmlspecialchars($order['address'])) ?></p>
                        <p><?= htmlspecialchars($order['city']) ?>, <?= htmlspecialchars($order['state']) ?> - <?= htmlspecialchars($order['pincode']) ?></p>
                        <p><i class="fas fa-phone mr-1"></i> <?= htmlspecialchars($order['mobile']) ?></p>
                        <p><i class="fas fa-envelope mr-1"></i> <?= htmlspecialchars($order['email']) ?></p>
                    </div>

                    <div class="info-box">
                        <h4><i class="fas fa-info-circle"></i> What Happens Next?</h4>
                        <p><i class="fas fa-check-circle text-success mr-1"></i> Order verification & consecration process begins.</p>
                        <p><i class="fas fa-truck text-info mr-1"></i> Dispatched via express courier within 2-4 business days.</p>
                        <p><i class="fas fa-bell text-warning mr-1"></i> Tracking link sent directly to your WhatsApp and Email.</p>
                        <?php if (!empty($order['notes'])): ?>
                            <p class="mt-2 text-muted small"><strong>Your Notes:</strong> <?= htmlspecialchars($order['notes']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-bar">
                    <a href="shop.php" class="btn-action btn-primary-action">
                        <i class="fas fa-store"></i> Continue Shopping
                    </a>
                    
                    <button onclick="window.print()" class="btn-action btn-outline-action">
                        <i class="fas fa-print"></i> Print Receipt
                    </button>
                    
                    <a href="https://wa.me/919971799858?text=<?= urlencode('Hello Vastu Mitra Abhishek, I have a query regarding my Order #' . $order['order_number']) ?>" 
                       target="_blank" 
                       class="btn-action btn-whatsapp-action">
                        <i class="fab fa-whatsapp"></i> WhatsApp Support
                    </a>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>
</body>
</html>
