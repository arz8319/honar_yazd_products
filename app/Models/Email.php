<?php
namespace App\Models;

class Email {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO emails (`to`, subject, body, status) VALUES (?, ?, ?, ?)");
return $stmt->execute([
$data['to'],
$data['subject'],
$data['body'],
$data['status'] ?? 'pending'
]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM emails");
$stmt->execute();
return $stmt->fetchAll();
}

public function updateStatus($id, $status) {
$stmt = $this->db->prepare("UPDATE emails SET status = ? WHERE id = ?");
return $stmt->execute([$status, $id]);
}
}