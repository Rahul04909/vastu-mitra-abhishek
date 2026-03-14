<?php
// Include the database configuration file
require_once '../database/db_config.php';

echo "<h2>Admin Table Setup</h2>";

// 1. Create the `admin` table if it doesn't exist
$table_sql = "CREATE TABLE IF NOT EXISTS admin (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($table_sql) === TRUE) {
    echo "<p>Table 'admin' is ready.</p>";
} else {
    die("Error creating table: " . $conn->error);
}

// 2. Check if an admin user already exists
$check_sql = "SELECT id FROM admin LIMIT 1";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    echo "<p style='color: blue;'>An admin user already exists. Initial setup skipped.</p>";
} else {
    // 3. Insert default admin credentials
    $default_username = 'admin';
    $default_email = 'admin@vastumitra.com';
    $default_password = 'admin123';
    
    // Hash the password for security
    $hashed_password = password_hash($default_password, PASSWORD_DEFAULT);
    
    $insert_sql = "INSERT INTO admin (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    
    if ($stmt) {
        $stmt->bind_param("sss", $default_username, $default_email, $hashed_password);
        
        if ($stmt->execute()) {
            echo "<p style='color: green;'>Default admin user created successfully!</p>";
            echo "<ul>
                    <li><strong>Username:</strong> $default_username</li>
                    <li><strong>Email:</strong> $default_email</li>
                    <li><strong>Password:</strong> $default_password</li>
                  </ul>";
            echo "<p><em>Please make sure to change this password after your first login!</em></p>";
        } else {
            echo "<p style='color: red;'>Error inserting admin user: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p style='color: red;'>Error preparing statement: " . $conn->error . "</p>";
    }
}

$conn->close();
?>
