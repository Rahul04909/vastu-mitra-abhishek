<?php
// Simple mysqli database initialization script
$db_host = 'localhost';
$db_user = 'jghfrodu_vastu-mitra';
$db_pass = 'Rd14072003@./';
$db_name = 'jghfrodu_vastu-mitra';

$conn = new mysqli($db_host, $db_user, $db_pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Attempt to create database
$conn->query("CREATE DATABASE IF NOT EXISTS `$db_name`") or die($conn->error);
$conn->select_db($db_name) or die($conn->error);

$sql = "CREATE TABLE IF NOT EXISTS `footer_enquiries` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sql) === TRUE) {
    echo "TABLE_READY";
} else {
    echo "TABLE_ERROR: " . $conn->error;
}

$conn->close();
?>
