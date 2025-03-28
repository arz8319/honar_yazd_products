<?php
namespace App\Controllers\Api;

use App\Models\Product;

class ProductApiController {
private $db;
private $productModel;

public function __construct($db) {
$this->db = $db;
$this->productModel = new Product($db);
}

public function getProducts() {
$products = $this->productModel->getAll();
header('Content-Type: application/json');
echo json_encode($products);
}
}