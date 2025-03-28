<?php
require_once __DIR__ . '/app/Database.php';

$db = new App\Database();
$connection = $db->getConnection();

// داده‌های نمونه
$products = [
    [
        'name' => 'Laptop',
        'price' => 1000.00,
        'description' => 'A high-performance laptop',
        'image' => 'laptop.jpg',
        'created_at' => date('Y-m-d H:i:s'),
        'featured' => 1
    ],
    [
        'name' => 'T-Shirt',
        'price' => 20.00,
        'description' => 'A comfortable cotton t-shirt',
        'image' => 'tshirt.jpg',
        'created_at' => date('Y-m-d H:i:s'),
        'featured' => 1
    ]
];

// اضافه کردن محصولات به جدول
foreach ($products as $product) {
    try {
        $stmt = $connection->prepare("INSERT INTO products (name, price, description, image, created_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$product['name'], $product['price'], $product['description'], $product['image'], $product['created_at']]);
        echo "Added product: {$product['name']}\n";
    } catch (\PDOException $e) {
        echo "Error adding product {$product['name']}: " . $e->getMessage() . "\n";
    }
}

echo "Seeding completed!\n";