-- SQL to create the footer_enquiries table
CREATE TABLE IF NOT EXISTS `footer_enquiries` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `mobile` VARCHAR(20),
    `country` VARCHAR(100),
    `service_type` VARCHAR(100),
    `attachment` VARCHAR(255),
    `service_mode` ENUM('Online', 'Onsite') DEFAULT 'Online',
    `message` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
