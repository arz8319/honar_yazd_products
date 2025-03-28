<?php
require_once __DIR__ . '/../app/Controllers/ProductController.php';
require_once __DIR__ . '/../app/Models/Product.php';
require_once __DIR__ . '/../app/Models/Category.php';
require_once __DIR__ . '/../app/Models/Discount.php';
require_once __DIR__ . '/TestDatabase.php';

class ProductControllerTest {
private $db;
private $controller;

public function __construct() {
$this->db = (new TestDatabase())->getConnection();
$this->controller = new ProductController($this->db);
}

public function testIndex() {
// Insert test data
$this->db->query("INSERT INTO categories (name) VALUES ('Test Category')");
$categoryId = $this->db->lastInsertId();
$this->db->query("INSERT INTO products (name, description, price, category_id) VALUES ('Test Product', 'Test Description', 100, ?)", [$categoryId]);

// Test without search and filter
ob_start();
$this->controller->index();
$output = ob_get_clean();
assert(strpos($output, 'Test Product') !== false, "Product should be displayed");

// Test with search
$_GET['search'] = 'Test';
ob_start();
$this->controller->index();
$output = ob_get_clean();
assert(strpos($output, 'Test Product') !== false, "Product should be found with search");

// Test with category filter
$_GET['search'] = '';
$_GET['category_id'] = $categoryId;
ob_start();
$this->controller->index();
$output = ob_get_clean();
assert(strpos($output, 'Test Product') !== false, "Product should be found with category filter");

// Test with no results
$_GET['search'] = 'Nonexistent';
$_GET['category_id'] = '';
ob_start();
$this->controller->index();
$output = ob_get_clean();
assert(strpos($output, 'Test Product') === false, "Product should not be found with invalid search");
}

public function run() {
$this->testIndex();
echo "ProductController tests passed!\n";
}
}

(new ProductControllerTest())->run();