<?php
/**
 * AJAX Cart Handler API
 * Supports action: add, update, remove, clear, get
 */
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../database/db_config.php';
require_once __DIR__ . '/../includes/cart_functions.php';

// Support both JSON input and standard form post
$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) {
    $input = $_POST;
}

$action = $input['action'] ?? ($_GET['action'] ?? 'get');

switch ($action) {
    case 'add':
        $product_id = isset($input['product_id']) ? (int)$input['product_id'] : 0;
        $quantity = isset($input['quantity']) ? (int)$input['quantity'] : 1;
        
        $res = add_to_cart($dbh, $product_id, $quantity);
        $cart = get_cart($dbh);
        
        echo json_encode([
            'status' => $res['success'] ? 'success' : 'error',
            'message' => $res['message'],
            'cart_count' => $res['cart_count'] ?? get_cart_count(),
            'cart' => $cart
        ]);
        break;

    case 'update':
        $product_id = isset($input['product_id']) ? (int)$input['product_id'] : 0;
        $quantity = isset($input['quantity']) ? (int)$input['quantity'] : 1;
        
        $res = update_cart_quantity($product_id, $quantity);
        $cart = get_cart($dbh);
        
        echo json_encode([
            'status' => $res['success'] ? 'success' : 'error',
            'message' => $res['message'],
            'cart_count' => $res['cart_count'] ?? get_cart_count(),
            'cart' => $cart
        ]);
        break;

    case 'remove':
        $product_id = isset($input['product_id']) ? (int)$input['product_id'] : 0;
        $res = remove_from_cart($product_id);
        $cart = get_cart($dbh);
        
        echo json_encode([
            'status' => $res['success'] ? 'success' : 'error',
            'message' => $res['message'],
            'cart_count' => $res['cart_count'] ?? get_cart_count(),
            'cart' => $cart
        ]);
        break;

    case 'clear':
        $res = clear_cart();
        echo json_encode([
            'status' => 'success',
            'message' => 'Cart emptied.',
            'cart_count' => 0,
            'cart' => get_cart($dbh)
        ]);
        break;

    case 'get':
    default:
        $cart = get_cart($dbh);
        echo json_encode([
            'status' => 'success',
            'cart_count' => get_cart_count(),
            'cart' => $cart
        ]);
        break;
}
exit;
