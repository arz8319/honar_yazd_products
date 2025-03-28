<?php

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {
private $db;

protected function setUp(): void {
$config = [
'host' => 'localhost',
'database' => 'honar_yazd_test',
'username' => 'root',
'password' => '',
'charset' => 'utf8mb4'
];
$this->db = new PDO("mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}", $config['username'], $config['password']);
$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

public function testCreateProduct() {
$productModel = new Product($this->db);
$data = [
'name' => 'Test Product',
'description' => 'This is a test product.',
'price' => 99.99,
'stock' => 10
];
$result = $productModel->create($data);
$this->assertTrue($result);
}
}