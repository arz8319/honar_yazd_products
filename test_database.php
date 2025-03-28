<?php
$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='products'");
$tableExists = $stmt->fetch();

if ($tableExists) {
    echo "Table 'products' exists!\n";
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($products);
} else {
    echo "Table 'products' does not exist!\n";
}