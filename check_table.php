<?php
require 'database/db_config.php';
$res = $conn->query("SHOW TABLES LIKE 'footer_enquiries'");
if ($res->num_rows > 0) {
    echo "TABLE_EXISTS";
} else {
    echo "TABLE_MISSING";
}
?>
