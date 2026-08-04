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

$product_name = $input['product_name'] ?? 'Maha Mrityunjaya Yantra';
$customer_name = $input['customer_name'] ?? '';
$mobile = $input['mobile'] ?? '';
$email = $input['email'] ?? '';
$gotra = $input['gotra'] ?? '';
$sankalp = $input['sankalp'] ?? '';
$address = $input['address'] ?? '';
$city = $input['city'] ?? '';
$state = $input['state'] ?? '';
$pincode = $input['pincode'] ?? '';

if (empty($customer_name) || empty($mobile) || empty($email)) {
    echo json_encode(['status' => 'error', 'message' => 'Required fields missing']);
    exit;
}

$amount = 5100.00;
$amount_paisa = 5100 * 100;

$razorpay_key_id = 'rzp_live_TG7x0BMoscKTID';
$razorpay_key_secret = 'rWAMd0HsJ9YZMByXCgHwajlF';

try {
    $api = new Razorpay\Api\Api($razorpay_key_id, $razorpay_key_secret);

    $order_data = [
        'receipt' => 'US_' . time() . '_' . rand(100, 999),
        'amount' => $amount_paisa,
        'currency' => 'INR',
        'notes' => [
            'product' => $product_name,
            'customer' => $customer_name,
        ],
    ];

    $order = $api->order->create($order_data);

    $table_sql = "CREATE TABLE IF NOT EXISTS `us_product` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `product_name` varchar(255) NOT NULL DEFAULT 'Maha Mrityunjaya Yantra',
        `amount` decimal(10,2) NOT NULL DEFAULT 5100.00,
        `customer_name` varchar(255) NOT NULL,
        `mobile` varchar(20) NOT NULL,
        `email` varchar(255) NOT NULL,
        `gotra` varchar(255) DEFAULT NULL,
        `sankalp` text DEFAULT NULL,
        `address` text DEFAULT NULL,
        `city` varchar(100) DEFAULT NULL,
        `state` varchar(100) DEFAULT NULL,
        `pincode` varchar(10) DEFAULT NULL,
        `razorpay_order_id` varchar(255) DEFAULT NULL,
        `razorpay_payment_id` varchar(255) DEFAULT NULL,
        `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
        `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
        `order_status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `razorpay_order_id` (`razorpay_order_id`),
        KEY `payment_status` (`payment_status`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $dbh->exec($table_sql);

    $sql = "INSERT INTO us_product 
            (product_name, amount, customer_name, mobile, email, gotra, sankalp, address, city, state, pincode, razorpay_order_id, amount_paid, payment_status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([
        $product_name,
        $amount,
        $customer_name,
        $mobile,
        $email,
        $gotra,
        $sankalp,
        $address,
        $city,
        $state,
        $pincode,
        $order['id'],
        $amount,
    ]);

    echo json_encode([
        'status' => 'success',
        'order_id' => $order['id'],
        'amount' => $amount_paisa,
        'currency' => 'INR',
        'key_id' => $razorpay_key_id,
        'product_name' => $product_name,
        'order_db_id' => $dbh->lastInsertId(),
    ]);
} catch (Exception $e) {
    error_log('US Product Razorpay Order Error: ' . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Failed to create order. Please try again.']);
}
