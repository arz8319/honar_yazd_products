<?php
require_once 'app/Database.php';

use App\Database;

$db = new Database();
$connection = $db->getConnection();

$sql = file_get_contents('add_admin_user.sql');
try {
    $connection->exec($sql);
    echo "ادمین با موفقیت اضافه شد.\n";
} catch (Exception $e) {
    echo "خطا: " . $e->getMessage() . "\n";
}