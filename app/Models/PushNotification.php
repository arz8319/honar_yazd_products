<?php
namespace App\Models;

class PushNotification {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO push_notifications (user_id, message) VALUES (?, ?)");
return $stmt->execute([
$data['user_id'],
$data['message']
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM push_notifications WHERE user_id = ?");
$stmt->execute([$userId]);
return $stmt->fetchAll();
}
}