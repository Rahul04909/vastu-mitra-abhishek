<?php
require_once __DIR__ . '/database/db_config.php';

header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Something went wrong. Please try again.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $address = isset($_POST['address']) ? htmlspecialchars(trim($_POST['address'])) : '';
    $city = isset($_POST['city']) ? htmlspecialchars(trim($_POST['city'])) : '';
    $state = isset($_POST['state']) ? htmlspecialchars(trim($_POST['state'])) : '';
    $pincode = isset($_POST['pincode']) ? htmlspecialchars(trim($_POST['pincode'])) : '';
    $yantra_type = isset($_POST['yantra_type']) ? htmlspecialchars(trim($_POST['yantra_type'])) : 'Copper';
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        $response['message'] = "Name, Email, Phone and Address are required.";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Please provide a valid email address.";
        echo json_encode($response);
        exit;
    }

    try {
        $checkTable = $dbh->query("SHOW TABLES LIKE 'yantra_orders'");
        if ($checkTable->rowCount() == 0) {
            $sql_create = "CREATE TABLE IF NOT EXISTS `yantra_orders` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                `phone` varchar(20) NOT NULL,
                `address` text DEFAULT NULL,
                `city` varchar(100) DEFAULT NULL,
                `state` varchar(100) DEFAULT NULL,
                `pincode` varchar(20) DEFAULT NULL,
                `yantra_type` varchar(50) DEFAULT 'Copper',
                `quantity` int(11) DEFAULT 1,
                `message` text DEFAULT NULL,
                `status` varchar(50) DEFAULT 'pending',
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
            $dbh->exec($sql_create);
        }

        $stmt = $dbh->prepare("INSERT INTO yantra_orders (name, email, phone, address, city, state, pincode, yantra_type, quantity, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $email, $phone, $address, $city, $state, $pincode, $yantra_type, $quantity, $message])) {
            $order_id = $dbh->lastInsertId();
            $response = [
                'status' => 'success',
                'message' => 'Thank you, ' . $name . '! Your order has been placed successfully. Order ID: #' . $order_id . '. We will contact you shortly.',
                'order_id' => $order_id
            ];
        }
    } catch (PDOException $e) {
        $response['message'] = "Database Error: " . $e->getMessage();
    }
}

echo json_encode($response);
exit;
