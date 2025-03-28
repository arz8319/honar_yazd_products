<?php
require_once 'app/Database.php';

use App\Database;

$db = new Database();
$connection = $db->getConnection();

$sql = file_get_contents('add_translations.sql');
try {
    $connection->exec($sql);
    echo "ترجمه‌ها با موفقیت اضافه شدند.\n";
} catch (Exception $e) {
    echo "خطا: " . $e->getMessage() . "\n";
}