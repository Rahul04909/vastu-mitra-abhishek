<?php
require_once __DIR__ . '/database/db_config.php';

// Prepare final response
$response = ['status' => 'error', 'message' => 'Something went wrong. Please try again.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs (FILTER_SANITIZE_STRING is deprecated in newer PHP)
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $mobile = isset($_POST['mobile']) ? htmlspecialchars(trim($_POST['mobile'])) : '';
    $country = isset($_POST['country']) ? htmlspecialchars(trim($_POST['country'])) : '';
    $service_type = isset($_POST['service_type_select']) ? htmlspecialchars(trim($_POST['service_type_select'])) : '';
    $service_mode = isset($_POST['service_mode']) ? htmlspecialchars(trim($_POST['service_mode'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    if (empty($name) || empty($email)) {
        $response['message'] = "Name and Email are required.";
        echo json_encode($response);
        exit;
    }

    $attachment_path = null;
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/uploads/enquiries/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_name = time() . '_' . basename($_FILES['attachment']['name']);
        $target_file = $upload_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowed file types
        $allowed_types = ['jpg', 'jpeg', 'png', 'pdf', 'dwg'];
        if (in_array($file_type, $allowed_types) && $_FILES['attachment']['size'] <= 10485760) { // 10MB
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file)) {
                $attachment_path = 'uploads/enquiries/' . $file_name;
            }
        }
    }

    try {
        // Self-healing: Ensure table exists
        $table_sql = "CREATE TABLE IF NOT EXISTS `footer_enquiries` (
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
        $dbh->exec($table_sql);

        $sql = "INSERT INTO footer_enquiries (name, email, mobile, country, service_type, attachment, service_mode, message) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $result = $stmt->execute([$name, $email, $mobile, $country, $service_type, $attachment_path, $service_mode, $message]);

        if ($result) {
            $response['status'] = 'success';
            $response['message'] = "Thank you! Your enquiry has been submitted successfully.";
        } else {
            throw new Exception("Execution failed.");
        }
    } catch (Exception $e) {
        error_log("Enquiry Error: " . $e->getMessage());
        $response['message'] = "Error: " . $e->getMessage();
    }
}

// Log outgoing response for debugging
// error_log("Enquiry Response: " . json_encode($response));

echo json_encode($response);
exit;
