<?php
require_once __DIR__ . '/app/Database.php';

$db = new App\Database();
$connection = $db->getConnection();

// مقداردهی ستون featured برای محصولات
try {
    $connection->exec("UPDATE products SET featured = 1 WHERE name = 'Laptop'");
    $connection->exec("UPDATE products SET featured = 1 WHERE name = 'T-Shirt'");
    echo "Updated 'featured' column for products.\n";
} catch (\PDOException $e) {
    echo "Error updating 'featured' column: " . $e->getMessage() . "\n";
}