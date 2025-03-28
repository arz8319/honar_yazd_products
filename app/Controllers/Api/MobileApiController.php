<?php
namespace App\Controllers\Api;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class MobileApiController {
private $db;
private $productModel;
private $cartModel;
private $orderModel;

public function __construct($db) {
$this->db = $db;
$this->productModel = new Product($db);
$this->cartModel = new Cart($db);
$this->orderModel = new Order($db);
}

public function getProducts() {
$products = $this->productModel->getAll();
header('Content-Type: application/json');
echo json_encode($products);
}

public function getCart($userId) {
$cart = $this->cartModel->getByUserId($userId);
header('Content-Type: application/json');
echo json_encode($cart);
}

public function calculateTotal($userId) {
$cart = $this->cartModel->getByUserId($userId);
$items = json_decode($cart['items'], true);
$total = 0;
foreach ($items as $productId => $quantity) {
$product = $this->productModel->getById($productId);
$total += $product['price'] * $quantity;
}
header('Content-Type: application/json');
echo json_encode(['total' => $total]);
}
}