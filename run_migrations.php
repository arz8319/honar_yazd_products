<?php
require_once 'app/Database.php';

use App\Database; // وارد کردن کلاس Database از فضای نام App

$db = new Database(); // حالا این خط درست کار می‌کنه
$connection = $db->getConnection();

// اجرای فایل‌های مهاجرت
$migrations = glob('database/migrations/*.sql');
foreach ($migrations as $migration) {
    $sql = file_get_contents($migration);
    try {
        $connection->exec($sql);
        echo "اجرای مهاجرت: $migration\n";
    } catch (Exception $e) {
        echo "خطا در اجرای مهاجرت $migration: " . $e->getMessage() . "\n";
    }
}

echo "مهاجرت‌ها با موفقیت اجرا شدند.";