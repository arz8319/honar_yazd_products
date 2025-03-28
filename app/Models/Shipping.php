<?php
namespace App\Models;

class Shipping {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO shipping (order_id, address, status) VALUES (?, ?, ?)");
return $stmt->execute([
$data['order_id'],
$data['address'],
$data['status'] ?? 'pending'
]);
}

public function getByOrderId($orderId) {
$stmt = $this->db->prepare("SELECT * FROM shipping WHERE order_id = ?");
$stmt->execute([$orderId]);
return $stmt->fetch();
}

public function updateStatus($id, $status) {
$stmt = $this->db->prepare("UPDATE shipping SET status = ? WHERE id = ?");
return $stmt->execute([$status, $id]);
}
}