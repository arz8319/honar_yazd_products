<?php
namespace App\Controllers\Api;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Shipping;

class OrderApiController {
private $db;
private $orderModel;
private $cartModel;
private $paymentModel;
private $shippingModel;

public function __construct($db) {
$this->db = $db;
$this->orderModel = new Order($db);
$this->cartModel = new Cart($db);
$this->paymentModel = new Payment($db);
$this->shippingModel = new Shipping($db);
}

public function getOrders($userId) {
$orders = $this->orderModel->getByUserId($userId);
header('Content-Type: application/json');
echo json_encode($orders);
}

public function create() {
$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['user_id'] ?? null;
$items = $data['items'] ?? [];
$address = $data['address'] ?? '';

if (!$userId || empty($items)) {
header('Content-Type: application/json');
echo json_encode(['error' => 'Invalid input']);
return;
}

$cart = $this->cartModel->getByUserId($userId);
if (!$cart) {
$this->cartModel->create(['user_id' => $userId, 'items' => []]);
}

$total = 0;
foreach ($items as $item) {
$product = $this->db->query("SELECT price FROM products WHERE id = ?", [$item['product_id']])->fetch();
$total += $product['price'] * $item['quantity'];
}

$this->orderModel->create([
'user_id' => $userId,
'total' => $total
]);

$orderId = $this->db->lastInsertId();
$this->paymentModel->create([
'order_id' => $orderId,
'amount' => $total,
'status' => 'pending',
'gateway' => 'zarinpal'
]);

$this->shippingModel->create([
'order_id' => $orderId,
'address' => $address,
'status' => 'pending'
]);

header('Content-Type: application/json');
echo json_encode([
'order_id' => $orderId,
'total' => $total,
'status' => 'pending'
]);
}
}