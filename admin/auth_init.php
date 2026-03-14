<?php
// Establish base path reliably
$base_path = $_SERVER['DOCUMENT_ROOT'] . '/vastu-mitra-abhishek';
if (!file_exists($base_path . '/vendor/autoload.php')) {
    $base_path = dirname(__DIR__); // Fallback to parent directory
}

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
