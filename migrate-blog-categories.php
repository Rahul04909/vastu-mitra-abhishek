<?php
require_once __DIR__ . '/database/db_config.php';

try {
    $sql = file_get_contents(__DIR__ . '/sql/blog-categories.sql');
    $dbh->exec($sql);
    echo "Blog categories table created successfully.<br>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
