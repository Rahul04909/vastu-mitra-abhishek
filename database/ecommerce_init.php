<?php
/**
 * Auto-initialization and safe schema migration for eCommerce functionality
 * Ensures products table has pricing fields and shop_orders tables exist.
 */

if (!isset($dbh) || !($dbh instanceof PDO)) {
    return;
}

try {
    // 1. Ensure columns exist on `products` table
    $columnsToCheck = [
        'price' => "ALTER TABLE `products` ADD COLUMN `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER `description`",
        'sale_price' => "ALTER TABLE `products` ADD COLUMN `sale_price` DECIMAL(10,2) NULL DEFAULT NULL AFTER `price`",
        'stock_status' => "ALTER TABLE `products` ADD COLUMN `stock_status` ENUM('in_stock', 'out_of_stock') NOT NULL DEFAULT 'in_stock' AFTER `sale_price`",
        'sku' => "ALTER TABLE `products` ADD COLUMN `sku` VARCHAR(100) NULL DEFAULT NULL AFTER `stock_status`"
    ];

    $existingColumns = [];
    $stmt = $dbh->query("SHOW COLUMNS FROM `products`");
    if ($stmt) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $existingColumns[] = $row['Field'];
        }
    }

    foreach ($columnsToCheck as $col => $sql) {
        if (!in_array($col, $existingColumns)) {
            try {
                $dbh->exec($sql);
            } catch (Exception $e) {
                // Column might have been added concurrently or already exists
            }
        }
    }

    // Explicitly enforce DECIMAL(10,2) precision on price and sale_price to prevent float rounding bugs (e.g. 15 becoming 14.99)
    try {
        $dbh->exec("ALTER TABLE `products` MODIFY COLUMN `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00");
    } catch (Exception $e) {}

    try {
        $dbh->exec("ALTER TABLE `products` MODIFY COLUMN `sale_price` DECIMAL(10,2) NULL DEFAULT NULL");
    } catch (Exception $e) {}

    // 2. Ensure `shop_orders` table exists
    $dbh->exec("CREATE TABLE IF NOT EXISTS `shop_orders` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `order_number` VARCHAR(64) NOT NULL UNIQUE,
        `customer_name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL,
        `mobile` VARCHAR(20) NOT NULL,
        `address` TEXT NOT NULL,
        `city` VARCHAR(100) NOT NULL,
        `state` VARCHAR(100) NOT NULL,
        `pincode` VARCHAR(20) NOT NULL,
        `subtotal` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
        `shipping_fee` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
        `total_amount` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
        `payment_method` VARCHAR(50) NOT NULL DEFAULT 'razorpay',
        `payment_status` ENUM('pending', 'paid', 'failed', 'refunded') NOT NULL DEFAULT 'pending',
        `order_status` ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') NOT NULL DEFAULT 'pending',
        `razorpay_order_id` VARCHAR(255) DEFAULT NULL,
        `razorpay_payment_id` VARCHAR(255) DEFAULT NULL,
        `razorpay_signature` VARCHAR(255) DEFAULT NULL,
        `notes` TEXT DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        KEY `idx_shop_order_num` (`order_number`),
        KEY `idx_shop_rzp_order` (`razorpay_order_id`),
        KEY `idx_shop_pay_status` (`payment_status`),
        KEY `idx_shop_ord_status` (`order_status`),
        KEY `idx_shop_created_at` (`created_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");

    // 3. Ensure `shop_order_items` table exists
    $dbh->exec("CREATE TABLE IF NOT EXISTS `shop_order_items` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `order_id` INT NOT NULL,
        `product_id` INT NOT NULL,
        `product_name` VARCHAR(255) NOT NULL,
        `product_image` VARCHAR(255) DEFAULT NULL,
        `price` DECIMAL(10,2) NOT NULL,
        `quantity` INT NOT NULL DEFAULT 1,
        `total` DECIMAL(10,2) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        KEY `idx_item_order_id` (`order_id`),
        KEY `idx_item_product_id` (`product_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");

} catch (Exception $e) {
    // Log error cleanly without crashing public page loads
    error_log('eCommerce Schema Init Notice: ' . $e->getMessage());
}
