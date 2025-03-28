<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;

class AdminProductController {
private $db;
private $productModel;
private $categoryModel;

public function __construct($db) {
$this->db = $db;
$this->productModel = new Product($db);
$this->categoryModel = new Category($db);
}

public function create() {
if (!isset($_SESSION['user_id']) || $this->db->query("SELECT role_id FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch()['role_id'] != 1) {
header('Location: /auth/login');
exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$data = [
'name' => $_POST['name'],
'description' => $_POST['description'],
'price' => $_POST['price'],
'stock' => $_POST['stock'],
'category_id' => $_POST['category_id']
];
$this->productModel->create($data);
header('Location: /admin/products');
} else {
$categories = $this->categoryModel->getAll();
require __DIR__ . '/../../resources/views/admin/products/create.php';
}
}

public function edit($id) {
if (!isset($_SESSION['user_id']) || $this->db->query("SELECT role_id FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch()['role_id'] != 1) {
header('Location: /auth/login');
exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$data = [
'name' => $_POST['name'],
'description' => $_POST['description'],
'price' => $_POST['price'],
'stock' => $_POST['stock'],
'category_id' => $_POST['category_id']
];
$this->productModel->update($id, $data);
header('Location: /admin/products');
} else {
$product = $this->productModel->getById($id);
$categories = $this->categoryModel->getAll();
require __DIR__ . '/../../resources/views/admin/products/edit.php';
}
}
}