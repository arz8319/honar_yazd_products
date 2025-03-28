<?php
namespace App\Models;

class Payment {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO payments (order_id, amount, status, gateway) VALUES (?, ?, ?, ?)");
return $stmt->execute([
$data['order_id'],
$data['amount'],
$data['status'],
$data['gateway']
]);
}

public function getByOrderId($orderId) {
$stmt = $this->db->prepare("SELECT * FROM payments WHERE order_id = ?");
$stmt->execute([$orderId]);
return $stmt->fetch();
}

public function updateStatus($id, $status) {
$stmt = $this->db->prepare("UPDATE payments SET status = ? WHERE id = ?");
return $stmt->execute([$status, $id]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT p.*, o.user_id FROM payments p JOIN orders o ON p.order_id = o.id");
$stmt->execute();
return $stmt->fetchAll();
}
}