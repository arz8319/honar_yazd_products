<?php
namespace App\Models;

class Queue {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO queues (task, status) VALUES (?, ?)");
return $stmt->execute([
$data['task'],
$data['status'] ?? 'pending'
]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM queues");
$stmt->execute();
return $stmt->fetchAll();
}

public function updateStatus($id, $status) {
$stmt = $this->db->prepare("UPDATE queues SET status = ? WHERE id = ?");
return $stmt->execute([$status, $id]);
}
}