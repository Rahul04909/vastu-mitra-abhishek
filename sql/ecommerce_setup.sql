-- ====================================================================
-- eCommerce Schema for Vastu Mitra Abhishek
-- Product Pricing, Shop Orders, and Order Items
-- ====================================================================

-- 1. Alter Products Table to Support Pricing and Stock Status
ALTER TABLE `products` 
    ADD COLUMN IF NOT EXISTS `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER `description`,
    ADD COLUMN IF NOT EXISTS `sale_price` DECIMAL(10,2) NULL DEFAULT NULL AFTER `price`,
    ADD COLUMN IF NOT EXISTS `stock_status` ENUM('in_stock', 'out_of_stock') NOT NULL DEFAULT 'in_stock' AFTER `sale_price`,
    ADD COLUMN IF NOT EXISTS `sku` VARCHAR(100) NULL DEFAULT NULL AFTER `stock_status`;

-- 2. Create Shop Orders Table
CREATE TABLE IF NOT EXISTS `shop_orders` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3. Create Shop Order Items Table
CREATE TABLE IF NOT EXISTS `shop_order_items` (
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
    KEY `idx_item_product_id` (`product_id`),
    CONSTRAINT `fk_shop_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `shop_orders`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
