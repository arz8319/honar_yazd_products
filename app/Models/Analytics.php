<?php
namespace App\Models;

class Analytics {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO analytics (event, user_id, data) VALUES (?, ?, ?)");
return $stmt->execute([
$data['event'],
$data['user_id'] ?? null,
json_encode($data['data'] ?? [])
]);
}

public function getAll() {
$stmt = $this->db->prepare("SELECT * FROM analytics");
$stmt->execute();
return $stmt->fetchAll();
}
}