<?php
namespace App\Models;

class Reward {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO rewards (user_id, points) VALUES (?, ?)");
return $stmt->execute([
$data['user_id'],
$data['points']
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM rewards WHERE user_id = ?");
$stmt->execute([$userId]);
return $stmt->fetchAll();
}

public function updatePoints($id, $points) {
$stmt = $this->db->prepare("UPDATE rewards SET points = points + ? WHERE id = ?");
return $stmt->execute([$points, $id]);
}
}