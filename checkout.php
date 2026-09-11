<?php
require_once __DIR__ . '/database/db_config.php';
require_once __DIR__ . '/includes/cart_functions.php';

$buy_now_id  = isset($_GET['buy_now']) ? (int)$_GET['buy_now'] : 0;
$buy_now_qty = isset($_GET['qty']) ? max(1, (int)$_GET['qty']) : 1;

$checkout_items = [];
$subtotal = 0.00;

if ($buy_now_id > 0) {
    // Direct "Buy Now" flow
    try {
        $stmt = $dbh->prepare("SELECT id, name, slug, price, sale_price, stock_status, main_image FROM products WHERE id = ?");
        $stmt->execute([$buy_now_id]);
        $prod = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($prod) {
            $price = ($prod['sale_price'] !== null && (float)$prod['sale_price'] > 0 && (float)$prod['sale_price'] < (float)$prod['price'])
                ? (float)$prod['sale_price']
                : (float)$prod['price'];

            $lineTotal = $price * $buy_now_qty;
            $subtotal += $lineTotal;

            $checkout_items[] = [
                'product_id' => $prod['id'],
                'name' => $prod['name'],
                'slug' => $prod['slug'],
                'main_image' => $prod['main_image'],
                'price' => $price,
                'quantity' => $buy_now_qty,
                'line_total' => $lineTotal
            ];
        }
    } catch (Exception $e) {
        // Fallback to cart
    }
}

if (empty($checkout_items)) {
    // Normal Cart Flow
    $cart = get_cart($dbh);
    $checkout_items = $cart['items'];
    $subtotal = $cart['subtotal'];
}

if (empty($checkout_items)) {
    header("Location: cart.php");
    exit;
}

$shipping_fee = 0.00; // Free delivery
$total_amount = $subtotal + $shipping_fee;

$page_title = "Secure Checkout - Vastu Mitra Abhishek";
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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/checkout.css">
    
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="checkout-page-wrapper">
        <div class="checkout-heading">
            <h1>Secure Vedic Checkout</h1>
            <p>Please enter your delivery details. Your consecrated items will be safely delivered to your doorstep.</p>
        </div>

        <form id="checkoutForm" novalidate>
            <?php if ($buy_now_id > 0): ?>
                <input type="hidden" name="buy_now_product_id" value="<?= $buy_now_id ?>">
                <input type="hidden" name="buy_now_qty" value="<?= $buy_now_qty ?>">
            <?php endif; ?>

            <div class="checkout-grid">
                <!-- Left: Shipping & Billing Details -->
                <div class="checkout-card">
                    <h3 class="card-section-title">
                        <i class="fas fa-map-marker-alt"></i> Shipping &amp; Contact Details
                    </h3>

                    <div class="checkout-form-grid">
                        <div class="form-group-vma form-field-full">
                            <label for="customer_name">Full Name <span class="req">*</span></label>
                            <input type="text" id="customer_name" name="customer_name" class="form-input-vma" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group-vma">
                            <label for="mobile">Mobile / WhatsApp Number <span class="req">*</span></label>
                            <input type="tel" id="mobile" name="mobile" class="form-input-vma" placeholder="10-digit mobile number" maxlength="10" required>
                        </div>

                        <div class="form-group-vma">
                            <label for="email">Email Address <span class="req">*</span></label>
                            <input type="email" id="email" name="email" class="form-input-vma" placeholder="yourname@example.com" required>
                        </div>

                        <div class="form-group-vma form-field-full">
                            <label for="address">Street Address / House No. <span class="req">*</span></label>
                            <textarea id="address" name="address" class="form-textarea-vma" placeholder="Flat/House No., Street, Landmark" required></textarea>
                        </div>

                        <div class="form-group-vma">
                            <label for="city">City <span class="req">*</span></label>
                            <input type="text" id="city" name="city" class="form-input-vma" placeholder="City" required>
                        </div>

                        <div class="form-group-vma">
                            <label for="state">State <span class="req">*</span></label>
                            <input type="text" id="state" name="state" class="form-input-vma" placeholder="State" required>
                        </div>

                        <div class="form-group-vma">
                            <label for="pincode">Pincode <span class="req">*</span></label>
                            <input type="text" id="pincode" name="pincode" class="form-input-vma" placeholder="6-digit pincode" maxlength="6" required>
                        </div>

                        <div class="form-group-vma">
                            <label for="country">Country</label>
                            <input type="text" id="country" class="form-input-vma" value="India" readonly disabled style="background:#f0f0f0;">
                        </div>

                        <div class="form-group-vma form-field-full">
                            <label for="notes">Order Notes / Sankalp Request (Optional)</label>
                            <textarea id="notes" name="notes" class="form-textarea-vma" placeholder="Any specific instructions for consecration, delivery timings, or family prayer name."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Right: Order Review & Razorpay -->
                <div class="checkout-card">
                    <h3 class="card-section-title">
                        <i class="fas fa-shopping-bag"></i> Order Review (<?= count($checkout_items) ?> <?= (count($checkout_items) === 1) ? 'item' : 'items' ?>)
                    </h3>

                    <div class="checkout-review-items">
                        <?php foreach ($checkout_items as $item): ?>
                            <div class="review-item-row">
                                <img src="<?= !empty($item['main_image']) ? 'admin/uploads/products/' . htmlspecialchars($item['main_image']) : 'assets/logo/logo.png' ?>" 
                                     alt="<?= htmlspecialchars($item['name']) ?>" 
                                     class="review-item-thumb"
                                     onerror="this.src='assets/logo/logo.png'">
                                <div class="review-item-details">
                                    <h4><?= htmlspecialchars($item['name']) ?></h4>
                                    <span>₹<?= number_format($item['price'], 2) ?> × <?= (int)$item['quantity'] ?></span>
                                </div>
                                <div class="review-item-total">
                                    ₹<?= number_format($item['line_total'], 2) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="checkout-totals-box">
                        <div class="totals-line">
                            <span>Items Subtotal</span>
                            <strong>₹<?= number_format($subtotal, 2) ?></strong>
                        </div>
                        <div class="totals-line">
                            <span>Delivery (All India)</span>
                            <span class="text-success font-weight-bold" style="color: #28a745; font-weight:700;">FREE</span>
                        </div>
                        <div class="totals-line grand-total">
                            <span>Total Payable</span>
                            <span style="color: #1a1a40;" id="displayGrandTotal">₹<?= number_format($total_amount, 2) ?></span>
                        </div>
                    </div>

                    <div class="razorpay-guarantee-badge">
                        <div class="razorpay-icon-lock">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="razorpay-badge-text">
                            <h5>100% Encrypted &amp; Secure</h5>
                            <p>Powered by official Razorpay Payment Gateway (UPI, Cards, NetBanking, Wallets)</p>
                        </div>
                    </div>

                    <button type="submit" class="btn-pay-order" id="submitPayBtn">
                        <i class="fas fa-lock"></i> Pay ₹<?= number_format($total_amount, 2) ?> Securely
                    </button>
                    
                    <p style="text-align: center; margin-top: 15px; font-size: 0.8rem; color: #888;">
                        By placing your order, you agree to our <a href="terms-and-conditions.php" target="_blank" style="color:#D4A843;">Terms</a> and <a href="refund-policy.php" target="_blank" style="color:#D4A843;">Refund Policy</a>.
                    </p>
                </div>
            </div>
        </form>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <!-- Razorpay Official Checkout SDK -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE_URL ?>/assets/js/header.js"></script>

    <script>
        const checkoutForm = document.getElementById('checkoutForm');
        const submitPayBtn = document.getElementById('submitPayBtn');
        const originalBtnText = submitPayBtn ? submitPayBtn.innerHTML : '';

        checkoutForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Client-side validation
            const name = document.getElementById('customer_name').value.trim();
            const mobile = document.getElementById('mobile').value.trim();
            const email = document.getElementById('email').value.trim();
            const address = document.getElementById('address').value.trim();
            const city = document.getElementById('city').value.trim();
            const state = document.getElementById('state').value.trim();
            const pincode = document.getElementById('pincode').value.trim();

            if (!name || !mobile || !email || !address || !city || !state || !pincode) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Missing Required Fields',
                    text: 'Please fill in all required shipping and contact details marked with *.',
                    confirmButtonColor: '#D4A843'
                });
                return;
            }

            if (!/^\d{10}$/.test(mobile.replace(/\D/g, ''))) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Mobile Number',
                    text: 'Please enter a valid 10-digit mobile number.',
                    confirmButtonColor: '#D4A843'
                });
                return;
            }

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Email Address',
                    text: 'Please enter a valid email address.',
                    confirmButtonColor: '#D4A843'
                });
                return;
            }

            if (!/^\d{6}$/.test(pincode.replace(/\D/g, ''))) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Pincode',
                    text: 'Please enter a valid 6-digit Indian pincode.',
                    confirmButtonColor: '#D4A843'
                });
                return;
            }

            // Set loading state
            submitPayBtn.disabled = true;
            submitPayBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Initiating Payment Gateway...';

            const formData = new FormData(checkoutForm);
            const payload = Object.fromEntries(formData.entries());

            // 1. Create order on server and get Razorpay order ID
            fetch('api/create_shop_order.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    launchRazorpay(data, payload);
                } else {
                    submitPayBtn.disabled = false;
                    submitPayBtn.innerHTML = originalBtnText;
                    Swal.fire({
                        icon: 'error',
                        title: 'Order Initiation Failed',
                        text: data.message || 'Unable to start payment. Please try again.',
                        confirmButtonColor: '#d33'
                    });
                }
            })
            .catch(err => {
                console.error(err);
                submitPayBtn.disabled = false;
                submitPayBtn.innerHTML = originalBtnText;
                Swal.fire({
                    icon: 'error',
                    title: 'Network Error',
                    text: 'Could not connect to the server. Please check your internet connection.',
                    confirmButtonColor: '#d33'
                });
            });
        });

        function launchRazorpay(orderData, customerPayload) {
            if (typeof Razorpay === 'undefined') {
                submitPayBtn.disabled = false;
                submitPayBtn.innerHTML = originalBtnText;
                Swal.fire({
                    icon: 'error',
                    title: 'Payment SDK Not Loaded',
                    text: 'Razorpay checkout failed to load. Please refresh the page and try again.',
                    confirmButtonColor: '#d33'
                });
                return;
            }

            const options = {
                key: orderData.key_id,
                amount: orderData.amount,
                currency: orderData.currency,
                name: "Vastu Mitra Abhishek",
                description: "Order #" + orderData.order_number,
                image: "assets/logo/logo.png",
                order_id: orderData.razorpay_order_id,
                prefill: {
                    name: customerPayload.customer_name,
                    email: customerPayload.email,
                    contact: customerPayload.mobile
                },
                theme: {
                    color: "#D4A843"
                },
                handler: function (response) {
                    // Payment succeeded on Razorpay modal -> Verify server-side
                    submitPayBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying Payment...';

                    fetch('api/verify_shop_payment.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_signature: response.razorpay_signature
                        })
                    })
                    .then(r => r.json())
                    .then(vData => {
                        if (vData.status === 'success') {
                            window.location.href = vData.redirect_url;
                        } else {
                            submitPayBtn.disabled = false;
                            submitPayBtn.innerHTML = originalBtnText;
                            Swal.fire({
                                icon: 'error',
                                title: 'Verification Failed',
                                text: vData.message || 'Payment received but verification encountered an issue. Please contact support.',
                                confirmButtonColor: '#d33'
                            });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        submitPayBtn.disabled = false;
                        submitPayBtn.innerHTML = originalBtnText;
                        Swal.fire({
                            icon: 'warning',
                            title: 'Verification In Progress',
                            text: 'Your payment was completed (ID: ' + response.razorpay_payment_id + '). If your page does not update, please contact our support team.',
                            confirmButtonColor: '#D4A843'
                        });
                    });
                },
                modal: {
                    ondismiss: function () {
                        submitPayBtn.disabled = false;
                        submitPayBtn.innerHTML = originalBtnText;
                    }
                }
            };

            const rzp = new Razorpay(options);
            rzp.on('payment.failed', function (response) {
                submitPayBtn.disabled = false;
                submitPayBtn.innerHTML = originalBtnText;
                Swal.fire({
                    icon: 'error',
                    title: 'Payment Failed',
                    text: response.error.description || 'Payment could not be completed. Please try again or use another payment method.',
                    confirmButtonColor: '#d33'
                });
            });

            rzp.open();
        }
    </script>
</body>
</html>
