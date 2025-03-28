<?php
namespace App\Models;

class Subscription {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO subscriptions (user_id, plan) VALUES (?, ?)");
return $stmt->execute([
$data['user_id'],
$data['plan']
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM subscriptions WHERE user_id = ?");
$stmt->execute([$userId]);
return $stmt->fetch();
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM subscriptions WHERE id = ?");
return $stmt->execute([$id]);
}
}