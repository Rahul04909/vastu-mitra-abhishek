<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Testing connection...\n";
$conn = @mysqli_connect('localhost', 'jghfrodu_vastu-mitra', 'Rd14072003@./');

if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error() . "\n";
} else {
    echo "Connection successful!\n";
}
