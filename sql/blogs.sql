CREATE TABLE IF NOT EXISTS `blogs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_id` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `description` LONGTEXT NOT NULL,
    `featured_image` VARCHAR(255) NOT NULL,
    `seo_title` VARCHAR(255) DEFAULT NULL,
    `seo_desc` TEXT DEFAULT NULL,
    `seo_keywords` TEXT DEFAULT NULL,
    `seo_schema` LONGTEXT DEFAULT NULL,
    `og_image` VARCHAR(255) DEFAULT NULL,
    `status` ENUM('published', 'draft') DEFAULT 'published',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `blog_categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
