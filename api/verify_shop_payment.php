<?php
/**
 * Verify Shop Order Payment API
 * Verifies Razorpay HMAC signature, updates order status, and clears cart
 */
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
    exit;
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database/db_config.php';
require_once __DIR__ . '/../includes/cart_functions.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) {
    $input = $_POST;
}

$razorpay_order_id   = trim($input['razorpay_order_id'] ?? '');
$razorpay_payment_id = trim($input['razorpay_payment_id'] ?? '');
$razorpay_signature  = trim($input['razorpay_signature'] ?? '');

if (empty($razorpay_order_id) || empty($razorpay_payment_id) || empty($razorpay_signature)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing payment verification credentials.']);
    exit;
}

try {
    $api = new Razorpay\Api\Api(RAZORPAY_KEY_ID, RAZORPAY_KEY_SECRET);

    // 1. Verify Payment Signature securely using HMAC-SHA256
    $attributes = [
        'razorpay_order_id'   => $razorpay_order_id,
        'razorpay_payment_id' => $razorpay_payment_id,
        'razorpay_signature'  => $razorpay_signature
    ];

    $api->utility->verifyPaymentSignature($attributes);

    // 2. Fetch payment details from Razorpay to verify capture
    $payment = $api->payment->fetch($razorpay_payment_id);

    // Capture payment if it's currently authorized and not yet captured
    if ($payment['status'] === 'authorized') {
        try {
            $payment->capture(['amount' => $payment['amount'], 'currency' => RAZORPAY_CURRENCY]);
            $payment = $api->payment->fetch($razorpay_payment_id);
        } catch (Exception $capErr) {
            // Already captured or auto-captured
        }
    }

    if ($payment['status'] === 'captured' || $payment['status'] === 'authorized') {
        // Fetch matching order from DB
        $stmtOrder = $dbh->prepare("SELECT id, order_number, email, customer_name FROM shop_orders WHERE razorpay_order_id = ?");
        $stmtOrder->execute([$razorpay_order_id]);
        $order = $stmtOrder->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            echo json_encode(['status' => 'error', 'message' => 'Order reference not found in store database.']);
            exit;
        }

        // Update order status in database
        $stmtUpdate = $dbh->prepare("UPDATE shop_orders 
            SET payment_status = 'paid', 
                order_status = 'processing', 
                razorpay_payment_id = ?, 
                razorpay_signature = ? 
            WHERE id = ?");
        $stmtUpdate->execute([$razorpay_payment_id, $razorpay_signature, $order['id']]);

        // Clear cart session now that order has been paid
        clear_cart();

        // Generate verification token for viewing the receipt
        $token = md5($order['order_number'] . RAZORPAY_KEY_SECRET);
        $_SESSION['last_paid_order_id'] = $order['id'];

        echo json_encode([
            'status' => 'success',
            'message' => 'Payment verified successfully! Thank you for your order.',
            'order_id' => $order['id'],
            'order_number' => $order['order_number'],
            'redirect_url' => 'order-success.php?order_id=' . $order['id'] . '&token=' . $token
        ]);
    } else {
        // Payment failed or was rejected
        $stmtFail = $dbh->prepare("UPDATE shop_orders 
            SET payment_status = 'failed', razorpay_payment_id = ? 
            WHERE razorpay_order_id = ?");
        $stmtFail->execute([$razorpay_payment_id, $razorpay_order_id]);

        echo json_encode([
            'status' => 'error',
            'message' => 'Payment was not successfully captured by the bank. Payment status: ' . ($payment['status'] ?? 'unknown')
        ]);
    }

} catch (Razorpay\Api\Errors\SignatureVerificationError $e) {
    error_log('Razorpay Signature Verification Failed: ' . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Invalid payment signature. Verification failed.']);
} catch (Exception $e) {
    error_log('Shop Payment Verification General Error: ' . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Payment verification error: ' . $e->getMessage()]);
}
exit;
