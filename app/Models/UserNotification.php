<?php
namespace App\Models;

class UserNotification {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO user_notifications (user_id, message) VALUES (?, ?)");
return $stmt->execute([
$data['user_id'],
$data['message']
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM user_notifications WHERE user_id = ?");
$stmt->execute([$userId]);
return $stmt->fetchAll();
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM user_notifications WHERE id = ?");
return $stmt->execute([$id]);
}
}