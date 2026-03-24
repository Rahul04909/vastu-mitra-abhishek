<?php
require_once __DIR__ . '/database/db_config.php';

header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Something went wrong. Please try again.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;
    $product_name = isset($_POST['product_name']) ? htmlspecialchars(trim($_POST['product_name'])) : '';
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    if (empty($name) || empty($email) || empty($product_name)) {
        $response['message'] = "Name, Email and Product details are required.";
        echo json_encode($response);
        exit;
    }

    try {
        // Self-healing: Check if table exists, create if not
        $checkTable = $dbh->query("SHOW TABLES LIKE 'product_enquiries'");
        if ($checkTable->rowCount() == 0) {
            $sql_create = "CREATE TABLE IF NOT EXISTS `product_enquiries` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `product_id` int(11) DEFAULT NULL,
                `product_name` varchar(255) DEFAULT NULL,
                `name` varchar(255) DEFAULT NULL,
                `email` varchar(255) DEFAULT NULL,
                `phone` varchar(20) DEFAULT NULL,
                `message` text DEFAULT NULL,
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
            $dbh->exec($sql_create);
        }

        // Insert enquiry
        $stmt = $dbh->prepare("INSERT INTO product_enquiries (product_id, product_name, name, email, phone, message) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$product_id, $product_name, $name, $email, $phone, $message])) {
            $response = [
                'status' => 'success',
                'message' => 'Your enquiry for "' . $product_name . '" has been submitted successfully!'
            ];
        }
    } catch (PDOException $e) {
        $response['message'] = "Database Error: " . $e->getMessage();
    }
}

echo json_encode($response);
exit;
