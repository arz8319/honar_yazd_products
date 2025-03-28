<?php

use App\Models\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase {
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

public function testCreateOrder() {
$orderModel = new Order($this->db);
$data = [
'user_id' => 1,
'total' => 199.99
];
$result = $orderModel->create($data);
$this->assertTrue($result);
}
}