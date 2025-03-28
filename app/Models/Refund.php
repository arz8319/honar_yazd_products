<?php
namespace App\Models;

class Refund {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO refunds (order_id, amount, reason) VALUES (?, ?, ?)");
return $stmt->execute([
$data['order_id'],
$data['amount'],
$data['reason']
]);
}

public function getByOrderId($orderId) {
$stmt = $this->db->prepare("SELECT * FROM refunds WHERE order_id = ?");
$stmt->execute([$orderId]);
return $stmt->fetch();
}
}