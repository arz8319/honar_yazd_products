<?php
require_once 'app/Database.php';

use App\Database;

$db = new Database();
$connection = $db->getConnection();

$sql = file_get_contents('add_sample_post.sql');
try {
    $connection->exec($sql);
    echo "پست نمونه با موفقیت اضافه شد.\n";
} catch (Exception $e) {
    echo "خطا: " . $e->getMessage() . "\n";
}