<?php
namespace App\Models;

class Inventory {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO inventory (product_id, warehouse_id, stock) VALUES (?, ?, ?)");
return $stmt->execute([
$data['product_id'],
$data['warehouse_id'],
$data['stock']
]);
}

public function getByProductId($productId) {
$stmt = $this->db->prepare("SELECT * FROM inventory WHERE product_id = ?");
$stmt->execute([$productId]);
return $stmt->fetchAll();
}

public function updateStock($id, $stock) {
$stmt = $this->db->prepare("UPDATE inventory SET stock = ? WHERE id = ?");
return $stmt->execute([$stock, $id]);
}
}