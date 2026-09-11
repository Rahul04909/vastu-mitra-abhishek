<?php
/**
 * Create Shop Order & Razorpay Order API
 * Handles cart-based checkout or direct buy-now product checkout
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

// 1. Sanitize Customer & Shipping Inputs
$customer_name = trim($input['customer_name'] ?? '');
$mobile        = trim($input['mobile'] ?? '');
$email         = trim($input['email'] ?? '');
$address       = trim($input['address'] ?? '');
$city          = trim($input['city'] ?? '');
$state         = trim($input['state'] ?? '');
$pincode       = trim($input['pincode'] ?? '');
$notes         = trim($input['notes'] ?? '');

if (empty($customer_name) || empty($mobile) || empty($email) || empty($address) || empty($city) || empty($state) || empty($pincode)) {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all required shipping and contact details.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Please provide a valid email address.']);
    exit;
}

// Clean mobile number (must be at least 10 digits)
$cleanMobile = preg_replace('/\D/', '', $mobile);
if (strlen($cleanMobile) < 10) {
    echo json_encode(['status' => 'error', 'message' => 'Please provide a valid 10-digit mobile number.']);
    exit;
}

// 2. Determine Order Items (from Cart OR Direct Buy Now)
$cart = get_cart($dbh);
$items = $cart['items'];

// Support direct Buy Now if specified
if (empty($items) && !empty($input['buy_now_product_id'])) {
    $pId = (int)$input['buy_now_product_id'];
    $qty = max(1, (int)($input['buy_now_qty'] ?? 1));
    
    $stmt = $dbh->prepare("SELECT id, name, slug, price, sale_price, stock_status, main_image FROM products WHERE id = ?");
    $stmt->execute([$pId]);
    $prod = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($prod) {
        $price = ($prod['sale_price'] !== null && (float)$prod['sale_price'] > 0 && (float)$prod['sale_price'] < (float)$prod['price'])
            ? (float)$prod['sale_price']
            : (float)$prod['price'];

        $items[] = [
            'product_id' => $prod['id'],
            'name' => $prod['name'],
            'slug' => $prod['slug'],
            'main_image' => $prod['main_image'],
            'price' => $price,
            'quantity' => $qty,
            'line_total' => $price * $qty,
            'stock_status' => $prod['stock_status'] ?? 'in_stock'
        ];
    }
}

if (empty($items)) {
    echo json_encode(['status' => 'error', 'message' => 'Your cart is empty. Please select a product to checkout.']);
    exit;
}

// Calculate totals
$subtotal = 0.00;
foreach ($items as $item) {
    $subtotal += (float)$item['line_total'];
}
$shipping_fee = 0.00; // Free delivery
$total_amount = $subtotal + $shipping_fee;

if ($total_amount <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid order total amount.']);
    exit;
}

$amount_in_paise = (int)round($total_amount * 100);
$order_number = 'VMA-ORD-' . date('Ymd') . '-' . rand(1000, 9999);

try {
    // 3. Create Order in Razorpay
    $api = new Razorpay\Api\Api(RAZORPAY_KEY_ID, RAZORPAY_KEY_SECRET);

    $razorpay_order = $api->order->create([
        'receipt' => $order_number,
        'amount' => $amount_in_paise,
        'currency' => RAZORPAY_CURRENCY,
        'notes' => [
            'order_number' => $order_number,
            'customer_name' => $customer_name,
            'mobile' => $mobile,
            'email' => $email,
            'items_count' => count($items)
        ]
    ]);

    $razorpay_order_id = $razorpay_order['id'];

    // 4. Save Order in Database with pending payment status
    $dbh->beginTransaction();

    $stmt = $dbh->prepare("INSERT INTO `shop_orders` 
        (`order_number`, `customer_name`, `email`, `mobile`, `address`, `city`, `state`, `pincode`, `subtotal`, `shipping_fee`, `total_amount`, `payment_method`, `payment_status`, `order_status`, `razorpay_order_id`, `notes`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'razorpay', 'pending', 'pending', ?, ?)");

    $stmt->execute([
        $order_number,
        $customer_name,
        $email,
        $mobile,
        $address,
        $city,
        $state,
        $pincode,
        $subtotal,
        $shipping_fee,
        $total_amount,
        $razorpay_order_id,
        $notes
    ]);

    $order_db_id = $dbh->lastInsertId();

    // 5. Save Order Items
    $stmtItem = $dbh->prepare("INSERT INTO `shop_order_items` 
        (`order_id`, `product_id`, `product_name`, `product_image`, `price`, `quantity`, `total`) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");

    foreach ($items as $item) {
        $stmtItem->execute([
            $order_db_id,
            $item['product_id'],
            $item['name'],
            $item['main_image'],
            $item['price'],
            $item['quantity'],
            $item['line_total']
        ]);
    }

    $dbh->commit();

    echo json_encode([
        'status' => 'success',
        'order_id' => $order_db_id,
        'order_number' => $order_number,
        'razorpay_order_id' => $razorpay_order_id,
        'amount' => $amount_in_paise,
        'currency' => RAZORPAY_CURRENCY,
        'key_id' => RAZORPAY_KEY_ID,
        'customer' => [
            'name' => $customer_name,
            'email' => $email,
            'contact' => $mobile
        ]
    ]);

} catch (Exception $e) {
    if ($dbh->inTransaction()) {
        $dbh->rollBack();
    }
    error_log('Create Shop Order Error: ' . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'message' => 'Unable to initiate order with payment gateway: ' . $e->getMessage()
    ]);
}
exit;
