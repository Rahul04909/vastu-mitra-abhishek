<?php
$conn = @new mysqli('localhost', 'root', '');
if ($conn->connect_error) {
    echo "ROOT_FAILED: " . $conn->connect_error;
} else {
    echo "ROOT_SUCCESS";
    $conn->close();
}
?>
