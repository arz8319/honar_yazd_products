<?php
require_once __DIR__ . '/../app/Controllers/ProductController.php';
require_once __DIR__ . '/../app/Models/Product.php';
require_once __DIR__ . '/../app/Models/Discount.php';
require_once __DIR__ . '/TestDatabase.php';

class DiscountTest {
private $db;
private $controller;

public function __construct() {
$this->db = (new TestDatabase())->getConnection();
$this->controller = new ProductController($this->db);
}

public function testDiscount() {
// Insert test data
$this->db->query("INSERT INTO products (name, description, price, category_id) VALUES ('Test Product', 'Test Description', 100, 1)");
$productId = $this->db->lastInsertId();
$this->db->query("INSERT INTO discounts (product_id, percentage, start_date, end_date) VALUES (?, 20, NOW(), DATE_ADD(NOW(), INTERVAL 1 DAY))", [$productId]);

// Test product with discount
ob_start();
$this->controller->show($productId);
$output = ob_get_clean();
assert(strpos($output, '80') !== false, "Discounted price should be 80");
assert(strpos($output, '20%') !== false, "Discount percentage should be displayed");
}

public function run() {
$this->testDiscount();
echo "Discount tests passed!\n";
}
}

(new DiscountTest())->run();