<?php
/**
 * Shopping Cart Helper Functions
 * Session-based cart management for Vastu Mitra Abhishek
 */

if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}

/**
 * Initialize cart session array if not present
 */
function init_cart_session() {
    if (!isset($_SESSION['shop_cart']) || !is_array($_SESSION['shop_cart'])) {
        $_SESSION['shop_cart'] = [];
    }
}

/**
 * Get total quantity count of all items in cart
 */
function get_cart_count() {
    init_cart_session();
    $count = 0;
    foreach ($_SESSION['shop_cart'] as $item) {
        $count += (int)($item['quantity'] ?? 0);
    }
    return $count;
}

/**
 * Get complete cart data with computed subtotals and product info
 * @param PDO|null $dbh Optional PDO instance to refresh prices/stock
 * @return array
 */
function get_cart($dbh = null) {
    init_cart_session();
    
    $items = [];
    $subtotal = 0.00;
    $total_items = 0;

    foreach ($_SESSION['shop_cart'] as $productId => $item) {
        $pId = (int)$productId;
        $qty = max(1, (int)($item['quantity'] ?? 1));
        
        // If DB handle is provided, refresh product details from DB
        if ($dbh instanceof PDO) {
            try {
                $stmt = $dbh->prepare("SELECT id, name, slug, price, sale_price, stock_status, main_image FROM products WHERE id = ?");
                $stmt->execute([$pId]);
                $prod = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($prod) {
                    $unitPrice = ($prod['sale_price'] !== null && (float)$prod['sale_price'] > 0 && (float)$prod['sale_price'] < (float)$prod['price'])
                        ? (float)$prod['sale_price']
                        : (float)$prod['price'];
                    
                    $item['name'] = $prod['name'];
                    $item['slug'] = $prod['slug'];
                    $item['price'] = $unitPrice;
                    $item['regular_price'] = (float)$prod['price'];
                    $item['main_image'] = $prod['main_image'];
                    $item['stock_status'] = $prod['stock_status'] ?? 'in_stock';
                    $_SESSION['shop_cart'][$pId] = $item;
                }
            } catch (Exception $e) {
                // Keep session cached data if query fails
            }
        }

        $unitPrice = (float)($item['price'] ?? 0.00);
        $lineTotal = $unitPrice * $qty;
        $subtotal += $lineTotal;
        $total_items += $qty;

        $items[] = [
            'product_id' => $pId,
            'name' => $item['name'] ?? 'Product',
            'slug' => $item['slug'] ?? '',
            'main_image' => $item['main_image'] ?? '',
            'price' => $unitPrice,
            'regular_price' => (float)($item['regular_price'] ?? $unitPrice),
            'quantity' => $qty,
            'line_total' => $lineTotal,
            'stock_status' => $item['stock_status'] ?? 'in_stock'
        ];
    }

    $shipping_fee = 0.00; // Free delivery across India
    $total_amount = $subtotal + $shipping_fee;

    return [
        'items' => $items,
        'total_items' => $total_items,
        'subtotal' => $subtotal,
        'shipping_fee' => $shipping_fee,
        'total_amount' => $total_amount
    ];
}

/**
 * Add a product to the cart
 * @param PDO $dbh
 * @param int $product_id
 * @param int $quantity
 * @return array Result [success => bool, message => string, cart_count => int]
 */
function add_to_cart($dbh, $product_id, $quantity = 1) {
    init_cart_session();
    $product_id = (int)$product_id;
    $quantity = max(1, (int)$quantity);

    if ($product_id <= 0) {
        return ['success' => false, 'message' => 'Invalid product ID.'];
    }

    try {
        $stmt = $dbh->prepare("SELECT id, name, slug, price, sale_price, stock_status, main_image FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            return ['success' => false, 'message' => 'Product not found.'];
        }

        if (isset($product['stock_status']) && $product['stock_status'] === 'out_of_stock') {
            return ['success' => false, 'message' => 'This product is currently out of stock.'];
        }

        $effectivePrice = ($product['sale_price'] !== null && (float)$product['sale_price'] > 0 && (float)$product['sale_price'] < (float)$product['price'])
            ? (float)$product['sale_price']
            : (float)$product['price'];

        if (isset($_SESSION['shop_cart'][$product_id])) {
            $_SESSION['shop_cart'][$product_id]['quantity'] += $quantity;
        } else {
            $_SESSION['shop_cart'][$product_id] = [
                'product_id' => $product['id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'price' => $effectivePrice,
                'regular_price' => (float)$product['price'],
                'main_image' => $product['main_image'],
                'quantity' => $quantity,
                'stock_status' => $product['stock_status'] ?? 'in_stock'
            ];
        }

        return [
            'success' => true,
            'message' => '“' . $product['name'] . '” added to your cart!',
            'cart_count' => get_cart_count()
        ];
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
    }
}

/**
 * Update quantity of a product in the cart
 * @param int $product_id
 * @param int $quantity
 * @return array
 */
function update_cart_quantity($product_id, $quantity) {
    init_cart_session();
    $product_id = (int)$product_id;
    $quantity = (int)$quantity;

    if ($quantity <= 0) {
        return remove_from_cart($product_id);
    }

    if (isset($_SESSION['shop_cart'][$product_id])) {
        $_SESSION['shop_cart'][$product_id]['quantity'] = $quantity;
        return [
            'success' => true,
            'message' => 'Cart updated successfully.',
            'cart_count' => get_cart_count()
        ];
    }

    return ['success' => false, 'message' => 'Item not found in cart.'];
}

/**
 * Remove a product from the cart
 * @param int $product_id
 * @return array
 */
function remove_from_cart($product_id) {
    init_cart_session();
    $product_id = (int)$product_id;

    if (isset($_SESSION['shop_cart'][$product_id])) {
        unset($_SESSION['shop_cart'][$product_id]);
        return [
            'success' => true,
            'message' => 'Item removed from cart.',
            'cart_count' => get_cart_count()
        ];
    }

    return ['success' => false, 'message' => 'Item not in cart.'];
}

/**
 * Clear all items from the cart
 */
function clear_cart() {
    $_SESSION['shop_cart'] = [];
    return [
        'success' => true,
        'message' => 'Cart cleared.',
        'cart_count' => 0
    ];
}
