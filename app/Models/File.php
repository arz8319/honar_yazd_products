<?php
namespace App\Models;

class File {
private $db;

public function __construct($db) {
$this->db = $db;
}

public function create(array $data) {
$stmt = $this->db->prepare("INSERT INTO files (path, user_id) VALUES (?, ?)");
return $stmt->execute([
$data['path'],
$data['user_id']
]);
}

public function getByUserId($userId) {
$stmt = $this->db->prepare("SELECT * FROM files WHERE user_id = ?");
$stmt->execute([$userId]);
return $stmt->fetchAll();
}

public function delete($id) {
$stmt = $this->db->prepare("DELETE FROM files WHERE id = ?");
return $stmt->execute([$id]);
}
}