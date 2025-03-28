<?php
namespace App\Controllers\Api;

use App\Models\Cart;

class CartApiController {
private $db;
private $cartModel;

public function __construct($db) {
$this->db = $db;
$this->cartModel = new Cart($db);
}

public function add() {
$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['user_id'] ?? null;
$productId = $data['product_id'] ?? null;
$quantity = $data['quantity'] ?? 1;

if (!$userId || !$productId) {
header('Content-Type: application/json');
echo json_encode(['error' => 'Invalid input']);
return;
}

$cart = $this->cartModel->getByUserId($userId);
if (!$cart) {
$this->cartModel->create(['user_id' => $userId, 'items' => []]);
$cart = $this->cartModel->getByUserId($userId);
}

$items = json_decode($cart['items'], true);
$items[$productId] = ($items[$productId] ?? 0) + $quantity;
$this->cartModel->update($cart['id'], $items);

header('Content-Type: application/json');
echo json_encode(['success' => true, 'message' => 'Product added to cart']);
}

public function remove() {
$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['user_id'] ?? null;
$productId = $data['product_id'] ?? null;

if (!$userId || !$productId) {
header('Content-Type: application/json');
echo json_encode(['error' => 'Invalid input']);
return;
}

$cart = $this->cartModel->getByUserId($userId);
if ($cart) {
$items = json_decode($cart['items'], true);
unset($items[$productId]);
$this->cartModel->update($cart['id'], $items);
}

header('Content-Type: application/json');
echo json_encode(['success' => true, 'message' => 'Product removed from cart']);
}
}