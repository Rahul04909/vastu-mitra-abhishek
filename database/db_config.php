<?php
// Database configuration
$db_host = 'localhost';
$db_user = 'jghfrodu_vastu-mitra'; // default XAMPP/WAMP username
$db_pass = 'Rd14072003@./';     // default XAMPP/WAMP password
$db_name = 'jghfrodu_vastu-mitra';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed (" . $conn->connect_errno . "): " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS `" . $db_name . "`";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database ($db_name): " . $conn->error);
}

// Select the database
if (!$conn->select_db($db_name)) {
    die("Error selecting database ($db_name): " . $conn->error);
}

// PDO Connection for PHPAuth
try {
    $dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";
    $dbh = new PDO($dsn, $db_user, $db_pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("PDO Connection failed: " . $e->getMessage());
}

