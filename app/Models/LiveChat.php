<?php
namespace App\Models;

class LiveChat {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO live_chats (user_id, message) VALUES (?, ?)");
return $stmt->execute([
$data['user_id'],
$data['message']
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM live_chats WHERE user_id = ?");
$stmt->execute([$userId]);
return $stmt->fetchAll();
}
}