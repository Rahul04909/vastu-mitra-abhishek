<?php
require_once __DIR__ . '/database/db_config.php';

$response = ['status' => 'error', 'message' => 'Something went wrong. Please try again.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newsletter_submit'])) {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $mobile = isset($_POST['mobile']) ? htmlspecialchars(trim($_POST['mobile'])) : '';
    $city = isset($_POST['city']) ? htmlspecialchars(trim($_POST['city'])) : '';
    $gotra = isset($_POST['gotra']) ? htmlspecialchars(trim($_POST['gotra'])) : '';
    $num_persons = isset($_POST['num_persons']) ? intval($_POST['num_persons']) : 0;

    if (empty($name) || empty($email)) {
        $response['message'] = "Name and Email are required.";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Please enter a valid email address.";
        echo json_encode($response);
        exit;
    }

    try {
        $table_sql = "CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `mobile` VARCHAR(20) DEFAULT NULL,
            `city` VARCHAR(100) DEFAULT NULL,
            `gotra` VARCHAR(100) DEFAULT NULL,
            `num_persons` INT DEFAULT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $dbh->exec($table_sql);

        $sql = "INSERT INTO newsletter_subscribers (name, email, mobile, city, gotra, num_persons) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $result = $stmt->execute([$name, $email, $mobile, $city, $gotra, $num_persons]);

        if ($result) {
            $response['status'] = 'success';
            $response['message'] = "Thank you! You have been subscribed successfully.";
        } else {
            throw new Exception("Execution failed.");
        }
    } catch (Exception $e) {
        error_log("Newsletter Error: " . $e->getMessage());
        $response['message'] = "Error: " . $e->getMessage();
    }
}

echo json_encode($response);
exit;
