<?php

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
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

public function testCreateUser() {
$userModel = new User($this->db);
$data = [
'name' => 'Test User',
'email' => 'test@example.com',
'password' => 'password123'
];
$result = $userModel->create($data);
$this->assertTrue($result);
}
}