<?php
require_once 'app/Database.php';

use App\Database;

$db = new Database();
$connection = $db->getConnection();

try {
    $stmt = $connection->query("SELECT * FROM post_translations WHERE lang = 'ar' LIMIT 5");
    $translations = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    echo "ترجمه‌های پست‌ها (عربی):\n";
    print_r($translations);
} catch (Exception $e) {
    echo "خطا: " . $e->getMessage() . "\n";
}