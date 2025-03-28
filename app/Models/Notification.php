<?php
namespace App\Models;

class Notification {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
return $stmt->execute([
$data['user_id'],
$data['message']
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$userId]);
return $stmt->fetchAll();
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM notifications WHERE id = ?");
return $stmt->execute([$id]);
}
}