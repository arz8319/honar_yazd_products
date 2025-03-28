<?php
namespace App\Controllers;

use App\Models\Discount;
use App\Models\Product;

class AdminDiscountController {
private $db;
private $discountModel;
private $productModel;

public function __construct($db) {
$this->db = $db;
$this->discountModel = new Discount($db);
$this->productModel = new Product($db);
}

public function index() {
if (!isset($_SESSION['user_id']) || $this->db->query("SELECT role_id FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch()['role_id'] != 1) {
header('Location: /auth/login');
exit;
}

$discounts = $this->discountModel->getAll();
require __DIR__ . '/../../resources/views/admin/discounts/index.php';
}

public function create() {
if (!isset($_SESSION['user_id']) || $this->db->query("SELECT role_id FROM users WHERE id = ?", [$_SESSION['user_id']]->fetch()['role_id'] != 1) {
header('Location: /auth/login');
exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$data = [
'product_id' => $_POST['product_id'],
'percentage' => $_POST['percentage'],
'start_date' => $_POST['start_date'],
'end_date' => $_POST['end_date']
];
$this->discountModel->create($data);
header('Location: /admin/discounts');
} else {
$products = $this->productModel->getAll();
require __DIR__ . '/../../resources/views/admin/discounts/create.php';
}
}

public function delete($id) {
if (!isset($_SESSION['user_id']) || $this->db->query("SELECT role_id FROM users WHERE id = ?", [$_SESSION['user_id']]->fetch()['role_id'] != 1) {
header('Location: /auth/login');
exit;
}

$this->discountModel->delete($id);
header('Location: /admin/discounts');
}
}