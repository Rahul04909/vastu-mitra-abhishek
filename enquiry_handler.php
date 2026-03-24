<?php
require_once __DIR__ . '/database/db_config.php';

// Prepare final response
$response = ['status' => 'error', 'message' => 'Something went wrong. Please try again.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
    $service_type = filter_input(INPUT_POST, 'service_type_select', FILTER_SANITIZE_STRING);
    $service_mode = filter_input(INPUT_POST, 'service_mode', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

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
        $sql = "INSERT INTO footer_enquiries (name, email, mobile, country, service_type, attachment, service_mode, message) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$name, $email, $mobile, $country, $service_type, $attachment_path, $service_mode, $message]);

        $response['status'] = 'success';
        $response['message'] = "Thank you! Your enquiry has been submitted successfully. We will contact you soon.";
    } catch (PDOException $e) {
        $response['message'] = "Database Error: " . $e->getMessage();
    }
}

echo json_encode($response);
exit;
