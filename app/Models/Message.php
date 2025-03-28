<?php
namespace App\Models;

class Message {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)");
return $stmt->execute([
$data['sender_id'],
$data['receiver_id'],
$data['content']
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ?");
$stmt->execute([$userId, $userId]);
return $stmt->fetchAll();
}
}