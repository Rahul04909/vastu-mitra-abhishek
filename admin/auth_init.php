<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Register fatal error handler to catch stealthy 500 errors
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error !== NULL && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        echo "<b>Fatal Error Handled:</b> " . $error['message'] . " in <b>" . $error['file'] . "</b> on line <b>" . $error['line'] . "</b>";
    }
});

// Establish base path reliably
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/vastu-mitra-abhishek';
if (!file_exists($base_path . '/vendor/autoload.php')) {
    $base_path = dirname(__DIR__); // Fallback to parent directory
}

// Define Admin Base URL for absolute paths
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$admin_path = '/vastu-mitra-abhishek/admin'; // Direct path for this project structure
define('ADMIN_URL', $protocol . '://' . $host . $admin_path);

// Start PHP session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Require Composer Autoloader
require_once $base_path . '/vendor/autoload.php';

// Require Database Configuration
require_once $base_path . '/database/db_config.php';

use PHPAuth\Config as PHPAuthConfig;
use PHPAuth\Auth as PHPAuth;

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize PHPAuth with the PDO connection ($dbh)
try {
    $config = new PHPAuthConfig($dbh);
    $auth   = new PHPAuth($dbh, $config);
} catch (Exception $e) {
    die("PHPAuth Initialization Error: " . $e->getMessage());
}


// Get current logged-in user details if available
$currentUser = null;
if ($auth->isLogged()) {
    $sessionHash = $_COOKIE[$config->cookie_name] ?? null;
    $currentUser = $auth->getCurrentUser($sessionHash);
}
