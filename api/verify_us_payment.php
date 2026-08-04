<?php
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
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database/db_config.php';

$input = json_decode(file_get_contents('php://input'), true);

$razorpay_order_id = $input['razorpay_order_id'] ?? '';
$razorpay_payment_id = $input['razorpay_payment_id'] ?? '';
$razorpay_signature = $input['razorpay_signature'] ?? '';

if (empty($razorpay_order_id) || empty($razorpay_payment_id) || empty($razorpay_signature)) {
    echo json_encode(['status' => 'error', 'message' => 'Payment verification data missing']);
    exit;
}

$razorpay_key_secret = 'rWAMd0HsJ9YZMByXCgHwajlF';

try {
    $api = new Razorpay\Api\Api('rzp_live_TG7x0BMoscKTID', $razorpay_key_secret);

    $attributes = [
        'razorpay_order_id' => $razorpay_order_id,
        'razorpay_payment_id' => $razorpay_payment_id,
        'razorpay_signature' => $razorpay_signature,
    ];

    $api->utility->verifyPaymentSignature($attributes);

    $payment = $api->payment->fetch($razorpay_payment_id);

    if ($payment['status'] === 'captured') {
        $sql = "UPDATE us_product 
                SET razorpay_payment_id = ?, payment_status = 'paid', order_status = 'confirmed'
                WHERE razorpay_order_id = ? AND payment_status = 'pending'";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$razorpay_payment_id, $razorpay_order_id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Payment successful! Your order has been confirmed. 🙏',
            ]);
        } else {
            echo json_encode([
                'status' => 'info',
                'message' => 'Payment verified, order was already updated.',
            ]);
        }
    } else {
        $sql = "UPDATE us_product 
                SET razorpay_payment_id = ?, payment_status = 'failed'
                WHERE razorpay_order_id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$razorpay_payment_id, $razorpay_order_id]);

        echo json_encode([
            'status' => 'error',
            'message' => 'Payment not captured. Please contact support.',
        ]);
    }
} catch (Exception $e) {
    error_log('US Product Payment Verification Error: ' . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Payment verification failed. Please contact support.']);
}
