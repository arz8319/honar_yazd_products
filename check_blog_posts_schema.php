<?php
require_once 'app/Database.php';

use App\Database;

$db = new Database();
$connection = $db->getConnection();

try {
    $stmt = $connection->query("PRAGMA table_info(blog_posts)");
    $columns = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    echo "ستون‌های جدول blog_posts:\n";
    print_r($columns);
} catch (Exception $e) {
    echo "خطا: " . $e->getMessage() . "\n";
}