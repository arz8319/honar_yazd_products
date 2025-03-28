<?php
require_once __DIR__ . '/../app/Controllers/PaymentController.php';
require_once __DIR__ . '/../app/Models/Order.php';
require_once __DIR__ . '/../app/Models/Payment.php';
require_once __DIR__ . '/TestDatabase.php';

class PaymentControllerTest {
private $db;
private $controller;

public function __construct() {
$this->db = (new TestDatabase())->getConnection();
$this->controller = new PaymentController($this->db);
}

public function testPaymentFlow() {
// Setup user session
$_SESSION['user_id'] = 1;

// Insert test order and payment
$this->db->query("INSERT INTO orders (user_id, total, status) VALUES (1, 100, 'pending')");
$orderId = $this->db->lastInsertId();
$this->db->query("INSERT INTO payments (order_id, amount, status, gateway) VALUES (?, 100, 'pending', 'zarinpal')", [$orderId]);

// Test initiate (mock redirect)
ob_start();
$this->controller->initiate($orderId);
$output = ob_get_clean();
assert(strpos($output, 'Location: https://www.zarinpal.com') !== false, "Should redirect to payment gateway");

// Test verify (mock success)
$_GET['Authority'] = 'test-authority';
$_GET['Status'] = 'OK';
ob_start();
$this->controller->verify($orderId);
$output = ob_get_clean();
$payment = $this->db->query("SELECT status FROM payments WHERE order_id = ?", [$orderId])->fetch();
assert($payment['status'] === 'completed', "Payment status should be completed");
}

public function run() {
$this->testPaymentFlow();
echo "PaymentController tests passed!\n";
}
}

(new PaymentControllerTest())->run();