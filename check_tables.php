<?php
require_once 'app/Database.php';

use App\Database;

$db = new Database();
$connection = $db->getConnection();

try {
    $stmt = $connection->query("SELECT name FROM sqlite_master WHERE type='table'");
    $tables = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    echo "جدول‌های موجود در دیتابیس:\n";
    print_r($tables);
} catch (Exception $e) {
    echo "خطا: " . $e->getMessage() . "\n";
}