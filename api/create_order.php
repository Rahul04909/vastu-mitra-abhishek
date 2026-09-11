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

$package_name = $input['package_name'] ?? '';
$puja_date = $input['puja_date'] ?? '';
$name = $input['name'] ?? '';
$dob = $input['dob'] ?? '';
$gotra = $input['gotra'] ?? '';
$email = $input['email'] ?? '';
$mobile = $input['mobile'] ?? '';
$state = $input['state'] ?? '';
$city = $input['city'] ?? '';
$pincode = $input['pincode'] ?? '';
$address = $input['address'] ?? '';

if (empty($package_name) || empty($puja_date) || empty($name) || empty($email) || empty($mobile)) {
    echo json_encode(['status' => 'error', 'message' => 'Required fields missing']);
    exit;
}

$packages = [
    'basic' => ['name' => 'बेसिक', 'normal_price' => 1100, 'monday_price' => 2100],
    'premium' => ['name' => 'प्रीमियम', 'normal_price' => 2100, 'monday_price' => 3100],
    'vip' => ['name' => 'VIP', 'normal_price' => 5100, 'monday_price' => 7100],
];

$package_key = strtolower($package_name);
if (!isset($packages[$package_key])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid package']);
    exit;
}

$pkg = $packages[$package_key];

$day_of_week = date('w', strtotime($puja_date));
$is_monday = ($day_of_week == 1) ? 1 : 0;
$amount = $is_monday ? $pkg['monday_price'] : $pkg['normal_price'];
$amount_paisa = $amount * 100;

$razorpay_key_id = 'rzp_live_TG7x0BMoscKTID';
$razorpay_key_secret = 'rWAMd0HsJ9YZMByXCgHwajlF';

try {
    $api = new Razorpay\Api\Api($razorpay_key_id, $razorpay_key_secret);

    $order_data = [
        'receipt' => 'RA_' . time() . '_' . rand(100, 999),
        'amount' => $amount_paisa,
        'currency' => 'INR',
        'notes' => [
            'package' => $pkg['name'],
            'name' => $name,
            'puja_date' => $puja_date,
        ],
    ];

    $order = $api->order->create($order_data);

    $table_sql = "CREATE TABLE IF NOT EXISTS `rudhraabhishek_bookings` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `package_name` varchar(50) NOT NULL,
        `package_price` decimal(10,2) NOT NULL,
        `puja_date` date NOT NULL,
        `name` varchar(255) NOT NULL,
        `dob` date DEFAULT NULL,
        `gotra` varchar(255) DEFAULT NULL,
        `email` varchar(255) NOT NULL,
        `mobile` varchar(20) NOT NULL,
        `state` varchar(100) DEFAULT NULL,
        `city` varchar(100) DEFAULT NULL,
        `pincode` varchar(10) DEFAULT NULL,
        `address` text DEFAULT NULL,
        `razorpay_order_id` varchar(255) DEFAULT NULL,
        `razorpay_payment_id` varchar(255) DEFAULT NULL,
        `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
        `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
        `booking_status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
        `is_monday` tinyint(1) NOT NULL DEFAULT 0,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `razorpay_order_id` (`razorpay_order_id`),
        KEY `payment_status` (`payment_status`),
        KEY `puja_date` (`puja_date`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $dbh->exec($table_sql);

    $sql = "INSERT INTO rudhraabhishek_bookings 
            (package_name, package_price, puja_date, name, dob, gotra, email, mobile, state, city, pincode, address, razorpay_order_id, amount_paid, payment_status, is_monday)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([
        $pkg['name'],
        $amount,
        $puja_date,
        $name,
        $dob ?: null,
        $gotra,
        $email,
        $mobile,
        $state,
        $city,
        $pincode,
        $address,
        $order['id'],
        $amount,
        $is_monday,
    ]);

    echo json_encode([
        'status' => 'success',
        'order_id' => $order['id'],
        'amount' => $amount_paisa,
        'currency' => 'INR',
        'key_id' => $razorpay_key_id,
        'package_name' => $pkg['name'],
        'booking_id' => $dbh->lastInsertId(),
        'is_monday' => $is_monday,
    ]);
} catch (Exception $e) {
    error_log('Razorpay Order Error: ' . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Failed to create order. Please try again.']);
}
