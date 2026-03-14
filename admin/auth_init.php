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

// Establish base path reliably using the current file's directory
// Since auth_init.php is in /admin, dirname(__DIR__) is the project root
$base_path = dirname(__DIR__);

// Define Admin Base URL for absolute paths dynamically
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];

// Get the directory of the current file (which is the admin directory)
$admin_dir = __DIR__;
// Normalize paths for Windows/Linux consistency
$normalized_doc_root = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
$normalized_admin_dir = str_replace('\\', '/', $admin_dir);

// Calculate the relative path from DOCUMENT_ROOT to the admin directory
$relative_admin_path = str_replace($normalized_doc_root, '', $normalized_admin_dir);
define('ADMIN_URL', $protocol . '://' . $host . $relative_admin_path);

// Define Base URL for project root
$relative_project_path = str_replace($normalized_doc_root, '', str_replace('\\', '/', dirname($admin_dir)));
define('BASE_URL', $protocol . '://' . $host . $relative_project_path);

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
