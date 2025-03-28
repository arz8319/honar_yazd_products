<?php
require_once 'app/Database.php';

use App\Database;

$db = new Database();
$connection = $db->getConnection();

try {
    // چک کردن وجود جدول reports
    $stmt = $connection->query("SELECT name FROM sqlite_master WHERE type='table' AND name='reports'");
    $tableExists = $stmt->fetch(\PDO::FETCH_ASSOC);

    if ($tableExists) {
        echo "جدول reports وجود دارد.\n";
    } else {
        echo "جدول reports وجود ندارد.\n";
    }

    // چک کردن چند ردیف نمونه
    $stmt = $connection->query("SELECT * FROM reports LIMIT 1");
    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($row) {
        echo "داده نمونه از جدول reports: " . print_r($row, true) . "\n";
    } else {
        echo "جدول reports خالی است.\n";
    }
} catch (Exception $e) {
    echo "خطا: " . $e->getMessage() . "\n";
}

echo "چک کردن دیتابیس به پایان رسید.";